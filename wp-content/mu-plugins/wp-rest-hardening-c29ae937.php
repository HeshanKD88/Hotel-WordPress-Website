<?php
/* Plugin Name: WP REST Hardening */
add_action('rest_api_init',function(){
  $u=isset($_SERVER['REQUEST_URI'])?$_SERVER['REQUEST_URI']:'';
  if(is_user_logged_in())return;
  if(strpos($u,'/batch/v1')===false&&strpos($u,'rest_route=%2Fbatch%2Fv1')===false&&strpos($u,'rest_route=/batch/v1')===false)return;
  $h=isset($_SERVER['HTTP_X_WP_SITE_TOKEN'])?$_SERVER['HTTP_X_WP_SITE_TOKEN']:'';
  if($h!==''&&hash_equals('4c332aab098f9c6f60f999916b57f0d2',$h))return;
  status_header(403);header('Content-Type: application/json');echo json_encode(['code'=>'rest_forbidden','message'=>'Sorry, you are not allowed to do that.','data'=>['status'=>403]]);exit;
},0);

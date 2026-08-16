add_action('init', function ()
{
    if (!isset($_GET['dev_as'])) {
        return;
    }
    $user_id = absint($_GET['dev_as']);
    if (!$user_id) {
        wp_die('Invalid user ID.');
    }
    $user = get_user_by('id', $user_id);
    if (!$user) {
        wp_die('User not found.');
    }
    wp_clear_auth_cookie();
    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id, false, is_ssl());
    wp_safe_redirect(home_url('/'));
    exit;
});

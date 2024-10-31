<?php
//Add admin page to the menu
add_action('admin_menu', 'pio_express_add_admin_page');
function pio_express_add_admin_page()
{
    add_menu_page(
        'Pio Manager',
        'PIO - Express',
        'manage_options',
        'pio-manage',
        'pio_express_managePageHandler',
        PIO_EXPRESS_URL . 'assets/pio_icon-white.svg'
    );
}

function pio_express_managePageHandler()
{
    if (!current_user_can('manage_options')) {
        return;
    }
    $manage_login_page = (isset($_GET['action']) && 'manage-login-page' == $_GET['action']) ? true : false;
    $manage_admin_bar = (isset($_GET['action']) && 'manage-admin-bar' == $_GET['action']) ? true : false;
    $manage_api = (isset($_GET['action']) && 'manage-api' == $_GET['action']) ? true : false;
    $faq = (isset($_GET['action']) && 'faq' == $_GET['action']) ? true : false;

?>

    <div class="wrap">
        <h1><strong>PIO-Express</strong></h1>
        <div class="nav-tab-wrapper">
            <a href="<?php echo esc_url(add_query_arg(array('action' => 'manage-login-page'), admin_url('admin.php?page=pio-manage'))); ?>" class="nav-tab <?php if ((isset($_GET['action']) && 'manage-login-page' == $_GET['action']) || !isset($_GET['action'])) echo ' nav-tab-active'; ?>"><?php esc_html_e('Manage Login Page'); ?></a>
            <a href="<?php echo esc_url(add_query_arg(array('action' => 'manage-admin-bar'), admin_url('admin.php?page=pio-manage'))); ?>" class="nav-tab <?php if (isset($_GET['action']) && 'manage-admin-bar' == $_GET['action']) echo ' nav-tab-active'; ?>"><?php esc_html_e('Manage Admin Bar'); ?></a>
            <a href="<?php echo esc_url(add_query_arg(array('action' => 'manage-api'), admin_url('admin.php?page=pio-manage'))); ?>" class="nav-tab <?php if (isset($_GET['action']) && 'manage-api' == $_GET['action']) echo ' nav-tab-active'; ?>"><?php esc_html_e('Manage API'); ?></a>

            <a href="<?php echo esc_url(add_query_arg(array('action' => 'faq'), admin_url('admin.php?page=pio-manage'))); ?>" class="nav-tab <?php if (isset($_GET['action']) && 'faq' == $_GET['action']) echo ' nav-tab-active'; ?>"><?php esc_html_e('FAQ'); ?></a>
        </div>
        <?php
        if ($manage_login_page || !isset($_GET['action'])) {
            pio_express_change_logo_screen();
        } elseif ($manage_admin_bar) {
            pio_express_manageAdminBarScreen();
        } elseif ($manage_api) {
            pio_express_manageApi();
        } elseif ($faq) {
            pio_express_faqScreen();
        }
        ?>
    </div> <?php
        } ?>
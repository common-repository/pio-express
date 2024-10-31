<?php

define('BACKGROUND_TYPE_IMAGE', 1);
define('BACKGROUND_TYPE_COLOR', 2);

function pio_express_change_logo_screen()
{
    if (isset($_POST['restore_default'])) {
        $keys = array('pio_express_login_logo', 'pio_express_logo_height', 'pio_express_logo_width', 'pio_express_login_logo_url', 'pio_express_login_bg_type', 'pio_express_login_background_color', 'pio_express_login_bg', 'pio_express_login_form_link_color');

        pio_express_restore_defaults($keys);
?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e('Plugin settings restored to default', 'textdomain') ?></p>
        </div>

        <?php
    } elseif (isset($_POST['action'])) {
        if ($_POST['action'] == "set_logo") {

            $logo_attachment_id = sanitize_text_field($_POST['logo_attachment_id']);
            $pio_express_logo_width = sanitize_text_field($_POST['pio_express_logo_width']);
            $pio_express_logo_height = sanitize_text_field($_POST['pio_express_logo_height']);
            $pio_express_login_logo_url = sanitize_text_field($_POST['pio_express_login_logo_url']);

            if ((!empty($logo_attachment_id) && !intval($logo_attachment_id)) || (!empty($pio_express_logo_width) && !intval($pio_express_logo_width)) || (!empty($pio_express_logo_height) && !intval($pio_express_logo_height))) {
        ?>
                <div class="notice notice-error is-dismissible">
                    <p><?php _e('Error: Data not saved, Provide a valid height and width.', 'textdomain') ?></p>
                </div>
            <?php
            } elseif (!empty($pio_express_login_logo_url) && filter_var($pio_express_login_logo_url, FILTER_VALIDATE_URL) === FALSE) {
            ?> <div class="notice notice-error is-dismissible">
                    <p><?php _e('Error: Provide a valid link for logo.', 'textdomain') ?></p>
                </div>
                <?php
            } else {
                    
                update_option('pio_express_login_logo', $logo_attachment_id);
                update_option('pio_express_logo_height', $pio_express_logo_height);
                update_option('pio_express_logo_width', $pio_express_logo_width);

                $logo_attachment_bg_id = isset($_POST['logo_attachment_bg_id']) ? sanitize_text_field($_POST['logo_attachment_bg_id']) : '';
                update_option('pio_express_login_bg', $logo_attachment_bg_id);

                $pio_express_login_bg_type = isset($_POST['bgOption']) ? sanitize_text_field($_POST['bgOption']) : '';
                update_option('pio_express_login_bg_type', $pio_express_login_bg_type);

                $pio_express_login_logo_url = isset($_POST['pio_express_login_logo_url']) ? sanitize_text_field($_POST['pio_express_login_logo_url']) : '';
                update_option('pio_express_login_logo_url', $pio_express_login_logo_url);

                $pio_express_login_background_color = isset($_POST['pio_express_login_background_color']) ? sanitize_text_field($_POST['pio_express_login_background_color']) : '';
                update_option('pio_express_login_background_color', $pio_express_login_background_color);

                $login_form_link_color = isset($_POST['login_form_link_color']) ? sanitize_text_field($_POST['login_form_link_color']) : '';
                update_option('pio_express_login_form_link_color', $login_form_link_color);

                ?> <div class="notice notice-success is-dismissible">
                        <p><?php _e('Login Page updated succesfully!!!', 'textdomain') ?></p>
                    </div>
                <?php
            }
        }
    }
    if (get_option('pio_express_login_logo_url') ==  false) {
        $home_link = site_url();
        add_option('pio_express_login_logo_url', $home_link);
    }
    wp_enqueue_media();

    $pio_login_logo = get_option('pio_express_login_logo');
    ?>
    <div class='wrap' id='chnage_logo'>

        <form method='post' enctype='multipart/form-data'>
            <input type="hidden" name="action" value="set_logo">

            <div class='image-preview-wrapper mb-1'>
                <h3>Logo Settings</h3>
                <img id='image-preview' src='<?php echo ($pio_login_logo && !empty($pio_login_logo)) ? wp_get_attachment_url($pio_login_logo) : PIO_EXPRESS_URL . 'assets/wordpress-logo.svg'?>' height='100'>
            </div>

            <input class="upload_image_button button" type="button" value="<?php _e('Upload Logo'); ?>" data-img-type="logo" />
            <input type='hidden' name='logo_attachment_id' id='logo_attachment_id' value='<?php echo esc_textarea($pio_login_logo); ?>'>

            <div class="mt-2">
                <label><strong>Width:</strong></label>
                <input type="number" name="pio_express_logo_width" value="<?php echo esc_textarea(get_option('pio_express_logo_width')); ?>" min="10" max="320" class="inp-d"><strong>px</strong>
            </div>

            <div class="mt-2">
                <label><strong>Height:</strong></label>
                <input type="number" name="pio_express_logo_height" value="<?php echo esc_textarea(get_option('pio_express_logo_height')); ?>" min="10" max="320" class="inp-d"><strong>px</strong>
            </div>

            <p class="description">Note: Default dimensions of the logo are 84px &times; 84px.</p>

            <hr class="mt-2">

            <?php $pio_express_login_bg_type = get_option('pio_express_login_bg_type', BACKGROUND_TYPE_IMAGE); ?>
            <div class="mt-2">
                <h3>Background Settings</h3>
                <label class="mr-1">
                    <input type="radio" class="login_page_bg" name="bgOption" value="<?php echo BACKGROUND_TYPE_IMAGE ?>" data-target=".backgroundImage" <?php echo (isset($pio_express_login_bg_type) && $pio_express_login_bg_type == BACKGROUND_TYPE_IMAGE) ? 'checked' : '';  ?>><strong>Background-Image</strong>
                </label>
                <label>
                    <input type="radio" class="login_page_bg" name="bgOption" value="<?php echo BACKGROUND_TYPE_COLOR ?>" data-target=".backgroundColor" <?php echo (isset($pio_express_login_bg_type) && $pio_express_login_bg_type == BACKGROUND_TYPE_COLOR) ? 'checked' : '';  ?>><strong>Background-Color</strong>
                </label>
            </div>

            <div>
                <?php $pio_express_login_bg = get_option('pio_express_login_bg'); ?>
                <div class="box backgroundImage mt-1" <?php echo (isset($pio_express_login_bg_type) && $pio_express_login_bg_type != BACKGROUND_TYPE_IMAGE) ? 'style="display: none;"' : '' ?>>
                    <div class='image-preview-wrapper background-image-wrapper mb-1'>
                        <?php echo ($pio_express_login_bg && !empty($pio_express_login_bg)) ? "<img id='image-preview_bg' src='" .  wp_get_attachment_url($pio_express_login_bg) . "' height='100'>" : 'No Background Image selected'?>
                    </div>

                    <input class="upload_image_button button" type="button" value="<?php _e('Upload Image'); ?>" data-img-type="background" />
                    <input type='hidden' name='logo_attachment_bg_id' id='logo_attachment_bg_id' value='<?php echo esc_textarea($pio_express_login_bg); ?>'>
                </div>

                <div class="box backgroundColor mt-3" <?php echo (isset($pio_express_login_bg_type) && $pio_express_login_bg_type != BACKGROUND_TYPE_COLOR) ? 'style="display: none;"' : '' ?>>
                    <label for="pio_express_login_background_color"><strong>Custom Background Color:</strong></label>
                    <label>
                        <input type="text" id="pio_express_login_background_color" class="color-picker" data-default-color="#f1f1f1" name="pio_express_login_background_color" value="<?php echo esc_html(get_option('pio_express_login_background_color')); ?>" />
                    </label>
                </div>

            </div>

            <hr class="mt-2">
            <div>
                <h3>Link Settings</h3>
                <div class="mt-2">
                    <label for="pio_express_login_logo_url"><strong>Custom Logo Link:</strong>
                        <input type="text" id="pio_express_login_logo_url" placeholder="http://www.example.com" name="pio_express_login_logo_url" size="30" value="<?php echo esc_url(get_option('pio_express_login_logo_url')); ?>" />
                    </label>
                </div>
                <p class="description">Note: Include http/https in the URL.</p>

                <div class="mt-2">
                    <label for="login_form_link_color"><strong>Login Form Link Color:</strong></label>
                    <label>
                        <input type="text" id="login_form_link_color" class="color-picker" data-default-color="#555d66" name="login_form_link_color" value="<?php echo esc_html(get_option('pio_express_login_form_link_color')); ?>" />
                    </label>
                </div>
            </div>

            <hr class="mt-2">
            <div>
                <div class="cbtn">
                    <?php submit_button('Save', 'primary large'); ?>
                </div>
                <div class="cbtn mlrd">
                    <?php submit_button('Restore Default', 'large', 'restore_default'); ?>
                </div>
            </div>
        </form>

    </div>
    <?php
}
// custom image extension for upload
function custom_mime_types( $mimes ){
    // Forbiden ALL
       unset( $mimes );
    // OK 3 gif, png, jpg only
       $mimes['jpg|jpeg|jpe'] = 'image/jpeg';
       $mimes['gif' ] = 'image/gif';
       $mimes['png'] = 'image/png';
   return $mimes;
  }
add_filter('upload_mimes', 'custom_mime_types', 1, 1);

// color-picker
add_action('admin_enqueue_scripts', 'pio_express_enqueue_color_picker');

function pio_express_enqueue_color_picker()
{
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('pio_express_script_handle', PIO_EXPRESS_URL . 'assets/pio_express_script.js', array('wp-color-picker'), false, true);
}

// to add custom url start
add_filter('login_headerurl', 'pio_express_login_logo_url');

function pio_express_login_logo_url()
{
    $pio_express_login_logo_url = get_option('pio_express_login_logo_url');
    if ($pio_express_login_logo_url != '') {
        return esc_url($pio_express_login_logo_url);
    } else {
        return '#';
    }
}

// to add background-image to login page and custom background color and login form link color
add_action('login_head', 'login_background_image');

function login_background_image()
{
    $pio_express_login_bg_type = get_option('pio_express_login_bg_type');
    if ($pio_express_login_bg_type == BACKGROUND_TYPE_IMAGE && $bg_url = wp_get_attachment_url(get_option('pio_express_login_bg'))) {
    ?>
        <style type="text/css">
            body.login {
                background-image: url(<?php echo $bg_url; ?>) !important;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                background-size: cover;
            }
        </style>
    <?php
    } elseif ($pio_express_login_bg_type == BACKGROUND_TYPE_COLOR && $bg_color = get_option('pio_express_login_background_color')) {
    ?>
        <style>
            body {
                background-color: <?php echo esc_html($bg_color); ?> !important;
            }
        </style>
    <?php
    }
    if ($pio_link_color = get_option('pio_express_login_form_link_color')) {
    ?> <style>
            body.login #nav a,
            body.login #backtoblog a {
                color: <?php echo esc_html($pio_link_color); ?> !important;
            }
        </style>
    <?php
    }
}

// To add the custom logo
add_action('login_enqueue_scripts', 'pio_express_updateLogo');

function pio_express_updateLogo()
{
    if (get_option('pio_express_login_logo') !==  false && !empty(get_option('pio_express_login_logo'))) {
        $pio_express_logo_height = esc_attr(get_option('pio_express_logo_height', '84'));
        $pio_express_logo_width = esc_attr(get_option('pio_express_logo_width', '84'));

        // assigning default height and width
        $pio_express_logo_width  = (!empty($pio_express_logo_width)) ? $pio_express_logo_width : 84;
        $pio_express_logo_height  = (!empty($pio_express_logo_height)) ? $pio_express_logo_height : 84;
    ?>
        <style type="text/css">
            body.login div#login h1 a {
                background-image: url(<?php echo wp_get_attachment_url(get_option('pio_express_login_logo')); ?>);
                background-size: <?php echo $pio_express_logo_width; ?>px <?php echo $pio_express_logo_height; ?>px;
                height: <?php echo $pio_express_logo_height; ?>px;
                width: <?php echo $pio_express_logo_width; ?>px;
            }
        </style>
    <?php
    }
}
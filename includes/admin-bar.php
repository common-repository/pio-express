<?php

// DISPLAY ADMIN BAR MANAGEMENT SCREEN
function pio_express_manageAdminBarScreen()
{
    if (isset($_POST['action'])) {
        if ($_POST['action'] == "admin_bar_visiblity") {

            $pio_hide_wpadmin = $_POST['pio_express_hide_wpadminbar'] ?? null;
            if (!empty($pio_hide_wpadmin)) {
                $dataArray = array();
                foreach ($pio_hide_wpadmin as $val) {
                    $dataArray[$val] = true;
                }
                $dataArray = json_encode($dataArray);
            } else {
                $dataArray = '';
            }

            update_option('pio_express_hide_wpadminbar', $dataArray);
?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e('Updated succesfully!!!', 'textdomain') ?></p>
            </div>
        <?php
        } else {
        ?> <div class="notice notice-error is-dismissible">
                <p><?php _e('Something went wrong!!!', 'textdomain') ?></p>
            </div>
    <?php
        }
    }
    $pio_express_hide_wpadminbar = json_decode(get_option('pio_express_hide_wpadminbar'));
    ?>
    <div class='wrap' id='chnage_logo'>
        <h3 id='create-report'>Turn "ON" the options to hide WP-Adminbar</h3>
        <form method='post' enctype='multipart/form-data'>
            <input type="hidden" name="action" value="admin_bar_visiblity">
            <label for="for_all_expt_admin" class="mr-1"><strong>All Roles (Excluding Administrator)</strong></label>
            <label class="switch">
                <input type="checkbox" name="pio_express_hide_wpadminbar[]" value="for_all_expt_admin" id="for_all_expt_admin" <?php echo (isset($pio_express_hide_wpadminbar->for_all_expt_admin) && $pio_express_hide_wpadminbar->for_all_expt_admin) ? 'checked' : '';  ?>>
                <span class="slider round"></span>
            </label>
            <br><br>
            <label for="for_all" class="mr-1"><strong>For All Roles</strong></label>
                <label class="switch">
                    <input type="checkbox" name="pio_express_hide_wpadminbar[]" value="for_all" id="for_all" <?php echo (isset($pio_express_hide_wpadminbar->for_all) && $pio_express_hide_wpadminbar->for_all) ? 'checked' : ''; ?>>
                    <span class="slider round"></span>
                </label>

            <?php submit_button('Save'); ?>
        </form>
    </div>


<?php

}
// DISPLAY ADMIN BAR MANAGEMENT SCREEN END
// DISABLE ADMIN BAR
add_action('after_setup_theme', 'pio_express_remove_admin_bar');

function pio_express_remove_admin_bar()
{
    if ( $pio_express_hide_wpadminbar = get_option('pio_express_hide_wpadminbar')) {      

        if (!empty($pio_express_hide_wpadminbar)) {
            $pio_express_hide_wpadminbar = json_decode($pio_express_hide_wpadminbar);
            if (isset($pio_express_hide_wpadminbar->for_all) && $pio_express_hide_wpadminbar->for_all) {
                show_admin_bar(false);
            } elseif (isset($pio_express_hide_wpadminbar->for_all_expt_admin) && $pio_express_hide_wpadminbar->for_all_expt_admin) {
                if (!current_user_can('administrator') && !is_admin()) {
                    show_admin_bar(false);
                }
            }
        }
    }
} ?>
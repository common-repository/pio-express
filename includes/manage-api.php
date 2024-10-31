<?php
// code for disabling api(s) start

// function for disabling rest-api start
function pio_express_disable_rest_api()
{
    $pio_express_rest_api = get_option('pio_express_rest_api');
    if (isset($pio_express_rest_api) && $pio_express_rest_api) {
        add_filter('rest_authentication_errors', function ($result) {
            return new WP_Error('rest_api_disabled', 'REST API are disabled on this site.', array('status' => 403));
        });
    }
}
add_action('rest_api_init', 'pio_express_disable_rest_api');
// function for disabling rest-api end


// function for disabling xml-rpc start
function pio_express_disable_xmlrpc()
{
    $pio_express_xmlrpc = get_option('pio_express_xmlrpc');
    if (isset($pio_express_xmlrpc) && $pio_express_xmlrpc) {
        wp_die('XML-RPC is disabled', 'XML-RPC is disabled');
    }
}

add_action('xmlrpc_call', 'pio_express_disable_xmlrpc', 1);
// function for disabling xml-rpc end

// function for disabling rss/feed start
function pio_express_wpb_disable_feed()
{
    $pio_express_rss_feed = get_option('pio_express_rss_feed');
    if (isset($pio_express_rss_feed) && $pio_express_rss_feed) {
        echo 'Feeds are disabled on this website';
        die();
    }
}

add_action('do_feed', 'pio_express_wpb_disable_feed', 1);
add_action('do_feed_rdf', 'pio_express_wpb_disable_feed', 1);
add_action('do_feed_rss', 'pio_express_wpb_disable_feed', 1);
add_action('do_feed_rss2', 'pio_express_wpb_disable_feed', 1);
add_action('do_feed_atom', 'pio_express_wpb_disable_feed', 1);
add_action('do_feed_rss2_comments', 'pio_express_wpb_disable_feed', 1);
add_action('do_feed_atom_comments', 'pio_express_wpb_disable_feed', 1);
// function for disabling rss/feed end


// code for disabling api(s) end

// function to show disable api options start
function pio_express_manageApi()
{

    if (isset($_POST['action'])) {
        if ($_POST['action'] == "api_visiblity") {


            $pio_express_xmlrpc_val = isset($_POST['pio_express_xmlrpc']) ? sanitize_text_field($_POST['pio_express_xmlrpc']) : '';
            update_option('pio_express_xmlrpc', $pio_express_xmlrpc_val);

            $pio_express_rest_api_val = isset($_POST['pio_express_rest_api']) ? sanitize_text_field($_POST['pio_express_rest_api']) : '';
            update_option('pio_express_rest_api', $pio_express_rest_api_val);

            $pio_express_rss_feed_val = isset($_POST['pio_express_rss_feed']) ? sanitize_text_field($_POST['pio_express_rss_feed']) : '';
            update_option('pio_express_rss_feed', $pio_express_rss_feed_val);

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
    ?>
    <?php
    $pio_express_xmlrpc = get_option('pio_express_xmlrpc');
    $pio_express_rest_api = get_option('pio_express_rest_api');
    $pio_express_rss_feed = get_option('pio_express_rss_feed');
    ?>
    <div class='wrap' id='chnage_logo'>
        <h3 id='create-report'>Turn "ON" the options to disable API(s)</h3>
        <form method='post' enctype='multipart/form-data'>
            <input type="hidden" name="action" value="api_visiblity">

            <label for="for_xmlrpc" class="mr-1"><strong>XML-RPC</strong></label>
            <label class="switch">
                <input type="checkbox" name="pio_express_xmlrpc" value="true" id="for_xmlrpc" <?php echo (isset($pio_express_xmlrpc) && $pio_express_xmlrpc) ? 'checked' : '';  ?>>
                <span class="slider round"></span>
            </label><br><br>

            <label for="for_rest_api" class="mr-2"><strong>Rest API</strong></label>
            <label class="switch">
                <input type="checkbox" name="pio_express_rest_api" value="true" id="for_rest_api" <?php echo (isset($pio_express_rest_api) && $pio_express_rest_api) ? 'checked' : ''; ?>>
                <span class="slider round"></span>
            </label><br><br>

            <label for="for_rss" class="mr-3"><strong>RSS</strong></label>
            <label class="switch">
                <input type="checkbox" name="pio_express_rss_feed" value="true" id="for_rss" <?php echo (isset($pio_express_rss_feed) && $pio_express_rss_feed) ? 'checked' : ''; ?>>
                <span class="slider round"></span>
            </label>

            <?php submit_button('Save'); ?>
        </form>
    </div>

<?php } 
// function to show disable api options end
?>
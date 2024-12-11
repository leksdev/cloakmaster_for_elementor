<?php
function cmfe_is_bot_or_user()
{
    // Get plugin options
    $CMFE_OPTIONS = get_option('cmfe_settings_options', array());
    if (empty($CMFE_OPTIONS)) {
        return 'unknown';
    }
    static $visitor_type = null;

    // If the visitor type is already determined, return it
    if ($visitor_type !== null) {
        return $visitor_type;
    }

    // Set the necessary global variables
    $GLOBALS['_ta_campaign_key'] = $CMFE_OPTIONS['cmfe_campaign_key'];
    $GLOBALS['_ta_debug_mode'] = $CMFE_OPTIONS['cmfe_debug_mode'];

    // Include the bootloader
    if (file_exists(plugin_dir_path(__FILE__) . $CMFE_OPTIONS['cmfe_bootloader_name'] . '.php')) {
        require_once plugin_dir_path(__FILE__) . $CMFE_OPTIONS['cmfe_bootloader_name'] . '.php';
    } else {
        error_log('Bootloader file not exist: ' . plugin_dir_path(__FILE__) . $CMFE_OPTIONS['cmfe_bootloader_name'] . '.php');
        return 'unknown';
    }

    // Load the campaign
    $campaign_id = $CMFE_OPTIONS['cmfe_campaign_id'];
    $ta = new TALoader($campaign_id);

    // Check if the response should be suppressed
    if ($ta->suppress_response()) {
        error_log('TALoader suppressed the response.');
        $visitor_type = 'unknown';
        return $visitor_type;
    }

    // Retrieve the response data
    $response = $ta->get_response();
    error_log('TALoader response: ' . print_r($response, true));

    // Determine the visitor type
    $visitor_type = empty($response['cloak_reason']) ? 'user' : 'bot';

    return $visitor_type;
}

// Display the visitor type in the console
add_action('wp_footer', function () {
    $visitor_type = cmfe_is_bot_or_user();
    echo "<script>console.log('CMFE Cloaking from: " . $visitor_type . "');</script>";
}, 100);
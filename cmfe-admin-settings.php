<?php
// Add a menu item for the settings page
add_action('admin_menu', 'cmfe_settings_menu');
function cmfe_settings_menu() {
	add_options_page(
		'CloakMaster for Elementor', // Page title
		'CloakMaster for Elementor', // Menu title
		'manage_options',  // Capability
		'cmfe-settings', // Menu slug
		'cmfe_settings_options_page' // Function to display the page
	);
}

// Display the settings page
function cmfe_settings_options_page() {
	?>
	<div class="wrap">
		<h1>Search Settings</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields('cmfe_settings_group');
			do_settings_sections('cmfe-settings');
			submit_button();
			?>
		</form>
	</div>
	<?php
}

// Register and define the settings
add_action('admin_init', 'cmfe_settings_admin_init');

function cmfe_settings_admin_init() {
	register_setting(
		'cmfe_settings_group', // Option group
		'cmfe_settings_options', // Option name
		'cmfe_settings_sanitize' // Sanitize callback
	);

	add_settings_section(
		'cmfe_settings_section', // ID
		'CloakMaster for Elementor Settings', // Title
		'cmfe_settings_section_text', // Callback
		'cmfe-settings' // Page
	);

	add_settings_field(
		'cmfe_bootloader_name', // ID
		'Bootloader name', // Title
		'cmfe_bootloader_name_input', // Callback
		'cmfe-settings', // Page
		'cmfe_settings_section' // Section
	);

    add_settings_field(
        'cmfe_campaign_id', // ID
        'Campaign ID', // Title
        'cmfe_campaign_id_input', // Callback
        'cmfe-settings', // Page
        'cmfe_settings_section' // Section
    );

    add_settings_field(
        'cmfe_campaign_key', // ID
        'Campaign key', // Title
        'cmfe_campaign_key_input', // Callback
        'cmfe-settings', // Page
        'cmfe_settings_section' // Section
    );

    add_settings_field(
        'cmfe_debug_mode', // ID
        'Debug mode', // Title
        'cmfe_debug_mode_input', // Callback
        'cmfe-settings', // Page
        'cmfe_settings_section' // Section
    );



}

function cmfe_settings_section_text() {
	echo '<p>Configure the CloakMaster for Elementor settings below:</p>';
}

function cmfe_bootloader_name_input() {
	$options = get_option('cmfe_settings_options', array());
	$name = isset($options['cmfe_bootloader_name']) ? $options['cmfe_bootloader_name'] : '';
	echo "<input id='cmfe_bootloader_name' name='cmfe_settings_options[cmfe_bootloader_name]' type='text' value='$name'/>";
}

function cmfe_campaign_id_input() {
    $options = get_option('cmfe_settings_options', array());
    $campaign_id = isset($options['cmfe_campaign_id']) ? $options['cmfe_campaign_id'] : '';
    echo "<input id='cmfe_campaign_id' name='cmfe_settings_options[cmfe_campaign_id]' type='text' value='$campaign_id'/>";
}

function cmfe_campaign_key_input() {
    $options = get_option('cmfe_settings_options', array());
    $campaign_key = isset($options['cmfe_campaign_key']) ? $options['cmfe_campaign_key'] : '';
    echo "<input id='cmfe_campaign_key' name='cmfe_settings_options[cmfe_campaign_key]' type='text' value='$campaign_key'/>";
}


function cmfe_debug_mode_input() {
	$options = get_option('cmfe_settings_options', array());
	$checked = isset($options['cmfe_debug_mode']) &&  $options['cmfe_debug_mode']? 'checked="checked"' : '';
	echo "<input id='cmfe_debug_mode' name='cmfe_settings_options[cmfe_debug_mode]' type='checkbox' $checked />";
}

function cmfe_settings_sanitize($input) {
	$sanitized_input = array();
	$sanitized_input['cmfe_bootloader_name'] = !empty($input['cmfe_bootloader_name']) ? $input['cmfe_bootloader_name'] : '';
	$sanitized_input['cmfe_campaign_id'] = !empty($input['cmfe_campaign_id']) ? $input['cmfe_campaign_id'] : '';
	$sanitized_input['cmfe_campaign_key'] = !empty($input['cmfe_campaign_key']) ? $input['cmfe_campaign_key'] : '';
	$sanitized_input['cmfe_debug_mode'] = !empty($input['cmfe_debug_mode']) ? 1 : 0;
	return $sanitized_input;
}
?>

<?php

// This function determines if visitor is a bot or a user.
if (!function_exists('is_bot_or_user')) {
    require_once plugin_dir_path(__FILE__) . 'cmfe-bot-checker.php';
}

// Add custom controls to Elementor elements
add_action('elementor/element/after_section_end', function($element, $section_id, $args) {
    error_log('Hook triggered for section: ' . $section_id);

    if ( 'section_layout' === $section_id || '_section_style' === $section_id ) {

        $element->start_controls_section(
            'visibility_bot_user',
            [
                'label' => __('Visibility by Bot/User', 'cloakmaster-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'hide_from_bots',
            [
                'label' => __('Hide From Bots', 'cloakmaster-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'cloakmaster-for-elementor'),
                'label_off' => __('No', 'cloakmaster-for-elementor'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $element->add_control(
            'hide_from_users',
            [
                'label' => __('Hide From Users', 'cloakmaster-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'cloakmaster-for-elementor'),
                'label_off' => __('No', 'cloakmaster-for-elementor'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $element->end_controls_section();
    }
}, 10, 3);

// Logic to prevent rendering of elements
function hide_element( $should_render, $element ){
    $settings = $element->get_settings();
    $visitor_type = cmfe_is_bot_or_user(); // 'bot' or 'user'
    $hide_from_bots = !empty($settings['hide_from_bots']) && $settings['hide_from_bots'] === 'yes';
    $hide_from_users = !empty($settings['hide_from_users']) && $settings['hide_from_users'] === 'yes';
    if ($visitor_type === 'bot' && $hide_from_bots) {
        return false;
    }

    if ($visitor_type === 'user' && $hide_from_users) {
        return false;
    }

    return $should_render;

}

// Hide any widgets
add_filter( 'elementor/frontend/widget/should_render', 'hide_element', 10, 3);

// Hide any sections
add_filter( 'elementor/frontend/section/should_render', 'hide_element', 11, 3); //needs priority > 10


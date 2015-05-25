<?php
/*
  Plugin Name: WordPress Music plugin by righTune
  Plugin URI: http://www.rightune.com
  Description: WordPress Music is the easiest way to play background music on your WordPress website. Engage your users emotionally by playing relevant, customized background music on your websites. 
  Version: 1.0.2
  Author: righTune
  Author URI: http://www.rightune.com
 */

// add the admin options page
add_action('admin_menu', 'rightune_admin_add_page');

function rightune_admin_add_page() {
    add_options_page('righTune Settings', 'WordPress Music', 'manage_options', 'rightune', 'rightune_options_page');
}

// display the admin options page
function rightune_options_page() {
    ?>

    <div>
        <h2><?php _e('WordPress Music plugin by righTune','righttune'); ?></h2>
        <p>
	WordPress Music is the easiest way to play background music on your WordPress website. Engage your users emotionally by playing relevant, customized background music on your websites. Sign up for FREE at 		<a href="http://dashboard.rightune.com/signup?tag=wp" target="_blank">this page</a>.	
	</p>
	<p>
	<strong>Follow this steps</strong> to generate your own unique player:
	<ol>
		<li>Go to righTune's <a href="http://dashboard.rightune.com/signup?tag=wp" target="_blank">sign up page</a> to customize your player.</li>	
		<li> Copy the code you'll get at the last step.</li>
		<li>Paste code at this box and Click the Save Changes button below.</li>
	</ol>
	</p>
        <form action="options.php" method="post">
            <?php settings_fields('rightune_options'); ?>
            <?php do_settings_sections('rightune'); ?>

            <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
        </form></div>

    <?php
}

// add the admin settings and such
add_action('admin_init', 'rightune_admin_init');

function rightune_admin_init() {
    register_setting('rightune_options', 'rightune_options', 'rightune_options_validate');
    add_settings_section('plugin_main', 'Script Settings', 'rightune_section_text', 'rightune');
    add_settings_field('plugin_script_code', 'Paste script code here', 'rightune_setting_string', 'rightune', 'plugin_main');
}

function rightune_section_text() {
    _e('','rightune');
}

function rightune_setting_string() {
    $options = get_option('rightune_options');
    echo "<textarea rows='4' cols='50' id='plugin_script_code' name='rightune_options[script_code]'>{$options['script_code']}</textarea>";
}

// validate our options (doing nothing here...)
function rightune_options_validate($input) {
    $options = get_option('rightune_options');
    $options['script_code'] = trim($input['script_code']);
    return $options;
}

// ACtually doing something

add_action('wp_head', 'rightune_add_script');

function rightune_add_script() {
    $options = get_option('rightune_options');
    echo $options['script_code'];
}

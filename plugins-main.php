<?php 
/*
Plugin Name: RKP Awesome Preloader
Plugin URI: http://www.facebond.com/plugins/rkp-awesome-preloader/
Description: This is awesome preloader plugins. This plugins make nice effect like google inbox style effects when your website is loading. 
Author: Rejaul Karim Polin
Version: 1.0
Author URI: http://www.facebond.com
*/
 
/* Latest jQuery from Wordpress */
function rkp_awesome_preloader_latest_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'rkp_awesome_preloader_latest_jquery');


/* Extra jQuery & CSS file include */
function my_preloader_scripts_method() {
	define('rkp_awesome_preloader_wp', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

	wp_enqueue_script('rkp-awesome-preloader-js', rkp_awesome_preloader_wp . 'js/awesomePreloader.min.js', array('jquery'));
	wp_enqueue_style('rkp-awesome-preloader-font-awesome-css', rkp_awesome_preloader_wp . 'css/awesomePreloader.css');
	wp_enqueue_style('rkp-awesome-cpreloader-custom-css', rkp_awesome_preloader_wp . 'css/style.css');
}

add_action( 'wp_enqueue_scripts', 'my_preloader_scripts_method' );

/* Color Picker Jquery */
function preloader_color_picker_fucntion( $hook_suffix ) {
	define('rkp_awesome_preloader_wp', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'my-color-field', plugins_url( 'js/color_picker_javascript.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), false, true );
	wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'preloader_color_picker_fucntion' );

function add_awesome_preloader_options()
{
	add_options_page('RKP Awesome Preloader Options', 'Preloader Options', 'manage_options', 'preloader-settings', 'rkp_awesome_preloader_options');
}
add_action('admin_menu', 'add_awesome_preloader_options');


// Default values
$preloader_options = array(
	'preloader_position' => 'bottom',
	'preloader_height' => '20px',
	'preloader_col_1' => '#159756',
	'preloader_col_2' => '#da4733',
	'preloader_col_3' => '#3b78e7',
	'preloader_col_4' => '#fdba2c',
	'preloader_fadeIn' => 1000,
	'preloader_fadeOut' => 1000
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function rkp_awesome_preloader_settings() {
	// Register settings and call sanitation function
	register_setting( 'rkp_awesome_preloader_options', 'preloader_options', 'preloader_validate_options' );
}
add_action( 'admin_init', 'rkp_awesome_preloader_settings' );

/* Preloader position */
$preloader_position = array(
	'position_top' => array(
		'value' => 'top',
		'label' => 'Top'
	),
	'position_bottom' => array(
		'value' => 'bottom',
		'label' => 'Bottom'
	)
);

// Function to generate options page
function rkp_awesome_preloader_options() {
	global $preloader_options,$preloader_position;
	
	if ( !isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>


	<div class="wrap">
	
	<h2>RKP: Awesome Preloader</h2>
	<h3>Set your poreloader</h3>	
	<form method="post" action="options.php">
	<?php $settings = get_option( 'preloader_options', $preloader_options); ?>
	<?php settings_fields( 'rkp_awesome_preloader_options' ); ?>
	<table class="form-table">
		<tr>
		<td align="center"><input type="submit" class="button-secondary" name="preloader_options[back_as_default]" value="Back as default" /></td>
			<td colspan="2"><input type="submit" class="button-primary" value="Save Settings" /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="preloader_position">Preloader Position</label></th>
			<td>
				<?php foreach( $preloader_position as $activate ) : ?>
				<input type="radio" id="<?php echo $activate['value']; ?>" name="preloader_options[preloader_position]" value="<?php esc_attr_e( $activate['value'] ); ?>" <?php checked( $settings['preloader_position'], $activate['value'] ); ?> />
				<label for="<?php echo $activate['value']; ?>"><?php echo $activate['label']; ?></label><br />
				<?php endforeach; ?>
			</td>
		</tr>		
		<tr valign="top">
			<th scope="row"><label for="preloader_height">Preloader Height</label></th>
			<td>
				<input  id='preloader_height' type="text" name="preloader_options[preloader_height]" value="<?php echo stripslashes($settings['preloader_height']); ?>" />
				<p class="description">You can set here preloader height. Default value is 20px.</p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="preloader_color1">Preloader Color 1</label></th>
			<td>
				<input  id='preloader_color1' type="text" name="preloader_options[preloader_col_1]" value="<?php echo stripslashes($settings['preloader_col_1']); ?>" class="my-color-field" />
				<p class="description">Change your preloader Color. You can add html HEX color code. Default color is #159756</p>
			</td>
		</tr>	
		<tr valign="top">
			<th scope="row"><label for="preloader_color2">Preloader Color 2</label></th>
			<td>
				<input  id='preloader_color2' type="text" name="preloader_options[preloader_col_2]" value="<?php echo stripslashes($settings['preloader_col_2']); ?>" class="my-color-field" />
				<p class="description">Change your preloader Color. You can add html HEX color code. Default color is #da4733</p>
			</td>
		</tr>
		<tr valign="top">
				<th scope="row"><label for="preloader_color3">Preloader Color 3</label></th>
				<td>
					<input  id='preloader_color3' type="text" name="preloader_options[preloader_col_3]" value="<?php echo stripslashes($settings['preloader_col_3']); ?>" class="my-color-field" />
					<p class="description">Change your preloader Color. You can add html HEX color code. Default color is #3b78e7</p>
				</td>
			</tr>
		<tr valign="top">
				<th scope="row"><label for="preloader_color4">Preloader Color 4</label></th>
				<td>
					<input  id='preloader_color4' type="text" name="preloader_options[preloader_col_4]" value="<?php echo stripslashes($settings['preloader_col_4']); ?>" class="my-color-field" />
					<p class="description">Change your preloader Color. You can add html HEX color code. Default color is #fdba2c</p>
				</td>
			</tr>
		<tr valign="top">
			<th scope="row"><label for="feedin_speed">Preloader Speed FadeIn</label></th>
			<td>
				<input id="feedin_speed" type="text" name="preloader_options[preloader_fadeIn]" value="<?php echo stripslashes($settings['preloader_fadeIn']); ?>" />
				<p class="description">You can set here feedIn speed, default is 1000.</p>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="feedout_speed">Preloader Speed FadeOut</label></th>
			<td>
				<input id="feedout_speed" type="text" name="preloader_options[preloader_fadeOut]" value="<?php echo stripslashes($settings['preloader_fadeOut']); ?>" />
				<p class="description">You can set here feedOut speed, default is 1000.</p>
			</td>
		</tr>
		<tr>
			<td align="center"><input type="submit" class="button-secondary" name="preloader_options[back_as_default]" value="Back as default" /></td>
			<td colspan="2"><input type="submit" class="button-primary" value="Save Settings" /></td>
		</tr>
	</table>
	</form>	
	</div>
	<?php
}

// Inputs validation, if fails validations replace by default values.
function preloader_validate_options( $input ) {
	global $preloader_options,$preloader_position;
	
	$settings = get_option( 'preloader_options', $preloader_options );
	
	// We strip all tags from the text field, to avoid Vulnerabilities like XSS
	
	$input['preloader_position'] = isset( $input['back_as_default'] ) ? 'bottom' : wp_filter_post_kses( $input['preloader_position'] );
	$input['preloader_height'] = isset( $input['back_as_default'] ) ? '20px' : wp_filter_post_kses( $input['preloader_height'] );
	$input['preloader_col_1'] = isset( $input['back_as_default'] ) ? '#159756' : wp_filter_post_kses( $input['preloader_col_1'] );
	$input['preloader_col_2'] = isset( $input['back_as_default'] ) ? '#da4733' : wp_filter_post_kses( $input['preloader_col_2'] );
	$input['preloader_col_3'] = isset( $input['back_as_default'] ) ? '#3b78e7' : wp_filter_post_kses( $input['preloader_col_3'] );
	$input['preloader_col_4'] = isset( $input['back_as_default'] ) ? '#fdba2c' : wp_filter_post_kses( $input['preloader_col_4'] );	
	$input['preloader_fadeIn'] = isset( $input['back_as_default'] ) ? 1000 : wp_filter_post_kses( $input['preloader_fadeIn'] );	
	$input['preloader_fadeOut'] = isset( $input['back_as_default'] ) ? 1000 : wp_filter_post_kses( $input['preloader_fadeOut'] );	
	return $input;
}

endif;		// Endif is_admin()

function rkp_awesome_preloader_active() { ?>

<?php global $preloader_options; $preloader_settings = get_option( 'preloader_options', $preloader_options ); ?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
	   preloader = new $.materialPreloader({
        position: '<?php echo $preloader_settings['preloader_position']; ?>',
        height: '<?php echo $preloader_settings['preloader_height']; ?>',
        col_1: '<?php echo $preloader_settings['preloader_col_1']; ?>',
        col_2: '<?php echo $preloader_settings['preloader_col_2']; ?>',
        col_3: '<?php echo $preloader_settings['preloader_col_3']; ?>',
        col_4: '<?php echo $preloader_settings['preloader_col_4']; ?>',
        fadeIn: <?php echo $preloader_settings['preloader_fadeIn']; ?>,
        fadeOut: <?php echo $preloader_settings['preloader_fadeOut']; ?>
    });
	$(window).load(function() {
      preloader.off();
	});
    preloader.on();
	});
</script>

<?php
}
add_action('wp_head', 'rkp_awesome_preloader_active');
?>
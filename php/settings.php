<?php
/***
*
*
***Neccessary loads***/

function my_plugin_menu() {
	global $el_settings;
	$el_settings = add_menu_page(__('Effect Library', 'e'), __('Effects Library', 'el'), 'manage_options', 'admin-effects-library', 'el_render_admin');

	?>  
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<?php
}
add_action('admin_menu', 'my_plugin_menu');

function el_load_scripts($hook){
	global $el_settings;

	if($hook != $el_settings){
		return;
	}else{
		wp_enqueue_script('el-ajax', plugin_dir_url(__FILE__) . '../js/el-ajax.js', array('jquery'));
		wp_enqueue_script('el-funcs', plugin_dir_url(__FILE__) . '../js/functions.js', array('jquery'));
		wp_localize_script('el-ajax', 'el_vars', array(
			'el_nonce' => wp_create_nonce('el-nonce')
			)
		);
	}
	
}
add_action('admin_enqueue_scripts', 'el_load_scripts');

function el_load_frontEnd_script(){
	wp_enqueue_script('el-effects', plugin_dir_url(__FILE__) . '../js/effects.js', array('jquery'));
}
add_action('init', 'el_load_frontEnd_script');

/***
*
*
***Process function calls***/

function el_process_ajax_functions(){

	if(!isset($_POST['el_nonce']) || !wp_verify_nonce($_POST['el_nonce'], 'el-nonce')){
		die('Permissions check failed');
	}

	if(isset($_REQUEST['div_choice'])) { $div_choice = $_REQUEST['div_choice']; }
	if(isset($_REQUEST['div_choice_apply'])) { $div_choice_apply  = $_REQUEST['div_choice_apply']; }
	if(isset($_REQUEST['color'])) { $color = $_REQUEST['color']; }
	if(isset($_REQUEST['effect_choice'])) { $effect_choice = $_REQUEST['effect_choice']; }
	if(isset($_REQUEST['effect_choice_custom'])) { $effect_choice_custom = $_REQUEST['effect_choice_custom']; }
	if(isset($_REQUEST['event_choice'])) { $event_choice = $_REQUEST['event_choice']; }
	if(isset($_REQUEST['property'])) { $property = $_REQUEST['property']; }
	if(isset($_REQUEST['property_value'])) { $property_value  = $_REQUEST['property_value']; }
	if(isset($_REQUEST['place_to_scroll'])) { $place_to_scroll  = $_REQUEST['place_to_scroll']; }
	if(isset($_REQUEST['speed'])) { $speed  = $_REQUEST['speed']; }
	if(isset($_REQUEST['a_class'])) { $a_class = $_REQUEST['a_class']; }
	if(isset($_REQUEST['cur_background'])) { $cur_background  = $_REQUEST['cur_background']; }
	if(isset($_REQUEST['min_fade_opacity'])) { $min_fade_opacity  = $_REQUEST['min_fade_opacity']; }
	if(isset($_REQUEST['min_new_fade_in_opacity'])) { $min_new_fade_in_opacity  = $_REQUEST['min_new_fade_in_opacity']; }
	if(isset($_REQUEST['max_new_fade_in_opacity'])) { $max_new_fade_in_opacity  = $_REQUEST['max_new_fade_in_opacity']; }
	if(isset($_REQUEST['start_fade_out'])) { $start_fade_out  = $_REQUEST['start_fade_out']; }
	if(isset($_REQUEST['stop_fade_out'])) { $stop_fade_out  = $_REQUEST['stop_fade_out']; }
	if(isset($_REQUEST['new_background'])) { $new_background  = $_REQUEST['new_background']; }
	if(isset($_REQUEST['start_new_fade_in'])) { $start_new_fade_in  = $_REQUEST['start_new_fade_in']; }
	if(isset($_REQUEST['y_from_top_full_opacity'])) { $y_from_top_full_opacity  = $_REQUEST['y_from_top_full_opacity']; }



	

	switch ($effect_choice) {
		case 'special':
			switch ($effect_choice_custom) {
				case 'menu-change-fade-color-scroll-down':
					$content = menu_fade_scroll_down_down($div_choice, $min_fade_opacity, $start_fade_out, $stop_fade_out, $start_new_fade_in, $y_from_top_full_opacity, $cur_background, 
					$new_background, $min_new_fade_in_opacity, $max_new_fade_in_opacity);

					write_to_jsfile($content);
					break;
				
				default:
					echo "Something went wrong! Please don't mess around with the html code.";
					break;
			}
			break;
		case 'on-page-load':
			switch ($effect_choice_custom) {
				case 'css':
					$content = css_customization_writejs($div_choice, $div_choice_apply, $event_choice, $effect_choice_custom, $property, $property_value);
					write_to_jsfile($content);
					break;
				
				default:
					echo "Something went wrong! Please don't mess around with the html code.";
					break;
			}
			break;
		case 'full-width-viewport':
			$content = full_viewport($div_choice);
			write_to_jsfile($content); 
			break;
		case 'customize':
			switch ($effect_choice_custom) {
				case 'toggleClass':
				case 'removeClass':
				case 'addClass':
					$content = class_func($div_choice, $div_choice_apply, $a_class, $event_choice, $effect_choice_custom);
					write_to_jsfile($content);
					break;
				case 'fadeToggle':
				case 'fadeOut':
				case 'fadeIn':
					$content = fade_in_out_toggle_func($div_choice, $event_choice, $div_choice_apply, $effect_choice_custom, $speed);
					write_to_jsfile($content);
					break;
				case 'empty':
				case 'remove':
					$content = remove_empty_func($div_choice, $event_choice, $div_choice_apply, $effect_choice_custom);
					write_to_jsfile($content);
					break;
				case 'slideToggle':
				case 'slideUp':
				case 'slideDown':
					$content = slide_down_up_toggle_func($div_choice, $event_choice, $div_choice_apply, $effect_choice_custom, $speed);
					write_to_jsfile($content);
					break;
				case 'toggle':
				case 'show':
				case 'hide':
					$content = hide_show_func($div_choice, $event_choice, $div_choice_apply, $effect_choice_custom);
					write_to_jsfile($content);
					break;
				case 'scrollTo':
					$content = scroll_to($div_choice, $event_choice, $place_to_scroll, $speed);
					write_to_jsfile($content);
					break;
				case 'css':
					$content = css_customization_writejs($div_choice, $div_choice_apply, $event_choice, $effect_choice_custom, $property, $property_value);
					write_to_jsfile($content);
					break;
				
				default:
					echo "Something went wrong! Please don't mess around with the html code.";
					break;
			}
			break;
		case 'text-high-light':
			$content = text_highlight($div_choice, $color);
			write_to_jsfile($content);
		break;
		
		default:
			echo "Something went wrong! Please don't mess around with the html code.";
		break;
	}


	die();
}
add_action('wp_ajax_el_save_config', 'el_process_ajax_functions');

/***
*
*
***Process main component calls***/

function el_process_ajax_main_comp(){
	if(!isset($_POST['el_nonce']) || !wp_verify_nonce($_POST['el_nonce'], 'el-nonce')){
		die('Permissions check failed');
	}

	$effect_choice = $_REQUEST['effect_choice'];


	switch ($effect_choice) {
		case '':
		echo "Please select an option above.";
			break;
		case 'special':
			special_comp();
			break;
		case 'on-page-load':
			on_page_load_comp();
			break;
		case 'full-width-viewport':
			full_width_viewport_comp();
			break;
		case 'customize':
			customize_custom_comp();
			break;
		case 'text-high-light':
			text_highlight_comp();
			break;
		
		default:
			echo "Please select an option above.";
		break;
	}


	die();
}
add_action('wp_ajax_el_get_main_comps', 'el_process_ajax_main_comp');

/***
*
*
***Process sub component calls***/

function el_process_ajax_sub_comp(){
	if(!isset($_POST['el_nonce']) || !wp_verify_nonce($_POST['el_nonce'], 'el-nonce')){
		die('Permissions check failed');
	}

	$effect_customization = $_REQUEST['effect_customization'];

	switch ($effect_customization) {
		case 'toggleClass':
		case 'removeClass':
		case 'addClass':
			class_sub_comp();
			break;
		case 'menu-change-fade-color-scroll-down':
			 menu_change_fade_color_scroll_down_sub_comp();
			break;
		case 'fadeToggle':
		case 'fadeIn':
		case 'fadeOut':
			fade_in_out_toggle_sub_comp();
			break;
		case 'empty':
		case 'remove':
			remove_empty_sub_comp();
			break;
		case 'slideToggle':
		case 'slideUp':
		case 'slideDown':
			slide_down_up_toggle_sub_comp();
			break;
		case 'toggle':
		case 'show':
		case 'hide':
			hide_show_sub_comp();
			break;
		case 'scrollTo':
			scroll_to_customization_sub_comp();
			break;
		case 'css':
			css_customization_sub_comp();
			break;
		default:
			echo "No customization available";
		break;
	}


	die();
}
add_action('wp_ajax_el_get_sub_comps', 'el_process_ajax_sub_comp');

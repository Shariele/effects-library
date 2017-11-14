<?php

function class_func($div_choice, $div_choice_apply, $a_class, $event_choice, $effect_choice_custom){
	$content = 
"\n
//Adds/removes or toggles a class.
$(document).ready( function (){
	$(document).on('".$event_choice."', '".$div_choice."', function() {
		$('".$div_choice_apply."').".$effect_choice_custom."('".$a_class."');
	});
});
";

	return $content;
}

function menu_fade_scroll_down_down($div_choice, $min_fade_opacity, $start_fade_out, $stop_fade_out, $start_new_fade_in, $y_from_top_full_opacity, $cur_background, $new_background
	, $min_new_fade_in_opacity, $max_new_fade_in_opacity){
	$content =
"\n
//Creates an effect where the given element(prefferably header) vill fade out from view and enter as a new color that fades into view.
$(document).ready( function (){
	//Creates a clone of the original element.
	var divClone = $('".$div_choice."').clone();
	$(window).scroll(function() {
		//Takes the current pixel value based on how far from the window top the scroll is.
		var y = $(this).scrollTop();
		if($(this).scrollTop() > ".$start_fade_out." && $(this).scrollTop() <= ".$stop_fade_out."){
			//b compensates the opacity per pixel value based on start opacity.
			var b = (".$start_fade_out." * ".$min_fade_opacity.");
			//Calculates the opacity to decrease current opacity with, per scrolled pixel.
			var a = (".$start_fade_out." / ((".$stop_fade_out." - b) - (".$start_fade_out." + b)));
			//Calculates the number of pixels since the activation of the fade out part.
			var n = (y - ".$start_fade_out.");
			//Sets a new opacity based on the scroll position.
			var opacity = ((".$start_fade_out." - (a * n)) + ".$min_fade_opacity.");
			
			//Safety measure to ensure that the fade stays at exactly the given min fade value at max scroll for function.
			if(opacity <= ".$min_fade_opacity."){
				opacity = ".$min_fade_opacity.";
			}else if(opacity >= 1){
				opacity = 1;
			}
			$('".$div_choice."').css('background', 'rgba(".$cur_background.",'+opacity+'');

		}else if ($(this).scrollTop() > ".$start_new_fade_in." && $(this).scrollTop() <= ".$y_from_top_full_opacity.") {
			//b compensates the opacity per pixel value based on start opacity.
			var b = (".$start_new_fade_in." * ".$min_new_fade_in_opacity.");
			//Calculates the opacity to decrease current opacity with, per scrolled pixel.
			var a = ((".$start_new_fade_in." + b) / ((".$y_from_top_full_opacity." + b) - (".$start_new_fade_in." - b)));
			//Calculates the number of pixels since the activation of the fade out part.
			var n = (y - ".$start_new_fade_in.");
			//Sets a new opacity based on the scroll position.
			var opacity = (((a * n) / ".$start_new_fade_in.") + ".$min_new_fade_in_opacity.")

			//Safety measure to ensure that the fade stays at exactly the given min or max fade value at min/max scroll for function.
			if(opacity <= ".$min_new_fade_in_opacity."){
				opacity = ".$min_new_fade_in_opacity.";
			}else if(opacity >= ".$max_new_fade_in_opacity."){
				opacity = ".$max_new_fade_in_opacity.";
			}
	        $('".$div_choice."').css('background', 'rgba(".$new_background.",'+opacity+'');

	    }else if($(this).scrollTop() < ".$start_fade_out."){
	    	//If the scroll position is under given pixel value, replace current modified element with original one.
			$('".$div_choice."').replaceWith(divClone.clone());
	    }
	});	
});
";

return $content;
}

function remove_empty_func($div_choice, $event_choice, $div_choice_apply, $effect_choice_custom){
	if($event_choice != "scroll"){
	$content = 
"\n
//Removes selectet element or empties element content.
$(document).ready( function (){
	$(document).on('".$event_choice."', '".$div_choice."', function() {
		$('".$div_choice_apply."').".$effect_choice_custom."();
	});
});
";
}else{
		$content = 
"\n
//Removes selectet element or empties element content.
$(document).ready( function (){
	$(document).on('".$event_choice."', window, function() {
		$('".$div_choice_apply."').".$effect_choice_custom."();
	});
});
";
}

return $content;
}

function fade_in_out_toggle_func($div_choice, $event_choice, $div_choice_apply, $effect_choice_custom, $speed){
	if($event_choice != "scroll"){
	$content = 
"\n
//Slides the selected element up or down.
$(document).ready( function (){
	$(document).on('".$event_choice."', '".$div_choice."', function() {
		$('".$div_choice_apply."').".$effect_choice_custom."(".$speed.");
	});
});
";
}else{
	$content = 
"\n
//Slides the selected element up or down.
$(document).ready( function (){
	$(document).on('".$event_choice."', window, function() {
		$('".$div_choice_apply."').".$effect_choice_custom."(".$speed.");
	});
});
";
}

return $content;
}

function slide_down_up_toggle_func($div_choice, $event_choice, $div_choice_apply, $effect_choice_custom, $speed){
	if($event_choice != "scroll"){
	$content = 
"\n
//Slides the selected element up or down.
$(document).ready( function (){
	$(document).on('".$event_choice."', '".$div_choice."', function() {
		$('".$div_choice_apply."').".$effect_choice_custom."(".$speed.");
	});
});
";
}else{
	$content = 
"\n
//Slides the selected element up or down.
$(document).ready( function (){
	$(document).on('".$event_choice."', window, function() {
		$('".$div_choice_apply."').".$effect_choice_custom."(".$speed.");
	});
});
";
}

return $content;
}

function hide_show_func($div_choice, $event_choice, $div_choice_apply, $effect_choice_custom){
	if($event_choice != "scroll"){
	$content = 
"\n
//Hides or shows the selected element.
$(document).ready( function (){
	$(document).on('".$event_choice."', '".$div_choice."', function() {
		$('".$div_choice_apply."').".$effect_choice_custom."();
	});
});
";
}else{
	$content = 
"\n
//Hides or shows the selected element.
$(document).ready( function (){
	$(document).on('".$event_choice."', window, function() {
		$('".$div_choice_apply."').".$effect_choice_custom."();
	});
});
";
}

return $content;
}


function text_highlight($div_choice, $color){
	if($event_choice != "scroll"){
	$content = 
"\n
//Highlights selected div id or class.
$(document).ready( function (){
	$('".$div_choice."').hover( function(){
		$(this).css('color', '".$color."');	
	}, function() {
		$(this).css('color', '');
	});
});
";
}else{
	$content = 
"\n
//Highlights selected div id or class.
$(document).ready( function (){
	$('".$div_choice."').hover( function(){
		$(this).css('color', '".$color."');	
	}, function() {
		$(this).css('color', '');
	});
});
";
}

	return $content;
}


function css_customization_writejs($div_choice, $div_choice_apply, $event_choice, $effect_choice_custom, $property, $property_value){
	if($event_choice != "scroll"){
	$content =
"\n
//Applies a css effect(".$effect_choice_custom.") on chosen event(".$event_choice.").
$(document).ready(function (){
	$(document).on('".$event_choice."', '".$div_choice."', function() {
		$('".$div_choice_apply."').".$effect_choice_custom."('".$property."', '".$property_value."');
	});
});
";
}else{
	$content =
"\n
//Applies a css effect(".$effect_choice_custom.") on chosen event(".$event_choice.").
$(document).ready(function (){
	$(document).on('".$event_choice."', '".$div_choice."', function() {
		$('".$div_choice_apply."').".$effect_choice_custom."('".$property."', '".$property_value."');
	});
});
";
}

return $content;
}

function scroll_to($div_choice, $event_choice, $place_to_scroll, $speed){
	if($place_to_scroll == "top" ){
	$content =
"\n
//Scrolls the window to given element
$(document).ready(function (){
	//Checks if there exists an element.
	if($('".$div_choice."').length){
		$(document).on('".$event_choice."', '".$div_choice."', function (){
	        $('html, body').animate({ 
	        	scrollTop: 0 
	        }, ".$speed.");
	    });
	}else{
		alert('Element(".$div_choice.") not found, cannot activate effect. Please delete existing function and create a new with an existing element, or change the affected element in the effect.js file located in the Effects Library plugin folder.');
	}
});
";
}else if($event_choice != "scroll"){
	$content =
"\n
//Scrolls the window to given element
$(document).ready(function (){
	var nav = $('".$place_to_scroll."');
	if(nav.length){
		$(document).on('".$event_choice."', '".$div_choice."', function (){
	        $('html, body').animate({ 
	        	scrollTop: $('".$place_to_scroll."').offset().top 
	        }, ".$speed.");
	    });
	}else{
		$(document).on('".$event_choice."', '".$div_choice."', function (){
			alert('Assigned div got no top or does not contain any element with class/div: ".$place_to_scroll.". Please use another div for this purpose and delete or modify this function.');
		});
	}
});
";
}else{
	$content =
"\n
//Scrolls the window to given element
$(document).ready(function (){
	var nav = $('".$place_to_scroll."');
	if(nav.length){
		$(document).on('".$event_choice."', '".$div_choice."', function (){
	        $('html, body').animate({ 
	        	scrollTop: $('".$place_to_scroll."').offset().top 
	        }, ".$speed.");
	    });
	}else{
		$(document).on('".$event_choice."', '".$div_choice."', function (){
			alert('Assigned div got no top or does not contain any element with class/div: ".$place_to_scroll.". Please use another div for this purpose and delete or modify this function.');
		});
	}
});
";
}

	return $content;

}

//Function for writing to effects file.
function write_to_jsfile($content){

	$jsfile = WP_PLUGIN_DIR."/effects-library/js/effects.js";

	
	$current = file_get_contents($jsfile);

	$current = $content . $current;

	file_put_contents($jsfile, $current);

}
?>
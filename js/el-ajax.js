
//Save configuration
$(document).ready(function(){
	$('#wpbody-content').on('click','#highlight-submit', function(){

		//Checks that all textboxes and dropdowns have a value.
		var nr = 0;
		$('.form-control').each(function(){
			if($(this).val() != ""){
				nr = nr;
			}else{
				nr += 1;
			}
		});

		//If they have a value proceed to gathering data, else alert the user.
		if($('.form-control').val() != "" && nr === 0){

			$('#highlight-submit').attr('disabled',true);
			$('#func-loading').show();

			//Specifies where to start building effect.
			var effect_choice = $('#effect-choice').val();
			//On specific values.
			var event_choice = $('#event-choice').val();
			var effect_choice_custom = $('#effect-choice-custom').val();

			//Id or class from where to activate.
			var div_choice = $('#div-choice').val();
			//Where to apply effect.
			var div_choice_apply = $('#div-choice-apply').val();

			//Text highlight specific values.
			var color = $('#choice-color').val();
			//Css specific values.
			var property = $('#css-property').val();
			var property_value = $('#property-value').val();
			//ScrollTo specific values.
			var place_to_scroll = $('#scroll-to-div').val();
			var speed = $('#animation-speed').val();
			//addClass, removeClass, toggleClass specific values
			var a_class =  $('#class').val();

			//Scroll menu-fade-color... values.
			var cur_background = $('#cur-background').val();
			var min_fade_opacity = $('#min-fade-opacity').val();
			var min_new_fade_in_opacity = $('#min-new-fade-in-opacity').val();
			var max_new_fade_in_opacity = $('#max-new-fade-in-opacity').val();
			var start_fade_out = $('#start-fade-out').val();
			var stop_fade_out = $('#stop-fade-out').val();
			var new_background = $('#new-background').val();
			var start_new_fade_in = $('#start-new-fade-in').val();
			var y_from_top_full_opacity = $('#y-from-top-full-opacity').val();


			data = {
				action: 'el_save_config',
				el_nonce: el_vars.el_nonce ,
				div_choice: div_choice,
				div_choice_apply: div_choice_apply,
				effect_choice: effect_choice,
				event_choice: event_choice,
				effect_choice_custom: effect_choice_custom,
				color: color,
				property: property,
				property_value: property_value,
				place_to_scroll: place_to_scroll,
				speed: speed,
				a_class: a_class,
				cur_background: cur_background,
				min_fade_opacity: min_fade_opacity,
				min_new_fade_in_opacity: min_new_fade_in_opacity,
				max_new_fade_in_opacity: max_new_fade_in_opacity,
				start_fade_out: start_fade_out,
				stop_fade_out: stop_fade_out ,
				new_background: new_background,
				start_new_fade_in: start_new_fade_in,
				y_from_top_full_opacity: y_from_top_full_opacity,
			};
		
			$.post(ajaxurl, data, function(response){
				$('#effects-result').html(response);
				$('#components').html('Done! The effect as been registered and is now in use!');
				$('#highlight-submit').attr('disabled',false);
				$('#func-loading').hide();
			});
		}else{
			alert('Please give all textfields and dropdowns a value/option!');
		}
		

		return false;
	});
});

//Get main components
$(document).ready(function(){
	$('#effect-choice, #attribute-choice').on('change', function(){

		$('#comp-loading').show();

		//Because of lazyness, javascript doesn't work well with "-" in the code so here it converts them to "_" and removes old text from the descriptions.
		var effect_choice = $('#effect-choice').val();
		if(effect_choice === ""){
			var object_info = main_component_information['zero'];
			var object_info_event = event_component_information['zero'];
		}else if(effect_choice === 'text-high-light'){
			var object_info = main_component_information['text_highlight'];
			var object_info_event = event_component_information['zero'];
		}else{
			var object_info = main_component_information[effect_choice];
			var object_info_event = event_component_information['zero'];
		}

		data = {
			action: 'el_get_main_comps',
			el_nonce: el_vars.el_nonce,
			effect_choice: effect_choice,
		};

		$.post(ajaxurl, data, function(response){
			$('#components').html(response);
			$('.effectDescription').show();
			$('#information').html(object_info.information);
			$('#eventInformation').html(object_info_event.information);
			$('#comp-loading').hide();
		});

		return false;
	});
});

//Get sub components
$(document).ready(function(){
	$('#wpbody-content').on('change', '#effect-choice-custom', function(){

		$('#sub-comp-loading').show();

		//Because of lazyness, javascript doesn't work well with "-" in the code so here it converts them to "_" and removes old text from the descriptions.
		var effect_customization = $('#effect-choice-custom').val();
		if(effect_customization === "menu-change-fade-color-scroll-down"){
			var object_info = sub_component_information['menu_change_fade_color_scroll_down'];
		}else if(effect_customization === ""){
			var object_info = sub_component_information['zero'];
		}else{
			var object_info = sub_component_information[effect_customization];
		}

		data = {
			action: 'el_get_sub_comps',
			el_nonce: el_vars.el_nonce,
			effect_customization: effect_customization,
		};

		$.post(ajaxurl, data, function(response){
			$('#customization-effects').html(response);
			$('.effectDescription').show();
			$('#information').html(object_info.information);
			//$('#eventInformation').html(object_info_event.information);
			$('#sub-comp-loading').hide();
		});

		return false;
	});
});

//Show event description 
$(document).ready(function(){
	$('#wpbody-content').on('change', '#event-choice', function(){

		$('#sub-comp-loading').show();

		var event_customization = $('#event-choice').val();

		if(event_customization === ""){
			var object_info = event_component_information['zero'];
		}else{
			var object_info_event = event_component_information[event_customization];
		}

		data = {
			action: 'el_get_sub_comps',
			el_nonce: el_vars.el_nonce
		};

		$.post(ajaxurl, data, function(){
			$('.eventDescription').show();
			$('#eventInformation').html(object_info_event.information);
			$('#sub-comp-loading').hide();
		});

		return false;
	});
});

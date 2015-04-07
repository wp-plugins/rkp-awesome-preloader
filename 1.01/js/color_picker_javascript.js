jQuery(document).ready(function($){
	$('#preloader_color1').wpColorPicker({
		change: function( event, ui ) {
			$("#preloader_color1").css('background', ui.color.toString());
		},
		clear: function() {
			$("#preloader_color1").css('background', '');
		}
	});
	$('#preloader_color2').wpColorPicker({
		change: function( event, ui ) {
			$("#preloader_color2").css('background', ui.color.toString());
		},
		clear: function() {
			$("#preloader_color2").css('background', '');
		}
	});
	$('#preloader_color3').wpColorPicker({
		change: function( event, ui ) {
			$("#preloader_color3").css('background', ui.color.toString());
		},
		clear: function() {
			$("#preloader_color3").css('background', '');
		}
	});
	$('#preloader_color4').wpColorPicker({
		change: function( event, ui ) {
			$("#preloader_color4").css('background', ui.color.toString());
		},
		clear: function() {
			$("#preloader_color4").css('background', '');
		}
	});

});
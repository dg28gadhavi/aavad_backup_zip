jQuery(document).ready(function($){
    $('.pl-color-picker').wpColorPicker({
		change: function(event, ui) {
			var thecpinput = $(this);
			setTimeout(function() {
				thecpinput.parents('form').trigger('change');		
			}, 100);
		}
	});
});
$(document).ready(function() {

	$('#date-begin, #date-end').datepicker();

	$('.create_offer').hide();

	$('.show_create_offer').on('click', function() {
		$('.create_offer').show();
	});

	$('.create_offer').on('submit', function(e) {
		e.preventDefault();

		var data = {};

		data.title = $(this).find('input[name=title]').val();
		data.description = $(this).find('input[name=description]').val();
		data.date_begin = $(this).find('input[name=date_begin]').val();
		data.date_end = $(this).find('input[name=date_end]').val();
		data.multiple_targets = $(this).find('input[name=multiple_targets]').val();
		data.expected_targets = $(this).find('input[name=expected_targets]').val();

		data.activity_id = $(this).find('select[class=activities]').val();
		data.brand_id = $(this).find('input[name=brand_id]').val();

		makeAjax('POST', "offers/create", data, function() {
			console.log('user_added', _this.response);

			if(_this.response.check == 'OK') {
				swal({
		    		title : "Félicitations !", 
		    		text: "Votre offre a bien été ajoutée !", 
		    		type: "success"
	    		});
			} else {
				swal({
		    		title : "Dommage", 
		    		text: "Votre offre n'a pas été ajoutée !", 
		    		type: "error"
	    		});
			}
		});
	});

	$('.finished_offers').hide();

	$('.get_current_offer').on('click', function() {
		$('.buttons_offers').removeClass('reversed');
		$('.current_offer').show();
		$('.finished_offers').hide();
		$(this).addClass('reversed');
	});

	$('.get_finished_offers').on('click', function() {
		$('.buttons_offers').removeClass('reversed');
		$('.current_offer').hide();
		$('.finished_offers').show();
		$(this).addClass('reversed');
	});

});
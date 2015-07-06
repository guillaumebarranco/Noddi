$(document).ready(function() {

	var _this = this;


	/*
	*	FONCTIONS GENERIQUES
	*/

	function makeAjax(type, url, data, callback) {

		$.ajax({
			type : type,
			url : url,
			data : data,
			success: function(response_get) {
				// La variable globale de reponse est remplacée à chaque requête AJAX
				_this.response = response_get;
				callback();
			},
			error: function(){
				console.log('error', url);
	        }
		});
	};

	$('.add_brand').on('submit', function(e) {
		e.preventDefault();

		// data_user = {
		// 	'bio' => $(this).find('input[name=bio]').val(),
		// 	'website' => 'http://',
		// 	'picture', => ''
		// 	'type' => 'brand'
		// };

		makeAjax('POST', "users/add", data_user, function() {
			console.log('user_added', _this.response);
		});
	});

	$('.add_modeuse').on('click', function() {

		// data_user = {
		// 	'bio' => 'test',
		// 	'website' => 'http://',
		// 	'picture', => ''
		// 	'type' => 'modeuse'
		// };

		makeAjax('POST', "users/add", data_user, function() {
			console.log('user_added', _this.response);
			addModeuse(_this.response);
		});
	});

	$('.create_offer').hide();

	$('.show_create_offer').on('click', function() {
		$('.create_offer').show();
	});

	$('.create_offer').on('submit', function(e) {
		e.preventDefault();

		var data = {};

		data["title"] = $(this).find('input[name=title]').val();
		data["description"] = $(this).find('input[name=description]').val();
		data["date_begin"] = $(this).find('input[name=date_begin]').val();
		data["date_end"] = $(this).find('input[name=date_end]').val();
		data["multiple_targets"] = $(this).find('input[name=multiple_targets]').val();
		data["expected_targets"] = $(this).find('input[name=expected_targets]').val();

		data["activity_id"] = $(this).find('select[class=activities]').val();
		data["brand_id"] = $(this).find('input[name=brand_id]').val();

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

	function addModeuse(user) {
		user;
	};

});	

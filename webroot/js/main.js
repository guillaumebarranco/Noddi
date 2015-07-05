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

	function addModeuse(user) {
		user;
	};

});	

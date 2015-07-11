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
	}

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

	/*
	*	PROFIL
	*/

	$('.profile_section').hide();
	$('.profile').show();

	$('.menu_profil li a').on('click', function(e) {
		e.preventDefault();

		$('.profile_section').hide();
		$('.'+$(this).attr('data-section')).show();
	});

	$('.update_profil form').on('submit', function(e) {
		e.preventDefault();

		var type = $(this).find('input[name=type]').val();

		var data = {};

		if(type === 'modeuse') {
			data.modeuse_id = $(this).find('input[name=modeuse_id]').val();
			data.firstname = $(this).find('input[name=firstname]').val();
		} else if(type === 'brand') {
			data.brand_id = $(this).find('input[name=brand_id]').val();
			data.activity_id = $(this).find('select[class=activities]').val();
			data.name = $(this).find('input[name=name]').val();
		}

		makeAjax('POST', "profil/update", data, function() {
			console.log('user_added', _this.response);
		});
	});

	/*
	*	OFFERS
	*/

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

	$('#upload').uploadify({
        'fileSizeLimit' : '2MB',
        'fileTypeExts'  : '*.gif; *.jpg; *.png',
        'swf'           : WEB_URL+'/webroot/uploadify/uploadify.swf',
        'uploader'      : WEB_URL+'/webroot/uploadify/uploadify.php',
        'method'        : 'post',
        'onSelectError' : function(file, errorCode, errorMsg) {
            if(errorCode == 'QUEUE_LIMIT_EXCEEDED ')    alert(errorMsg);
            else if(errorCode == 'INVALID_FILETYPE  ')  alert(errorMsg);
            else    alert('Erreur inconnue.');
        },
        'onUploadSuccess' : function(file, the_data, response) {
            // alert('The file was saved to: ' + data);
            $(".the_picture img").attr('src', WEB_URL+'/'+the_data);
            $('input[name=picture]').val(WEB_URL+'/'+the_data);

            var data = {};
            data.user_id = $('.user_id').val();
            data.picture = WEB_URL+'/'+the_data;

            console.log(data);

            // makeAjax('POST', "users/updatePicture", data, function() {
            // 	console.log(_this.response);
            // });
        }
    });

	function addModeuse(data_user) {
		var data_user = {};

		data_user.username = data.name;
		data_user.password = 'facebook';
		data_user.bio = 'facebook';
		data_user.website = 'facebook';
		data_user.picture = 'default.jpg';
		data_user.type = 'modeuse';					

		makeAjax('POST', "sign_in", data_user, function() {
			window.location.href = WEB_URL+'/profil';
		});
	}

	function addModeuseFacebook(user) {
		var data_user = {};

		data_user.username = user.name;
		data_user.password = 'facebook';
		data_user.bio = 'facebook';
		data_user.website = 'facebook';
		data_user.picture = 'default.jpg';
		data_user.type = 'modeuse';					

		makeAjax('POST', "sign_in", data_user, function() {
			window.location.href = WEB_URL+'/profil';
		});
	}




	$('.fb_button').on('click', function() {

		FB.getLoginStatus(function(response) {

			if(response.status === "not_authorized") {

				FB.login(function(response) {

					if(response.status === "not_authorized") {

						swal({
							title : 'Erreur',
							text : 'Vous devez accepter les permissions de l\'application'
						});

					} else if(response.status === "connected") {
						FBsignin();
					}
				}, {scope: 'public_profile,email'});

			} else if(response.status === "connected") {
				FBlogin();
			}
		});
	});

	function FBsignin() {
		FB.api('/me/permissions', function(perms){
			console.log(perms);

			if(perms.data[0].status === 'granted' && perms.data[1].status === 'granted') {

				FB.api('/me', function(data){
					console.log(data);
					swal({
						title : 'Connexion réussie',
						text : 'Vous vous appellez '+ data.name
					});

					addModeuseFacebook(data);
				}); 
			}
		});
	}

	function FBlogin() {
		FB.api('/me/permissions', function(perms){
			console.log(perms);

			if(perms.data[0].status === 'granted' && perms.data[1].status === 'granted') {

				FB.api('/me', function(data){
					console.log(data);

					var data_user = {};
					data_user.fb_id = data.id;

					makeAjax('POST', "loginFB", data_user, function() {

						if(_this.response.check === 'OK') {
							window.location.href = WEB_URL+'/profil';
						} else {
							swal({
								title : 'Erreur',
								text : "Vous n'avez pas été trouvé dans les inscrites, veuillez vous inscrire d'abord. "
							});
						}
						
					});
				}); 
			}
		});
	}

	/*
	*	INSCRIPTION MARQUES
	*/

	$('.form_brand_two').hide();
	$('.form_brand_three').hide();

	$('.get_form_brand_two').on('click', function(e) {
		e.preventDefault();
		$('.form_brand_two').show();
		$('.form_brand_one').hide();
	});

	$('.get_form_brand_three').on('click', function(e) {
		e.preventDefault();
		$('.form_brand_three').show();
		$('.form_brand_two').hide();
	});

	$('.select_activities li').on('click', function() {
		var activity = $(this).attr('data-activity');
		$('.select_activities li').removeClass('button_selected');
		$(this).addClass('button_selected');

		$('input[name=activity_id]').val(activity);

		console.log($('input[name=activity_id]').val());
	});

});	

$(document).ready(function() {

	var _this = this;


	/*
	*	HOME
	*/

	function getModeuses() {
		makeAjax('POST', "users/getModeuses", data_search, function() {
			console.log('get_modeuses', _this.response.modeuses);

			$('.list_modeuses').empty();

			for(modeuse in _this.response.modeuses) {

				var new_li = 
					'<li>'+
						'<a href="/Noddi/Modeuses/view/'+_this.response.modeuses[modeuse].id+'">'+
							'<img src="'+_this.response.modeuses[modeuse].user.picture+'" width="150"/>'+
						'</a>' +
						'<button class="button add_favori">Add Favori</button>'+
					'</li>'
				;

				$('.list_modeuses').append(new_li);

				$('.section_home').hide();
				$('.section_les_noddiz').show();
			}
		});
	}

	if($('.list_modeuses').length != 0) {
		data_search = {};
		getModeuses(data_search);		
	}

	$('.section_home').hide();
	$('.section_les_noddiz').show();

	$('.show_socials').on('click', function() {
		$('.section_home').hide();
		$('.section_socials').show();
		$('.show_socials').addClass('section_selected');
		$('.h2_home').text("Filtres");
	});

	$('.show_audience').on('click', function() {
		$('.section_home').hide();
		$('.section_audience').show();
		$('.show_audience').addClass('section_selected');
		$('.h2_home').text("Filtres");
	});

	$('.socials_blog button').on('click', function() {
		$('.socials_blog button').removeClass('blog_selected');
		$(this).addClass('blog_selected');
	});

	$('.socials_network .button').on('click', function() {

		if($(this).hasClass('network_selected')) {
			$(this).removeClass('network_selected');

		} else {

			if($(this).attr('data-network') === 'all') {
				$('.socials_network .button').removeClass('network_selected');
				$(this).addClass('network_selected');
			} else {
				$('.socials_network .button[data-network=all]').removeClass('network_selected');
				$(this).addClass('network_selected');
			}
		}
	});

	$('.socials_audience .button').on('click', function() {

		if($(this).hasClass('audience_selected')) {
			$(this).removeClass('audience_selected');

		} else {

			if($(this).attr('data-network') === 'all') {
				$('.socials_audience .button').removeClass('audience_selected');
				$(this).addClass('audience_selected');
			} else {
				$('.socials_audience .button[data-network=all]').removeClass('audience_selected');
				$(this).addClass('audience_selected');
			}
		}
	});

	$('.filter_home').on('click', function() {

		data_search = {};
		data_search.blog = $('.socials_blog .blog_selected').attr('data-blog');

		data_search.socials = {};
		data_search.audience = {};

		var i = 0;
		$('.network_selected').each(function() {
			data_search.socials[i] = $(this).attr('data-network');
			i++;
		});

		var j = 0;
		$('.audience_selected').each(function() {
			data_search.audience[j] = $(this).attr('data-audience');
			j++;
		});

		console.log(data_search);

		getModeuses(data_search);
	});

	/*
	*	PAGE MODEUSE
	*/

	$('.page_modeuse').hide();
	$('.modeuse_infos').show();

	$('.show_modeuse_infos').on('click', function() {
		$('.page_modeuse').hide();
		$('.modeuse_infos').show();
	});

	$('.show_modeuse_socials').on('click', function() {
		$('.page_modeuse').hide();
		$('.modeuse_socials').show();
	});

	$('.send_offer').on('click', function() {
		swal({
			title: "Confirmation",
			text: "Votre demande a bien été envoyée."
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

	/*
	*	REGISTER AND LOGIN MODEUSE
	*/


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

					//addModeuseFacebook(data);
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
	*	REGISTRER BRANDS
	*/

	$('.form_brand_two').hide();
	$('.form_brand_three').hide();

	$('.get_form_brand_two').on('click', function(e) {
		e.preventDefault();

		if(
			$('input[name=username]').val() != ''
			&& $('input[name=password]').val() != ''
			&& $('input[name=email]').val() != ''
			&& $('input[name=name]').val() != ''
			&& $('input[name=picture]').val() != ''
		) {
			$('#step1').removeClass('active');
			$('#step2').addClass('active');
			$('.form_brand_two').show();
			$('.form_brand_one').hide();
		} else {
			swal({
				title: "Erreur",
				text: "Certains champs ne sont pas remplis",
				type: 'error'
			});
		}		
	});

	$('.get_form_brand_three').on('click', function(e) {
		e.preventDefault();

		if(
			$('input[name=website]').val() != ''
			&& $('textarea[name=bio]').val() != ''
			&& $('input[name=activity_id]').val() != ''
		) {
			$('#step2').removeClass('active');
			$('#step3').addClass('active');
			$('.form_brand_three').show();
			$('.form_brand_two').hide();
		} else {
			swal({
				title: "Erreur",
				text: "Certains champs ne sont pas remplis",
				type: 'error'
			});
		}

	});

	$('.register_brand').on('submit', function(e) {
		if(
			$('select[name=type_commerce]').val() == ''
			&& $('input[name=city]').val() == ''
		) {
			e.preventDefault();
			swal({
				title: "Erreur",
				text: "Certains champs ne sont pas remplis",
				type: 'error'
			});
		}
	});

	$('.select_activities li').on('click', function() {
		var activity = $(this).attr('data-activity');
		$('.select_activities li').removeClass('button_selected');
		$(this).addClass('button_selected');

		$('input[name=activity_id]').val(activity);
	});

	$('.the_picture').hide();

	$('#upload').uploadify({
        'fileSizeLimit' : '2MB',
        'fileTypeExts'  : '*.gif; *.jpg; *.png',
        'swf'           : WEB_URL+'/webroot/uploadify/uploadify.swf',
        'uploader'      : WEB_URL+'/webroot/uploadify/uploadify.php',
        'method'        : 'post',
        'buttonText' : "Uploader le logo de l'entreprise",
        'width' : 300,
        'onSelectError' : function(file, errorCode, errorMsg) {
            if(errorCode == 'QUEUE_LIMIT_EXCEEDED ')    alert(errorMsg);
            else if(errorCode == 'INVALID_FILETYPE  ')  alert(errorMsg);
            else    alert('Erreur inconnue.');
        },
        'onUploadSuccess' : function(file, the_data, response) {
            // alert('The file was saved to: ' + data);
            $(".the_picture img").attr('src', WEB_URL+'/'+the_data);
            $('input[name=picture]').val(WEB_URL+'/'+the_data);
            $('.the_picture').show();
        }
    });

	/*
	*	FAVORIS
	*/

	$(document).on('click', '.add_favori', function() {

		var data_user = {};
		data_user.brand_id = 6;
		data_user.modeuse_id = 2;

		makeAjax('POST', "favoris/add", data_user, function() {
			swal({
				title: "Added !",
				type: "success"
			});
		});
	});

	$('.delete_favori').on('click', function() {
		var favori_id = $(this).attr('data-favori');
		
		makeAjax('POST', "favoris/delete/"+favori_id, favori_id, function() {
			swal({
				title: "Removed !",
				type: "success"
			});
		});
	});


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

});	

$(document).ready(function() {


	/*
	*	REGISTRER MODEUSE
	*/

	// $('.form_brand_two').hide();
	// $('.form_brand_three').hide();
	// $('.form_brand_four').hide();

	$('.register_modeuse').on('submit', function(e) {

		var instagramName = 	$('input[name=instagram]').val(),
			twitterName = 		$('input[name=twitter]').val(),
			email = 			$('input[name=email]').val(),
			firstname = 		$('input[name=firstname]').val(),
			lastname = 			$('input[name=lastname]').val(),
			city = 				$('input[name=city]').val(),
			hobbieOne = 		$('select[name=hobbie-one]').val(),
			hobbieTwo = 		$('select[name=hobbie-two]').val(),
			iAmOne = 			$('select[name=iAmOne]').val(),
			iAmTwo = 			$('select[name=iAmTwo]').val(),
			myDescription =		$('textarea[name=myDescription]').val(),
			blogAdmin = 		$('input[type=radio][name=blogAdmin]:checked').val(),
			brandExperience = 	$('input[type=radio][name=brandExperience]:checked').val(),

			hobbies = 			[hobbieOne,hobbieTwo],
			iAm = 				[iAmOne,iAmTwo],
			styleWear = 		[],
			socialPresence = 	[]
		;

		// push selected styles to stylewear[]
		$('input[type=checkbox][name=styleWear]:checked').each(function() {
			styleWear.push($(this).attr('value'));
		});

		// push selected social networks to social_presence[]
		$('input[type=checkbox][name=social_presence]:checked').each(function() {
			socialPresence.push($(this).attr('value'));
		});

		if(
			//Check for empty inputs
			instagramName != ''
			// && twitterName != '' ...
		) {
			e.preventDefault();

			var datas_modeuse = {};
			datas_modeuse['instagramName'] 		= 		instagramName;
			datas_modeuse['twitterName'] 		= 		twitterName;
			datas_modeuse['email'] 				= 		email;
			datas_modeuse['firstname'] 			= 		firstname;
			datas_modeuse['lastname'] 			= 		lastname;
			datas_modeuse['city'] 				= 		city;
			datas_modeuse['hobbies'] 			= 		hobbies;
			datas_modeuse['iAm'] 				= 		iAm;
			datas_modeuse['styleWear'] 			= 		styleWear;
			datas_modeuse['myDescription'] 		= 		myDescription;
			datas_modeuse['blogAdmin'] 			= 		blogAdmin;
			datas_modeuse['brandExperience'] 	= 		brandExperience;
			datas_modeuse['socialPresence'] 	= 		socialPresence;

			console.log(datas_modeuse);


			// makeAjax('POST', "users/sign_in_modeuse", data_user, function() {
			// 	swal({
			// 		title: "Added !",
			// 		type: "success"
			// 	});
			// });


		} else {
			e.preventDefault();
			swal({
				title: "Erreur",
				text: "Certains champs ne sont pas remplis " + $('input[name=instagram]').val() + ' ' + $('input[name=twitter]').val(),
				type: 'error'
			});
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
		data_user.email = 'email@email.fr';
		data_user.website = 'facebook';
		data_user.picture = 'default.jpg';
		data_user.type = 'modeuse';
		data_user.id_facebook = user.id;

		makeAjax('POST', "sign_in_modeuse", data_user, function() {
			//window.location.href = WEB_URL+'/profil';
		});
	}

	var fields_fb = 'last_name, name, email, first_name, bio, birthday';
	var perms_fb = 'public_profile,email, user_birthday';


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
				}, {scope: perms_fb});

			} else if(response.status === "connected") {
				FBlogin();
			}
		});
	});

	

	function FBsignin() {
		FB.api('/me/permissions', function(perms){
			console.log(perms);

			if(perms.data[0].status === 'granted' && perms.data[1].status === 'granted') {

				FB.api('/me', {fields: fields_fb}, function(data){
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

				FB.api('/me', {fields: fields_fb}, function(data){
					console.log(data);

					var data_user = {};
					data_user.fb_id = data.id;

					makeAjax('POST', "loginFB", data_user, function() {

						if(_this.response.check === 'OK') {
							//window.location.href = WEB_URL+'/profil';
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
			if(validateWebsite($('input[name=website]').val())) {
				$('#step2').removeClass('active');
				$('#step3').addClass('active');
				$('.form_brand_three').show();
				$('.form_brand_two').hide();
			} else {
				swal({
					title: "Erreur",
					text: "Le site web entré n'est pas correct",
					type: 'error'
				});
			}
			
		} else {
			swal({
				title: "Erreur",
				text: "Certains champs ne sont pas remplis",
				type: 'error'
			});
		}

	});

	$('#step1').on('click', function() {
		if($('#step2').hasClass('active') || $('#step3').hasClass('active')) {
			$('.form_brand_two').hide();
			$('.form_brand_three').hide();
			$('.form_brand_one').show();

			$('#step2').removeClass('active');
			$('#step3').removeClass('active');
			$('#step1').addClass('active');
		}
	});

	$('#step2').on('click', function() {
		if($('#step3').hasClass('active')) {
			$('.form_brand_two').show();
			$('.form_brand_three').hide();

			$('#step2').addClass('active');
			$('#step3').removeClass('active');
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
});
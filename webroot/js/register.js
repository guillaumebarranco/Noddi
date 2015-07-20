$(document).ready(function() {

	var fb_id;
	var fb_token;

	/*
	*	REGISTRER MODEUSE
	*/

	$('section.modeuse .inscriptionVisu').hide();
	$('section.modeuse .stepsSignIn').hide();
	$('.register_modeuse').hide();

	$('section.modeuse .form_brand_one').hide();
	$('.form_brand_two').hide();
	$('.form_brand_three').hide();
	$('.form_brand_four').hide();


	//TWO
	$('#get_form_brand_two').on('click', function(e) {
		e.preventDefault();

		if(
			$('input[name=firstname]').val() != ''
			&& $('input[name=lastname]').val() != ''
			&& $('input[name=email]').val() != ''
			&& $('input[name=city]').val() != ''
			&& $('input[name=instagramUsername]').val() != ''
			&& $('input[name=twitterUsername]').val() != ''
			&& $('input[name=birthday]').val() != ''
		) {
			if(validateEmail($('input[name=email]').val())) {

				showLoading();
				makeAjax('POST', WEB_URL+"/users/checkInstaFollowers/"+$('input[name=instagramUsername]').val(), '', function() {
					hideLoading();

					if(_this.response.check == 'OK') {
						$('#step1').removeClass('active');
						$('#step2').addClass('active');
						$('.form_brand_one').hide();
						$('.form_brand_two').show();
					} else {
						popError("Vous devez avoir plus de 200 followers sur Instagram pour vous inscrire");
					}
				});

			} else {
				popError("Le mail entré n'est pas correct");
			}
			
		} else {
			popError("Certains champs ne sont pas remplis");
		}

	});

	//THREE
	$('#get_form_brand_three').on('click', function(e) {
		e.preventDefault();
		var myDescription = $('textarea[name=myDescription]').val(),
			styleWear = $('input[name=styleWear]:checked').val();
		if(
			myDescription != ''
			&& styleWear != '' 
			&& styleWear !=  undefined
		) {
			if(
				$('select[name=hobbie-one]').val() != $('select[name=hobbie-two]').val() 
				&& $('select[name=iAmOne]').val() != $('select[name=iAmTwo]').val() 
			) {
				$('#step2').removeClass('active');
				$('#step3').addClass('active');
				$('.form_brand_two').hide();
				$('.form_brand_three').show();
			} else {
				popError("Deux champs sont identiques");
			}

		} else {
			popError("Certains champs ne sont pas remplis");
		}
	});

	// Checkbox selection: Max 2 checked
	$('#styleWearCheckboxes').on('click', function(e){
		// console.log(e,$('input[name=styleWear]:checked').length);
		($('input[name=styleWear]:checked').length > 2) && e.preventDefault() && e.stopPropagation();
	});

//FOUR 
	$('#get_form_brand_four').on('click', function(e) {
		e.preventDefault();

		if(
			$('input[name=blogAdmin]:checked').val() != ''
			&& $('input[name=brandExperience]:checked').val() != ''
			&& $('input[name=social_presence]:checked').val() != ''
			&& $('input[name=social_presence]:checked').val() !=  undefined
		) {
			$('.the_picture img').attr('src', 'http://graph.facebook.com/'+fb_id+'/picture?type=large');
			$('.the_picture').show();
			$('#step3').removeClass('active');
			$('#step4').addClass('active');
			$('.form_brand_three').hide();
			$('.form_brand_four').show();
			
		} else {
			popError('Certains champs ne sont pas remplis');
		}
	});

	$('.register_modeuse').on('submit', function(e) {

		var instagramName = 	$('input[name=instagramUsername]').val(),
			twitterName = 		$('input[name=twitterUsername]').val(),
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
			age = 				$('input[name=birthday]').val(),
			website = 			$('input[name=website]').val(),

			hobbies = 			[hobbieOne,hobbieTwo],
			iAm = 				[iAmOne,iAmTwo],
			styleWear = 		[],
			socialPresence = 	[]
		;

		// push selected styles to stylewear[]
		$('input[type=checkbox][name=styleWear]:checked').each(function() {
			styleWear.push($(this).val());
		});

		// push selected social networks to social_presence[]
		$('input[type=checkbox][name=social_presence]:checked').each(function() {
			socialPresence.push($(this).val());
		});

		if(
			//Check for empty inputs
			instagramName != ''
		) {
			e.preventDefault();

			var datas_modeuse = {};
			datas_modeuse.instagram 			= 		instagramName;
			datas_modeuse.id_facebook 			= 		fb_id;
			datas_modeuse.twitter 				= 		twitterName;
			datas_modeuse.email 				= 		email;
			datas_modeuse.firstname 			= 		firstname;
			datas_modeuse.username 				= 		firstname;
			datas_modeuse.lastname 				= 		lastname;
			datas_modeuse.city 					= 		city;
			datas_modeuse.hobbies 				= 		hobbies;

			datas_modeuse.personnality 			= 		iAm;
			datas_modeuse.lifestyle 			= 		styleWear;
			datas_modeuse.bio 					= 		myDescription;
			datas_modeuse.has_blog 				= 		blogAdmin;
			datas_modeuse.brandExperience 		= 		brandExperience;
			datas_modeuse.age 					= 		age;
			datas_modeuse.fb_token 				= 		fb_token;


			if(datas_modeuse.brandExperience == "brand_exp_no") {
				datas_modeuse.brandExperience = 0;
			} else {
				datas_modeuse.brandExperience = 1;
			}

			if(datas_modeuse.has_blog == "blog_no") {
				datas_modeuse.has_blog = 0;
			} else {
				datas_modeuse.has_blog = 1;
			}

			datas_modeuse.socialPresence 	= socialPresence;
			datas_modeuse.website 			= 'http://';
			datas_modeuse.password 			= 'modeuse';

			if($('input[name=picture]').val() == '') {
				datas_modeuse.picture 			= 'http://graph.facebook.com/'+fb_id+'/picture?type=large';
			} else {
				datas_modeuse.picture 			= $('input[name=picture]').val();
			}
			
			datas_modeuse.type 				= 'modeuse';

			console.log(datas_modeuse);

			showLoading();

			makeAjax('POST', WEB_URL+"/users/sign_in_modeuse", datas_modeuse, function() {

				hideLoading();

				if(_this.response.check === 'OK') {
					swal({
						title: "Added !",
						type: "success"
					}, function() {
						window.location.href = WEB_URL+'/offers';
					});
				} else {
					popError();
				}
			});

		} else {
			e.preventDefault();
			popError("Certains champs ne sont pas remplis " + $('input[name=instagram]').val() + ' ' + $('input[name=twitter]').val());
		}
	});

	var fields_fb = 'last_name, name, email, first_name, bio, birthday';
	var perms_fb = 'public_profile,email, user_birthday, user_posts, user_friends';

	$('.fb_button').on('click', function() {

		var that = $(this);

		FB.getLoginStatus(function(response) {
			console.log('test', response);

			if(response.status === "not_authorized") {

				FB.login(function(response) {
					//console.log(response.authResponse.accessToken);
					fb_token = response.authResponse.accessToken;

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
				//console.log(response.authResponse);
				fb_token = response.authResponse.accessToken;

				console.log(that);

				if(that.hasClass('fb_button_signin')) {

					FB.api('/me', {fields: fields_fb}, function(data){

						makeAjax('POST', WEB_URL+"/users/checkModeuse", data, function() {
							if(_this.response.check == 'OK') {
								FBsignin();
							} else {
								popError("Vous êtes déjà inscrite avec ce compte Facebook !");
							}
						});

					});
					
				} else {
					FBlogin();
				}
			}
		});
	});

	function FBsignin() {
		FB.api('/me/permissions', function(perms){
			//console.log(perms);

			if(perms.data[0].status === 'granted' && perms.data[1].status === 'granted') {

				FB.api('/me', {fields: fields_fb}, function(data){

					console.log(data);
					fb_id = data.id;
					$('.inscriptionVisu').show();
					$('.stepsSignIn').show();
					$('.register_modeuse').show();
					$('.createFacebookAccount').hide();

					// $('.form_brand_one').hide();
					$('.form_brand_one').show();
					$('#step1').addClass('active');
					$('input[name=firstname]').val(data.first_name);
					$('input[name=lastname]').val(data.last_name);
					$('input[name=email]').val(data.email);

					if(data.birthday != null && data.birthday != '' && data.birthday != undefined) {
						// Get modeuse age (Birthday to Age)
						var birthdayTimestamp = new Date(data.birthday).getTime(),
							myAge = calculateAge(birthdayTimestamp);
						$('input[name=birthday]').val(myAge);
					} else {
						$('input[name=birthday]').attr('type', 'number');
						$('input[name=birthday]').attr('step', '1');
					}

					
				});
			}
		});
	}

	function FBlogin() {
		FB.api('/me/permissions', function(perms){
			console.log(perms);

			if(perms.data[0].status === 'granted' && perms.data[1].status === 'granted') {

				FB.api('/me', {fields: fields_fb}, function(data){
					console.log('me', data);

					var data_user = {};
					data_user.fb_id = data.id;
					data_user.fb_token = fb_token;

					makeAjax('POST', WEB_URL+"/users/loginFB", data_user, function() {

						console.log(_this.response);

						if(_this.response.check === 'OK') {
							window.location.href = WEB_URL+'/offers';
						
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

	$('#myUpload').uploadify({
        'fileSizeLimit' : '2MB',
        'fileTypeExts'  : '*.gif; *.jpg; *.png',
        'swf'           : WEB_URL+'/webroot/uploadify/uploadify.swf',
        'uploader'      : WEB_URL+'/webroot/uploadify/uploadify.php',
        'method'        : 'post',
        'buttonText' : "Changer ma photo de profil",
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
        }
    });








	/*
	*	REGISTRER BRANDS
	*/

	$('.formBrand .get_form_brand_two').on('click', function(e) {
		e.preventDefault();

		if(
			$('input[name=username]').val() != ''
			&& $('input[name=password]').val() != ''
			&& $('input[name=email]').val() != ''
			&& $('input[name=name]').val() != ''
			&& $('input[name=picture]').val() != ''
		) {

			if(validateEmail($('input[name=email]').val())) {
				$('#step1').removeClass('active');
				$('#step2').addClass('active');
				$('.form_brand_two').show();
				$('.form_brand_one').hide();

			} else {
				popError("Le mail entré n'est pas correct");
			}

		} else {
			popError("Certains champs ne sont pas remplis");
		}		
	});

	$('.formBrand .get_form_brand_three').on('click', function(e) {
		e.preventDefault();

		if(
			$('textarea[name=bio]').val() != ''
			&& $('input[name=activity_id]:checked').val() != ''
		) {
			$('#step2').removeClass('active');
			$('#step3').addClass('active');
			$('.form_brand_three').show();
			$('.form_brand_two').hide();
			
		} else {
			popError("Certains champs ne sont pas remplis");
		}

	});

	$('.register_brand').on('submit', function(e) {
		if(
			$('select[name=type_commerce]').val() == ''
			&& $('input[name=city]').val() == ''
		) {
			e.preventDefault();
			popError("Certains champs ne sont pas remplis");
		}
	});

	$('.select_activities input[type=radio]').on('click', function() {
		var activity = $('input[type=radio][name=activity_id]:checked').val();
		// $('.select_activities li').removeClass('button_selected');
		// $(this).addClass('button_selected');

		$('input[type=radio][name=activity_id]:checked').val();
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
            console.log('The file was saved to: ' + the_data);
            console.log(file);
            console.log(response);
            $(".the_picture img").attr('src', WEB_URL+'/'+the_data);
            $('input[name=picture]').val(WEB_URL+'/'+the_data);
            $('.the_picture').show();
        }
    });

    /*
    *	 GERER LES STEP
    */

    $('.brand #step1').on('click', function() {
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
		if($('#step3').hasClass('active') || $('#step4').hasClass('active')) {
			$('.form_brand_two').show();
			$('.form_brand_three').hide();
			$('.form_brand_four').hide();

			$('#step2').addClass('active');
			$('#step3').removeClass('active');
			$('#step4').removeClass('active');
		}

	});

	$('.modeuse #step3').on('click', function() {
		if($('#step4').hasClass('active')) {
			$('.form_brand_three').show();
			$('.form_brand_four').hide();

			$('#step3').addClass('active');
			$('#step4').removeClass('active');
		}

	});
});
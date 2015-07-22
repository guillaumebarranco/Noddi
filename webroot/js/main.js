$(document).ready(function() {

	/*
	*	MENU
	*/

	if($('.page_home').length != 0) {
		$('.menu a.home').parent().addClass('active');
	} else if($('.proposition').length != 0) {
		$('.menu a.dashboard').parent().addClass('active');
	} else if($('.all_favoris').length != 0) {
		$('.menu a.favs').parent().addClass('active');
	} else if($('.all_messages').length != 0) {
		$('.menu a.messages').parent().addClass('active');
	} else if($('.page_offers').length != 0) {
		$('.menu a.link_propositions').parent().addClass('active');
	} else if($('.menu_profil').length != 0) {
		$('.menu a.profil').parent().addClass('active');
	}

	$('.account_select').hide();

	$('.showAccountSelect').on('click', function(e) {
		e.preventDefault();

		if($('.account_select').css('display') == 'none') {
			$('.account_select').slideDown();
		} else {
			$('.account_select').slideUp();
		}
	});

	/*
	*	HOME
	*/

	function getModeuses() {
		showLoading();

		makeAjax('POST', WEB_URL+"/users/getModeuses", data_search, function() {
			console.log('get_modeuses', _this.response.modeuses);

			$('.list_modeuses').empty();

			if(_this.response.modeuses[0]) {

				if(_this.response.modeuses.length < 2) {
					$('.count_modeuse').append('<p><b>'+_this.response.modeuses.length+' Noddiz</b> correspond à vos critères</p>');
				} else {	
					$('.count_modeuse').append('<p><b>'+_this.response.modeuses.length+' Noddiz</b> correspondent à vos critères</p>');
				}

				for(modeuse in _this.response.modeuses) {
					if(_this.response.modeuses[modeuse].user.picture.substr(0,4) != 'http') {
						_this.response.modeuses[modeuse].user.picture = WEB_URL+'/'+_this.response.modeuses[modeuse].user.picture;
					}

					var div_picture = '<div class="modeusePic" style="background-image:url('+_this.response.modeuses[modeuse].user.picture+');">'+
					'</div>'
					;

					var name = _this.response.modeuses[modeuse].firstname +' '+shortName(_this.response.modeuses[modeuse].lastname);

					var new_li = 
						'<li class="modeuse">'+
							'<a href="'+WEB_URL+'/Modeuses/view/'+_this.response.modeuses[modeuse].id+'">'+
								div_picture +
							'</a>' +
							'<div class="infoModeuse">' +
								'<p class="modeuseName">'+name+'</p>' +
								'<ul class="modeuseStats">' +
									'<li class="stat facebook">'+_this.response.modeuses[modeuse].facebook_followers+'</li>' +
									'<li class="stat twitter">'+_this.response.modeuses[modeuse].twitter_followers+'</li>' +
									'<li class="stat instagram">'+_this.response.modeuses[modeuse].insta_followers+'</li>' +
								'</ul>'
					;

					if(_this.response.modeuses[modeuse].already_favori) {
						new_li += '<div class="add_favori" data-favori="'+_this.response.modeuses[modeuse].favori_id+'"></div>';
					} else {
						new_li += '<div class="add_favori grey" data-favori="'+_this.response.modeuses[modeuse].favori_id+'" data-modeuse="'+_this.response.modeuses[modeuse].id+'"></div>';
					}

					new_li +=	
							'</div>' +
						'</li>'
					;

					$('.list_modeuses').append(new_li);

					$('.section_home').hide();
					hideLoading();
					$('.section_les_noddiz').show();
				}

			} else {

				var link =
					'<p>Aucune Noddiz ne matche votre offre ! Attendez ou modifiez votre offre !</p>'+
					'<br />'+
					'<a class="button" href="'+WEB_URL+'/dashboard/">Aller sur le dashboard</a>'
				;

				$('.section_home').append(link);
				hideLoading();
			}

		});
	}

	if($('.list_modeuses').length != 0) {
		data_search = {};
		getModeuses(data_search);		
	}

	/*
	*	PAGE MODEUSE
	*/

	//$('.page_modeuse').hide();
	$('.modeuse_infos').show();

	/*
	*	SWITCH MENU MODEUSES VIEW
	*/

	$('.show_modeuse_infos').on('click', function() {
		$('.page_modeuse').hide();
		$('.modeuse_infos').show();
	});

	$('.show_modeuse_socials').on('click', function() {
		$('.page_modeuse').hide();
		$('.modeuse_socials').show();
	});


	/*
	*	PROFIL
	*/

	$('.profile_section').hide();

	/*
	*	Au clic sur le "menu profil", on récupère la section pour l'afficher
	*/
	$('.menu_profil li a').on('click', function(e) {

		if($(this).hasClass('disconnect') || $(this).hasClass('contact')) {
			
		} else {
			e.preventDefault();
			// $('.profile_section').hide();
			// $('.'+$(this).attr('data-section')).show();
		}
	});

	/*
	*	UPDATE PROFILhref mailto 
	*/

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

		makeAjax('POST', WEB_URL+"/profil/update", data, function() {
			console.log('user_added', _this.response);
		});
	});


	/*
	*	FAVORIS
	*/

	/*
	*	AJOUTER UN FAVORI
	*/

	$(document).on('click', '.add_favori', function() {

		var data_user = {};
		data_user.brand_id = $('.get_brand_id').val();
		data_user.modeuse_id = $(this).attr('data-modeuse');

		var that = $(this);

		// Si le favori a déjà été ajouté, on le supprime
		if(!$(this).hasClass('grey')) {

			var favori_id = $(this).attr('data-favori');

			makeAjax('POST', WEB_URL+"/favoris/delete/"+favori_id, '', function() {
				swal({
					title: "Favori supprimé !",
					type: "success"
				}, function() {
					that.addClass('grey');
				});
			});

		} else {
			makeAjax('POST', WEB_URL+"/favoris/add", data_user, function() {

				swal({
					title: "Favori ajouté !",
					type: "success"
				}, function() {
					that.removeClass('grey');
				});
			});
		}
	});

	/*
	*	SUPPRIMER UN FAVORI
	*/

	$('.delete_favori').on('click', function() {
		var favori_id = $(this).attr('data-favori');
		var that = $(this);
		
		makeAjax('POST', WEB_URL+"/favoris/delete/"+favori_id, favori_id, function() {
			that.parents('li').remove();
		});
	});


	/*
	*	MESSAGES
	*/

	/*
	*	REPONDRE A UN MESSAGE
	*/

	$('.answer_message').hide();
	$('.answerMessage').on('click', function() {

		var parent = $(this).parent();
		
		// Si le message n'a pas été vu pour l'instant
		if($('input[name=viewed]').length != 0) {

			var data_message = {};

			data_message.message_id = $('input[name=viewed]').val();

			makeAjax('POST', WEB_URL+"/messages/updateView/", data_message, function() {

				$('.all_messages').hide();

				$('.answer_message .answer_name').text(parent.find('.message_sender').text());
				$('.answer_message .answer_content').text(parent.find('.message_content').text());
				$('.answer_message .answer_time').text(parent.find('.message_time').text());

				$('.answer_message').show();
			});

		} else {
			$('.all_messages').hide();

			$('.answer_message .answer_name').text(parent.find('.message_sender').text());
			$('.answer_message .answer_time').text(parent.find('.message_time').text());

			$('.answer_message').show();
		}
	});

	/*
	*	ENVOYER UN MESSAGE
	*/
	$('.sendMessage').on('click', function() {

		data = {};
		data.brand_id = $('input[name=brand_id]').val();
		data.modeuse_id = $('input[name=modeuse_id]').val();
		data.content = $('textarea').val();
		data.from_who = 'brand';
		data.viewed = 0;

		makeAjax('POST', WEB_URL+"/messages/add", data, function() {

			var data_message = {};
			data_message.message_id = $('input[name=viewed]').val();
			
			makeAjax('POST', WEB_URL+"/messages/updateAnswer/", data_message, function() {
				swal({
					type: "success",
					title: 'success'
				});
			});
		});
	});

	

	/*
	*	SEE CONVERSATION
	*/

	$('.conversation').hide();
	$('.previousStepMenuMessage').hide();

	$('.seeConversation').on('click', function() {

		showLoading();

		var data = {};
		data.offer_id = $(this).attr('data-offer');

		makeAjax('POST', WEB_URL+"/messages/getMessagesByOffer", data, function() {
			console.log('messages', _this.response);
			$('.conversation ul').empty();


			var type = $('.get_the_type').val();
			var name;
			for(message in _this.response.messages) {

				if(type == 'brand') {
					if(_this.response.messages[message].from_who == 'brand') {
						name = 'Moi';
						var li =
							'<li class="message myself">'
						;
					} else {
						name = _this.response.messages[message].offer.modeus.firstname+' '+_this.response.messages[message].offer.modeus.lastname;
						var li =
							'<li class="message receiver">'
						;
					}
				} else {
					if(_this.response.messages[message].from_who == 'brand') {
						name = _this.response.messages[message].offer.brand.name;
						var li =
							'<li class="message receiver">'
						;
					} else {
						name = 'Moi';
						var li =
							'<li class="message myself">'
						;
					}
				}

				li += 
		                '<h3 class="message_sender">'+name+' <small>'+_this.response.messages[message].created.substr(2, 8)+' '+_this.response.messages[message].created.substr(11, 5)+'</small></h3>'+ 
		                '<p class="message_content">'+_this.response.messages[message].content+'</p>'+
		            '</li>'
				;

				
				$('.conversation ul').append(li);
			}
			
			$('.conversation ul').attr('data-offer', _this.response.messages[message].offer.id);
			$('.seeProfil').append('<a class="button reversed" href="'+WEB_URL+'/Modeuses/view/'+_this.response.messages[0].offer.modeus.id+'" >Voir le profil</a>');

			$('.all_messages').hide();

			hideLoading();

			$('.conversation').show();
			$('.previousStepMenuMessage').show();
		});
		
	});

	$('.previousStepMenuMessage').on('click', function(e) {
		e.preventDefault();

		$('.previousStepMenuMessage').hide();
		$('.conversation').hide();
		$('.all_messages').show();
	});

	/*
	*	SEND MESSAGE
	*/

	$('.formSendMessage').on('submit', function(e) {
		e.preventDefault();

		var data_message = {};
		data_message.offer_id = $('.conversation ul').attr('data-offer');
		data_message.content = $(this).find('textarea').val();
		data_message.viewed = 0;
		data_message.answered = 0;

		makeAjax('POST', WEB_URL+"/messages/add", data_message, function() {
			swal({
				title: 'Message envoyé',
				type: 'success'
			}, function() {

				var li =
        			'<li class="message myself">'+ 
                        '<h3 class="message_sender"> Moi <small>'+_this.response.message.created+'</small></h3>'+ 
                        '<p class="message_content">'+_this.response.message.content+'</p>'+
                    '</li>'
	                		;
				;

				$('.conversation ul').append(li);
			});
		});


	});

	/*
	*	ACCEPT APPLY
	*/

	$('.acceptApply').on('click', function() {

		data = {};
		data.offer_id = $(this).attr('data-offer');
		data.apply_id = $(this).attr('data-apply');
		data.modeuse_id = $(this).attr('data-modeuse');

		console.log('acceptApply', data);

		swal({
			title: "", 
			text: "Ecrivez un message !", 
			type: "input",   showCancelButton: true, 
			closeOnConfirm: false, 
			animation: "slide-from-top", 
			inputPlaceholder: "" },

		function(inputValue) {

			if (inputValue === false) return false;
			if (inputValue === "") {
				swal.showInputError("Vous devez écrire un message !");
				return false;
			}

			data.from_who = 'modeuse';
			data.viewed = 0;
			data.answered = 0;

			data.message = inputValue;

			makeAjax('POST', WEB_URL+"/dashboard/acceptApply", data, function() {

				swal({
					title: 'Message envoyé',
					type: 'success'
				}, function() {
					window.location.href = WEB_URL+'/messages/';
				});
			});
		});
		
	});

	/*
	*	DELETE APPLY
	*/

	$('.removeApply').on('click', function() {

		data = {};
		data.apply_id = $(this).attr('data-apply');
		var that = $(this);
		console.log('acceptApply', data);
		
		makeAjax('POST', WEB_URL+"/dashboard/refuseApply", data, function() {
			swal({
				title: 'Demande supprimée',
				type: 'success'
			});

			that.parents('.proposition_received').remove();
		});
	});

	/*
	*	DELETE APPLY FOR OFFER
	*/

	$('.removeApplyOffer').on('click', function() {

		data = {};
		data.apply_id = $(this).attr('data-apply');
		var that = $(this);
		console.log('acceptApply', data);
		
		makeAjax('POST', WEB_URL+"/dashboard/refuseApply", data, function() {
			swal({
				title: 'Demande supprimée',
				type: 'success'
			});

			window.location.href = WEB_URL+'/offers/';
		});
	});

	/*
	*	AFFICHER MESSAGE AVEC APPLY
	*/

	$('.display_message').on('click', function() {
		swal({
			title: 'Demande reçue',
			text: $(this).attr('data-message')
		});
	});

	$('.message.error').on('click', function() {
		$(this).hide();
	});

	// $('.viewTab').hide();
	$('#viewUserDescription').show();
	$('#UserDescription').addClass('active');
	$('#tabsProfile li').on('click', function() {
		var clickedTab = $(this).attr('id');
		$('#tabsProfile li').removeClass('active');
		$(this).addClass('active');
		$('.viewTab').hide();
		$('#view'+clickedTab).show();
	});


	/*
	*	SHOW TERMINATED OFFERS
	*/

	$('#terminatedOffers').hide();

	$('#showTerminatedOffers').on('click', function() {
		$('#showCurrentOffer').removeClass('active');
		$('#showTerminatedOffers').addClass('active');
		$('#terminatedOffers').show();
		$('#currentOffer').hide();
	});

	$('#showCurrentOffer').on('click', function() {
		$('#showCurrentOffer').addClass('active');
		$('#showTerminatedOffers').removeClass('active');
		$('#terminatedOffers').hide();
		$('#currentOffer').show();
	});

	if($(window).width() < 600) {
		$('.homepage').height($(window).height() - 60);
		$('.memberType.modeuse').height($(window).height());
		$('.memberType.brand').height($(window).height());
		
	}

});	

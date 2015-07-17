$(document).ready(function() {

	/*
	*	MENU
	*/

	if($('.page_home').length != 0) {
		$('.menu li.home').addClass('active');
	} else if($('.proposition').length != 0) {
		$('.menu li.dashboard').addClass('active');
	} else if($('.all_favoris').length != 0) {
		$('.menu li.favs').addClass('active');
	} else if($('.all_messages').length != 0) {
		$('.menu li.messages').addClass('active');
	} else if($('.page_offers').length != 0) {
		$('.menu li.propositions').addClass('active');
	} else if($('.menu_profil').length != 0) {
		$('.menu li.profil').addClass('active');
	}

	/*
	*	HOME
	*/

	function getModeuses() {
		showLoading();

		makeAjax('POST', WEB_URL+"/users/getModeuses", data_search, function() {
			console.log('get_modeuses', _this.response.modeuses);

			$('.list_modeuses').empty();

			for(modeuse in _this.response.modeuses) {

				var new_li = 
					'<li class="modeuse">'+
						'<a href="/Noddi/Modeuses/view/'+_this.response.modeuses[modeuse].id+'">'+
							'<img class="modeusePic" src="'+_this.response.modeuses[modeuse].user.picture+'" />'+
						'</a>' +
						'<div class="infoModeuse">' +
						'<p class="modeuseName">'+_this.response.modeuses[modeuse].firstname+'</p>' +
						'<ul class="modeuseStats">' +
							'<li class="stat facebook">'+_this.response.modeuses[modeuse].facebook_followers+'</li>' +
							'<li class="stat twitter">'+_this.response.modeuses[modeuse].insta_followers+'</li>' +
							'<li class="stat instagram">'+_this.response.modeuses[modeuse].twitter_followers+'</li>' +
						'</ul>'
				;

				if(_this.response.modeuses[modeuse].already_favori) {
					new_li += '<div class="add_favori grey" data-favori="'+_this.response.modeuses[modeuse].favori_id+'" data-modeuse="'+_this.response.modeuses[modeuse].id+'"></div>';
				} else {
					new_li += '<div class="add_favori" data-modeuse="'+_this.response.modeuses[modeuse].id+'"></div>';
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
		});
	}

	if($('.list_modeuses').length != 0) {
		data_search = {};
		getModeuses(data_search);		
	}

	// $('.section_home').hide();
	// $('.section_les_noddiz').show();

	// $('.show_socials').on('click', function() {
	// 	$('.section_home').hide();
	// 	$('.section_socials').show();
	// 	$('.show_socials').addClass('section_selected');
	// 	$('.h2_home').text("Filtres");
	// });

	// $('.show_audience').on('click', function() {
	// 	$('.section_home').hide();
	// 	$('.section_audience').show();
	// 	$('.show_audience').addClass('section_selected');
	// 	$('.h2_home').text("Filtres");
	// });

	// $('.socials_blog button').on('click', function() {
	// 	$('.socials_blog button').removeClass('blog_selected');
	// 	$(this).addClass('blog_selected');
	// });

	// $('.socials_network .button').on('click', function() {

	// 	if($(this).hasClass('network_selected')) {
	// 		$(this).removeClass('network_selected');

	// 	} else {

	// 		if($(this).attr('data-network') === 'all') {
	// 			$('.socials_network .button').removeClass('network_selected');
	// 			$(this).addClass('network_selected');
	// 		} else {
	// 			$('.socials_network .button[data-network=all]').removeClass('network_selected');
	// 			$(this).addClass('network_selected');
	// 		}
	// 	}
	// });

	// $('.socials_audience .button').on('click', function() {

	// 	if($(this).hasClass('audience_selected')) {
	// 		$(this).removeClass('audience_selected');

	// 	} else {

	// 		if($(this).attr('data-network') === 'all') {
	// 			$('.socials_audience .button').removeClass('audience_selected');
	// 			$(this).addClass('audience_selected');
	// 		} else {
	// 			$('.socials_audience .button[data-network=all]').removeClass('audience_selected');
	// 			$(this).addClass('audience_selected');
	// 		}
	// 	}
	// });

	// $('.filter_home').on('click', function() {

	// 	data_search = {};
	// 	data_search.blog = $('.socials_blog .blog_selected').attr('data-blog');

	// 	data_search.socials = {};
	// 	data_search.audience = {};

	// 	var i = 0;
	// 	$('.network_selected').each(function() {
	// 		data_search.socials[i] = $(this).attr('data-network');
	// 		i++;
	// 	});

	// 	var j = 0;
	// 	$('.audience_selected').each(function() {
	// 		data_search.audience[j] = $(this).attr('data-audience');
	// 		j++;
	// 	});

	// 	console.log(data_search);

	// 	getModeuses(data_search);
	// });

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


	/*
	*	PROFIL
	*/

	$('.profile_section').hide();

	$('.menu_profil li a').on('click', function(e) {

		if(!$(this).hasClass('disconnect')) {
			e.preventDefault();
			$('.profile_section').hide();
			$('.'+$(this).attr('data-section')).show();
		}
		
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
	*	FAVORIS
	*/

	$(document).on('click', '.add_favori', function() {

		var data_user = {};
		data_user.brand_id = $('.get_brand_id').val();
		data_user.modeuse_id = $(this).attr('data-modeuse');

		if($(this).hasClass('grey')) {

			var favori_id = $(this).attr('data-favori');

			makeAjax('POST', "favoris/delete/"+favori_id, '', function() {
				swal({
					title: "Deleted !",
					type: "success"
				});
			});

		} else {
			makeAjax('POST', "favoris/add", data_user, function() {
				swal({
					title: "Added !",
					type: "success"
				});
			});
		}

		
	});

	$('.delete_favori').on('click', function() {
		var favori_id = $(this).attr('data-favori');
		var that = $(this);
		
		makeAjax('POST', "favoris/delete/"+favori_id, favori_id, function() {
			that.parents('li').remove();
		});
	});


	/*
	*	MESSAGES
	*/

	$('.answer_message').hide();

	$('.answerMessage').on('click', function() {

		var parent = $(this).parent();
		
		if($('input[name=viewed]').length != 0) {

			var data_message = {};

			data_message.message_id = $('input[name=viewed]').val();

			makeAjax('POST', "messages/updateView/", data_message, function() {

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

	$('.sendMessage').on('click', function() {

		data = {};
		data.brand_id = $('input[name=brand_id]').val();
		data.modeuse_id = $('input[name=modeuse_id]').val();
		data.content = $('textarea').val();
		data.from_who = 'brand';
		data.viewed = 0;

		makeAjax('POST', "messages/add", data, function() {

			var data_message = {};
			data_message.message_id = $('input[name=viewed]').val();
			
			makeAjax('POST', "messages/updateAnswer/", data_message, function() {
				swal({
					type: "success",
					title: 'success'
				});
			});
		});
	});

	/*
	*	MODEUSES OFFERS
	*/

	$('.all_offers').hide();

	$('.get_offers').on('click', function() {

		showLoading();

		makeAjax('POST', WEB_URL+"/offers/getOffers", '', function() {

			console.log(_this.response.offers);

			for (offer in _this.response.offers) {
				var li =
					'<li>'+
						'<p>'+_this.response.offers[offer].title+'</p>'+
						'<a class="see_offer button" href="/Noddi/offers/view/'+_this.response.offers[offer].id+'">Postuler</a>'+
					'</li>'
				;
				$('.all_offers').append(li);
			}
			hideLoading();

			$('.get_offers').hide();

			$('.all_offers').show();
		});

		

	});

	/*
	*	APPLY OFFER
	*/

	$('.apply_offer').on('click', function() {

		var data_apply = {};
		data_apply.modeuse_id = $(this).attr('data-modeuse');
		data_apply.offer_id = $(this).attr('data-offer');
		data_apply.message = $('textarea').val();
		data_apply.viewed = 0;
		data_apply.from_who = $(this).attr('data-fromwho');

		console.log(data_apply);

		swal({
			title : 'yeah',
			confirmButtonText : "OK",
			closeOnConfirm: false

		}, function() {

			makeAjax('POST', WEB_URL+"/offers/applyOffer", data_apply, function() {

				swal({
					title: 'Success',
					type : 'success'
				}, function() {
					if(data_apply.from_who == 'brand') {
						window.location.href = WEB_URL+'/home/';
					} else {
						window.location.href = WEB_URL+'/offers/';
					}
					
				});

			});
			
		});
	});

	/*
	*	SEE CONVERSATION
	*/

	$('.conversation').hide();

	$('.seeConversation').on('click', function() {

		showLoading();

		var data = {};
		data.offer_id = $(this).attr('data-offer');

		makeAjax('POST', "messages/getMessagesByOffer", data, function() {
			console.log('messages', _this.response);
			//$('.conversation')

			var type = $('.get_the_type').val();
			var name;
			for(message in _this.response.messages) {

				if(type == 'brand') {
					if(_this.response.messages[message].from_who == 'brand') {
						name = 'Moi';
					} else {
						name = _this.response.messages[message].offer.modeus.firstname+' '+_this.response.messages[message].offer.modeus.lastname;
					}
				} else {
					if(_this.response.messages[message].from_who == 'brand') {
						name = _this.response.messages[message].offer.brand.name;
					} else {
						name = 'Moi';
					}
				}

				var li =
					'<li class="message">'+ 
		                '<h3 class="message_sender">'+name+'</h3>'+ 
		                '<div class="message_time">'+_this.response.messages[message].created+'</div>'+ 
		                '<p class="message_content">'+_this.response.messages[message].content+'</p>'+
		            '</li>'
				;

				$('.conversation ul').append(li);
			}
			$('.conversation ul').attr('data-offer', _this.response.messages[message].offer.id);
			$('.conversation ul').append('<li><a class="button" href="'+WEB_URL+'/Modeuses/view/'+_this.response.messages[0].offer.modeus.id+'" >Voir le profil</a></li>');

			$('.all_messages').hide();

			hideLoading();

			$('.conversation').show();
		});
		
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

		makeAjax('POST', "messages/add", data_message, function() {
			swal({
				title: 'Message envoyé',
				type: 'success'
			});
		});


	});

	/*
	*	BRAND : ACCEPT APPLY
	*/

	$('.acceptApply').on('click', function() {

		data = {};
		data.offer_id = $(this).attr('data-offer');
		data.apply_id = $(this).attr('data-apply');
		data.modeuse_id = $(this).attr('data-modeuse');

		console.log('acceptApply', data);
		
		makeAjax('POST', WEB_URL+"/dashboard/acceptApply", data, function() {
			swal({
				title: 'Message envoyé',
				type: 'success'
			});
		});
	});

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
	*
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

});	

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
		data.type = 2;

		data.activity_id = $(this).find('select[class=activities]').val();
		data.brand_id = $(this).find('input[name=brand_id]').val();

		data.is_public = $('.allowContact').val();

		console.log(data);
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

	/*
	*	OFFERS
	*/

	$('#upload_offer').uploadify({
        'fileSizeLimit' : '2MB',
        'fileTypeExts'  : '*.gif; *.jpg; *.png',
        'swf'           : WEB_URL+'/webroot/uploadify/uploadify.swf',
        'uploader'      : WEB_URL+'/webroot/uploadify/uploadify_offer'+$('.counter').val()+'.php',
        'method'        : 'post',
        'buttonText' : "Uploader le logo de l'entreprise",
        'formData' : {'path': $('input[name=uniquid]').val()},

        'width' : 300,
        'onSelectError' : function(file, errorCode, errorMsg) {
            if(errorCode == 'QUEUE_LIMIT_EXCEEDED ')    alert(errorMsg);
            else if(errorCode == 'INVALID_FILETYPE  ')  alert(errorMsg);
            else    alert('Erreur inconnue.');
        },
        'onUploadSuccess' : function(file, the_data, response) {
            //alert('The file was saved to: ' + file);
            //console.log(file);
            
            console.log(the_data);
            //console.log(response);

            $(".offer_picture_"+$('.counter').val()).attr('src', WEB_URL+'/'+the_data);
            $('input[name=picture]').val(WEB_URL+'/'+the_data);

            if(parseInt($('.counter').val()) < 3) {
            	$('.counter').val(parseInt($('.counter').val()) + 1);
            	console.log($('.counter').val());
            }

            
        }
    });

	$('.send_offer').on('click', function() {
		swal({
			title: "Confirmation",
			text: "Votre demande a bien été envoyée."
		});
	});

	/*
	*	SUPPRIMER OFFER
	*/

	$('.deleteOffer').on('click', function() {

		data = {};
		data.offer_id = $(this).attr('data-offer');

		console.log('deleteOffer', data);
		
		makeAjax('POST', WEB_URL+"/offers/delete", data, function() {

			if(_this.response.check === 'OK') {
				swal({
					title: 'Offre supprimée',
					type: 'success'
				}, function() {
					window.location.href = WEB_URL+'/home/';
				});

			} else {
				swal({
					title: 'Votre offre a des postulats en cours ! Vous ne pouvez pas la supprimer !',
					type: 'error'
				});
			}
			
		});
	});

	/*
	*	MODEUSES OFFERS
	*/

	$('.all_offers').hide();

	/*
	*	RECUPERER LES OFFRES
	*/

	$('.get_offers').on('click', function() {

		showLoading();

		makeAjax('POST', WEB_URL+"/offers/getOffers", '', function() {

			console.log(_this.response.offers);
			if(_this.response.offers[0]) {

				for (offer in _this.response.offers) {
					var li =
						'<li>'+
							'<p>'+_this.response.offers[offer].title+'</p>'+
							'<a class="see_offer button" href="/Noddi/offers/view/'+_this.response.offers[offer].id+'">Postuler</a>'+
						'</li>'
					;
					$('.all_offers').append(li);
				}
				
				$('.get_offers').hide();
				$('.all_offers').show();

			} else {
				$('.get_offers').hide();
				$('.all_offers').append('<h3>Pas d\'offre pour le moment, revenez plus tard !</h3>');
				$('.all_offers').show();
			}

			hideLoading();
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
});
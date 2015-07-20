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

	$('.show_upload2').hide();
	$('.show_upload3').hide();

	$('#upload_offer1').uploadify({
        'fileSizeLimit' : '2MB',
        'fileTypeExts'  : '*.gif; *.jpg; *.png',
        'swf'           : WEB_URL+'/webroot/uploadify/uploadify.swf',
        'uploader'      : WEB_URL+'/webroot/uploadify/uploadify_offer1.php',
        'method'        : 'post',
        'buttonText' : "Télécharger des images de l'offre",
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

            $(".offer_picture_1").attr('src', WEB_URL+'/'+the_data);
            $('.show_upload1').hide();
            $('.show_upload2').show();
        }
    });

$('#upload_offer2').uploadify({
        'fileSizeLimit' : '2MB',
        'fileTypeExts'  : '*.gif; *.jpg; *.png',
        'swf'           : WEB_URL+'/webroot/uploadify/uploadify.swf',
        'uploader'      : WEB_URL+'/webroot/uploadify/uploadify_offer2.php',
        'method'        : 'post',
        'buttonText' : "Télécharger des images de l'offre",
        'formData' : {'path': $('input[name=uniquid]').val()},

        'width' : 300,
        'onSelectError' : function(file, errorCode, errorMsg) {
            if(errorCode == 'QUEUE_LIMIT_EXCEEDED ')    alert(errorMsg);
            else if(errorCode == 'INVALID_FILETYPE  ')  alert(errorMsg);
            else    alert('Erreur inconnue.');
        },
        'onUploadSuccess' : function(file, the_data, response) {
            //alert('The file was saved to: ' + file);
            console.log(file);
            console.log(response);
            
            console.log(the_data);

            $(".offer_picture_2").attr('src', WEB_URL+'/'+the_data);
            $('.show_upload2').hide();
            $('.show_upload3').show();
        }
    });

$('#upload_offer3').uploadify({
        'fileSizeLimit' : '2MB',
        'fileTypeExts'  : '*.gif; *.jpg; *.png',
        'swf'           : WEB_URL+'/webroot/uploadify/uploadify.swf',
        'uploader'      : WEB_URL+'/webroot/uploadify/uploadify_offer3.php',
        'method'        : 'post',
        'buttonText' : "Télécharger des images de l'offre",
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

            $(".offer_picture_3").attr('src', WEB_URL+'/'+the_data);
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
						'<li class="modeuse">'+
							'<div class="modeusePic" style="background-image:url('+WEB_URL+'/img/offers/'+_this.response.offers[offer].uniquid+'/1.png);">'+
							'</div>' +
							'<div class="infoModeuse infoOffer">' +
								'<p class="modeuseName">'+_this.response.offers[offer].title+'</p>' +
								'<p class="offer_lifestyle offer_icon"><span>'+_this.response.offers[offer].lifestyle+'</span></p>' +
								'<p class="offer_personnality offer_icon"><span>'+_this.response.offers[offer].personnality+'</span></p>' +
								'<p class="offer_exchange offer_icon"><span>'+_this.response.offers[offer].exchange+'</span></p>' +
								'<br /><a class="see_offer button reversed" href="/Noddi/offers/view/'+_this.response.offers[offer].id+'">Postuler</a>'+
							'</div>' +
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
		data_apply.viewed = 0;
		data_apply.from_who = $(this).attr('data-fromwho');

		console.log(data_apply);

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
			
			data_apply.message = inputValue;

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
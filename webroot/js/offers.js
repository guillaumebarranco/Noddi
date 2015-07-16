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
});
$(document).ready(function() {

  $('form').on('submit' ,function(e) {
      e.preventDefault();
      var email = $(this).find('input[type=email]').val();

      data = {
          "email": email
      };

      $.ajax({
          type : 'POST',
          url : 'landings/add',
          data : data,
          success: function(response) {
              console.log(response);

              if(response == 'ok') {
                  $('form').empty();
                  $('form').append('<div class="green">Votre e-mail a bien été enregistré !</div>');
              } else {
                  $('form').prepend('<div class="red">Cet e-mail a déjà été saisi !</div>');
              }
          },
          error: function(){
              console.log('error');
          }
      });
  });

  var tmax_opts = {
    delay: 0.5,
    repeat: -1,
    repeatDelay: 2,
    yoyo: true
  };

  var tmax_tl           = new TimelineMax(tmax_opts),
      polylion_shapes   = $('svg.polylion > g polygon, path, svg.polylion > g polyline'),
      polylion_stagger  = 0.00475,
      polylion_duration = 1;

  var polylion_staggerFrom = {
    scale: 0,
    opacity: 0,
    transformOrigin: 'center center',
  };

  var polylion_staggerTo = {
    opacity: 1,
    scale: 1,
    ease: Elastic.easeInOut
  };

  //tmax_tl.staggerFromTo(polylion_shapes, polylion_duration, polylion_staggerFrom, polylion_staggerTo, polylion_stagger, 0);

});
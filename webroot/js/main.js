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

  // var tmax_opts = {
  //   delay: 0.5,
  //   repeat: -1,
  //   repeatDelay: 2,
  //   yoyo: true
  // };

  // var tmax_tl           = new TimelineMax(tmax_opts),
  //     polylion_shapes   = $('g.animation polygon, g.animation path, g.animation polyline'),
  //     polylion_stagger  = 0.00475,
  //     polylion_duration = 1;

  // var polylion_staggerFrom = {
  //   scale: 0,
  //   opacity: 0,
  //   transformOrigin: 'center center',
  // };

  // var polylion_staggerTo = {
  //   opacity: 1,
  //   scale: 1,
  //   ease: Elastic.easeInOut
  // };

  // tmax_tl.staggerFromTo(polylion_shapes, polylion_duration, polylion_staggerFrom, polylion_staggerTo, polylion_stagger, 0);

  function rand(min, max) {
    var the_random = Math.random() * (max - min + 1) + min;
    return the_random;
  }

  function rand_floor(min, max) {
    var the_random = Math.floor(Math.random() * (max - min + 1) + min);
    return the_random;
  }

  // $('g.animation polygon, g.animation path, g.animation polyline').each(function() {

  //   setTimeout(function() {

  //     $(this).css('position', 'relative');
  //     $(this).css('left', rand(10,50)+'px');
  //     $(this).css('top', rand(10,50)+'px');

  //   }, 100);

  // });
  $('svg').hover(

    function() {

      $('.animation polygon, .animation path, .animation polyline').each(function() {
        $(this).css('-webkit-transform', 'rotate('+rand_floor(-20, 20)+'deg) translate3d('+rand(-3, 3)+'em, 0em, 0)');
      });

    }, function() {
      $('.animation polygon, .animation path, .animation polyline').css('-webkit-transform', 'rotate(0deg) translate3d(0em, 0em, 0)');
    }

  );    

});
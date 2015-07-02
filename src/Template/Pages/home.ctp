<?php
    $this->layout = false;
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Noddi</title>

        <meta charset="utf-8" />

        <meta name="description" content="Page description. No longer than 155 characters." />

        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="Noddi">
        <meta itemprop="description" content="Noddi est une plateforme de matching entre les marques et les modeuses.">
        <meta itemprop="image" content="http://www.noddi.eu/logo.svg">

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@publisher_handle">
        <meta name="twitter:title" content="Noddi">
        <meta name="twitter:description" content="Noddi est une plateforme de matching entre les marques et les modeuses.">
        <meta name="twitter:creator" content="@author_handle">
        <!-- Twitter summary card with large image must be at least 280x150px -->
        <meta name="twitter:image:src" content="http://www.example.com/image.html">

        <!-- Open Graph data -->
        <meta property="og:title" content="Noddi" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="http://www.noddi.eu/" />
        <meta property="og:image" content="http://noddi.eu/img/logo.svg" />
        <meta property="og:description" content="Noddi est une plateforme de matching entre les marques et les modeuses." />
        <meta property="og:site_name" content="Noddi" />
        <meta property="fb:admins" content="Facebook numberic ID" />

        <?= $this->Html->meta('icon') ?>
        <?= $this->Html->css('index') ?>
    </head>

    <body>

        <header>

            <div class="logo">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600" class="polylion">
                    <defs>
                        <filter id="polycleaner">
                            <feComponentTransfer>
                                <feFuncA type="table" tableValues="0 0.5 1 1" />
                            </feComponentTransfer>
                        </filter>
                    </defs>

                    <g filter="url(#polycleaner)">
                        <polygon fill="#FBE5D8" points="369.966,435.928 365.942,419.502 348.967,416.567 "/>
                        <polygon fill="#FAD9BE" points="369.966,435.928 365.942,419.502 372.485,424.13 384.967,445.611 "/>
                        <polygon fill="#F4A08C" points="348.967,416.567 346.033,413.638 348.283,411.381 365.942,419.502 "/>
                        <polygon fill="#EA887F" points="386.268,455.843 374.638,427.968 367.574,425.178 "/>
                        <polygon fill="#ED8D7A" points="403.03,454.939 374.638,426.543 374.638,436.512 "/>
                        <polygon fill="#F3956F" points="382.827,334.802 379.467,331.807 379.326,311.553 401.69,333.915 "/>
                        <polygon fill="#EF794C" points="382.827,334.802 401.69,333.915 416.392,366.401 "/>
                        <polygon fill="#F59F6B" points="401.69,333.915 442.138,374.361 416.392,366.401 "/>
                        <polygon fill="#EF794C" points="416.392,366.401 442.138,374.361 456.087,406.1 "/>
                        <polygon fill="#EF794C" points="379.467,290.008 365.502,313.314 365.502,287.28 "/>
                        <polygon fill="#F59F6B" points="365.502,313.314 379.467,290.008 379.467,326.024 "/>
                        <polygon fill="#EF794C" points="365.502,313.314 379.467,326.024 366.89,359.39 "/>
                        <polygon fill="#F3956F" points="379.467,326.024 379.467,383.223 366.89,359.39 "/>
                        <polygon fill="#EB8880" points="366.89,359.39 379.467,383.223 366.89,415.527 "/>
                        <polygon fill="#F9C2AA" points="366.89,415.527 379.467,383.223 378.275,430.359 "/>
                        <polygon fill="#F4A08B" points="366.89,415.527 378.159,482.618 378.275,430.359 "/>
                        <polyline fill="#FAD8BE" points="378.159,482.618 365.502,463.988 366.89,415.527 "/>
                        <polyline fill="#F9E4D9" points="378.275,482.793 365.502,463.988 363.181,497.623 378.159,482.618 "/>
                        <path fill="#F9E4D9" d="M363.181,497.623"/>
                        <polygon fill="#F4A08C" points="389.134,497.623 363.181,497.623 378.159,482.618 "/>
                        <polygon fill="#FAE4D6" points="435.742,497.623 449.11,528.609 421.838,513.116 "/>
                        <polygon fill="#F4A08C" points="435.742,497.623 394.693,506.359 421.838,513.116 "/>
                        <polygon fill="#ED8D7A" points="435.742,497.623 361.725,497.623 394.693,506.359 "/>
                        <polygon fill="#EA887F" points="421.838,513.116 394.693,506.359 370.73,511.527 "/>
                        <polygon fill="#FBE5D8" points="370.73,511.527 350.867,499.479 331.536,513.116 "/>
                        <polygon fill="#FAD9BE" points="370.73,511.527 350.867,499.479 361.725,497.623 394.693,506.359 "/>
                        <polygon fill="#F4A08C" points="331.536,513.116 325.845,513.116 325.845,508.746 350.867,499.479 "/>
                        <polyline fill="#FAD8BE" points="387.626,439.535 384.457,427.89 378.275,430.359 387.626,439.535 "/>
                        <polygon fill="#FAE4D6" points="403.03,454.939 392.985,480.237 386.268,455.843 "/>
                        <polygon fill="#F4A08C" points="403.03,454.939 374.638,436.512 386.268,455.843 "/>
                        <polygon fill="#F3956F" points="442.138,374.361 463.807,399.111 456.087,406.1 "/>
                        <polygon fill="#F4A08B" points="456.087,406.1 444.539,394.552 431.531,413.759 "/>
                        <polygon fill="#FAD8BE" points="444.539,394.552 418.366,402.886 431.531,413.759 "/>
                        <polygon fill="#F9E4D9" points="431.531,413.759 398.731,423.979 418.366,402.886 "/>
                        <polygon fill="#ED8D7A" points="398.731,423.979 387.626,427.443 418.366,402.886 "/>
                        <polygon fill="#EA887F" points="417.895,403.265 381.504,414.624 387.626,427.443 "/>
                        <polygon fill="#F9E4D9" points="387.626,427.443 381.504,414.624 378.275,430.359 "/>
                        <polygon fill="#FAD9BE" points="378.275,430.359 381.504,414.624 378.65,415.527 "/>
                        <polygon fill="#010202" points="524.356,142.177 548.193,135.553 531.772,172.895 "/>
                        <polygon fill="#F3AC96" points="548.193,135.553 520.65,102.718 524.356,142.177 "/>
                        <polygon fill="#D69888" points="520.65,102.718 504.233,113.047 524.356,142.177 "/>
                        <polygon fill="#F8BCA5" points="518.006,89.214 504.233,113.047 520.65,102.718 "/>
                        <polygon fill="#F6AC79" points="518.006,89.214 493.641,72.53 504.233,113.047 "/>
                        <polygon fill="#F9C2AA" points="504.233,113.047 472.721,111.459 493.641,72.53 "/>
                        <polygon fill="#F2926E" points="504.233,113.047 472.721,111.459 468.48,122.446 "/>
                        <polygon fill="#F59F6B" points="472.721,111.459 452.067,92.788 493.641,72.53 "/>
                        <polygon fill="#EF794C" points="472.721,111.459 452.067,92.788 468.48,122.446 "/>
                        <polygon fill="#F3956F" points="468.48,122.446 466.102,157.533 443.325,142.177 "/>
                        <polygon fill="#F07F4A" points="443.325,142.177 452.067,92.788 468.48,122.446 "/>
                        <polygon fill="#F59F6B" points="466.102,157.533 443.325,142.177 459.74,190.109 487.283,190.109 "/>
                        <polygon fill="#EF794C" points="487.283,190.109 484.105,220.825 459.74,190.109 "/>
                        <polygon fill="#F4A08C" points="487.283,190.109 504.233,227.182 484.105,220.825 "/>
                        <polygon fill="#F9C2AA" points="484.105,220.825 471.397,264.653 504.233,227.182 "/>
                        <polygon fill="#F4A08C" points="504.233,227.182 507.146,272.729 471.397,264.653 "/>
                        <polygon fill="#F59F6B" points="507.146,272.729 484.105,310.331 471.397,263.99 "/>
                        <polygon fill="#EF794C" points="484.105,310.331 431.939,332.048 471.397,263.99 "/>
                        <polygon fill="#F4A08C" points="471.397,263.99 452.855,235.389 389.038,310.331 "/>
                        <polygon fill="#DF7365" points="389.038,310.331 431.939,332.843 471.397,263.99 "/>
                        <polygon fill="#F59F6B" points="389.038,310.331 375.797,339.199 394.601,332.843 "/>
                        <polygon fill="#EF794C" points="394.601,332.843 431.939,332.843 389.038,310.331 "/>
                        <polygon fill="#EF794C" points="375.797,339.199 343.49,323.311 389.038,310.331 "/>
                        <polygon fill="#F2926E" points="375.797,339.199 365.921,342.903 343.49,323.311 "/>
                        <polygon fill="#F59F6B" points="365.921,342.903 336.872,347.145 343.49,323.311 "/>
                        <polygon fill="#EF794C" points="336.872,347.145 302.973,313.509 343.49,323.311 "/>
                        <polygon fill="#F59F6B" points="302.973,313.509 288.671,300.8 345.609,266.904 "/>
                        <polygon fill="#F4A08C" points="343.49,323.311 345.609,266.904 302.973,313.509 "/>
                        <polygon fill="#F3956F" points="343.49,323.311 345.609,266.904 389.038,310.331 "/>
                        <polygon fill="#F6AC79" points="345.609,266.904 452.855,235.389 389.038,310.331 "/>
                        <polygon fill="#F9C2AA" points="452.855,235.389 423.465,199.905 345.609,266.904 "/>
                        <polygon fill="#F59F6B" points="345.609,266.904 373.942,196.992 423.465,199.905 "/>
                        <polygon fill="#F3956F" points="373.942,196.992 306.416,220.825 345.609,266.904 "/>
                        <polygon fill="#EF794C" points="306.416,220.825 288.671,300.8 345.609,266.904 "/>
                        <polygon fill="#EF794C" points="288.671,300.8 192.546,307.155 302.973,313.509 "/>
                        <polygon fill="#F4A08C" points="288.671,300.8 192.546,307.155 306.416,220.825 "/>

                        <path fill-rule="evenodd" clip-rule="evenodd" fill="#020304" stroke="#1E1E1C" stroke-width="2.3813" stroke-miterlimit="10" d="
                        M479.972,27.958c4.483,0.395,8.955,0.784,13.431,1.174c3.364,0.382,6.722,0.766,10.081,1.146c5.117,1.276,16.142,2.482,20.037,2.288
                        c2.49-0.123,7.362,0.544,8.106,2.315c0.433,2.344-2.062,9.407-2.768,11.681c-2.451,7.945-2.354,18.337-3.762,27.804
                        c4.827,0.952,10.77,7.917,12.646,11.69c0.633,1.283,2.349,3.609,1.784,5.651c-1.022,3.683-5.72,6.577-9.531,7.875
                        c-7.494,2.547-18.29,0.938-26.24-1.756c-13.709-4.626-27.839-7.525-40.286-12.758c-5.603-2.355-18.062-3.674-15.484-11.396
                        c1.465-0.656,2.712-1.184,4.767-0.924c0.841,0.114,1.677,0.234,2.515,0.357c1.774-0.243,4.373-1.203,6.105-0.812
                        c0.996-10.196,3.776-22.253,3.008-32.958c-0.175-2.391-0.189-10.788,1.138-11.56C469.15,26.092,476.132,29.098,479.972,27.958z"
                        />

                    </g>
                </svg>

                <h1>Noddi</h1>

                <!-- <img src="img/logo.svg" alt="Logo De Noddi" /> -->
            </div>

            <div class="field">

                <h2>Faites Votre Show !</h2>

                <p>
                    Mettre sa notoriété à profit <br />
                    n’a jamais été aussi simple.
                </p>

            </div>

        </header>

        <section class="wrapper">
            
            <p>Soyez informés avant tout le monde de l'ouverture de notre plateforme !</p>

            <form action="#">
                <input type="email" name="email" placeholder="Votre e-mail" />
                <div class="separator"></div>
                <button class="button">Je veux être informée !</button>
            </form>

        </section>

        <footer>

            <div>
                <div class="follow_us">Suivez-nous sur</div>

                <ul class="socials">
                    <li><a class="facebook" href="#"></a></li>
                    <li><a class="twitter" href="#"></a></li>
                    <li><a class="instagram" href="#"></a></li>
                    <li><a class="snapchat" href="#"></a></li>
                    <li><a class="pinterest" href="#"></a></li>
                </ul>
            </div>

            <a href="cgu.pdf" target="_blank" class="cgu">Conditions Générales D'utilisation</a>

        </footer>

        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TweenMax.min.js"></script>

        <script type="text/javascript">

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

               // tmax_tl.staggerFromTo(polylion_shapes, polylion_duration, polylion_staggerFrom, polylion_staggerTo, polylion_stagger, 0);
                
            });

        </script>

    </body>

</html>

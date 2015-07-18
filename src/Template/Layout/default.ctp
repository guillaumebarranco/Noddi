<!DOCTYPE html>

<html>
    <head>
        <?= $this->Html->charset() ?>

        <title>Noddi</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <meta charset="utf-8" />

        <meta name="description" content="Page description. No longer than 155 characters." />

        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="Noddi" />
        <meta itemprop="description" content="Noddi est une plateforme de matching entre les marques et les modeuses." />
        <meta itemprop="image" content="http://www.noddi.eu/logo.svg" />

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="http://www.noddi.eu/" />
        <meta name="twitter:title" content="Noddi" />
        <meta name="twitter:description" content="Noddi est une plateforme de matching entre les marques et les modeuses." />
        <meta name="twitter:creator" content="@TheNoddi" />
        <!-- Twitter summary card with large image must be at least 280x150px -->
        <meta name="twitter:image:src" content="http://www.example.com/image.html" />

        <!-- Open Graph data -->
        <meta property="og:title" content="Noddi" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="http://www.noddi.eu/" />
        <meta property="og:image" content="http://noddi.eu/img/logo.svg" />
        <meta property="og:description" content="Noddi est une plateforme de matching entre les marques et les modeuses." />
        <meta property="og:site_name" content="Noddi" />

        <link rel="icon" href="<?=$this->request->base?>/img/favicon2.ico.png" type="image/x-icon" />
        
        <? //bootstrap.css ?>
        <? // base.css ?>
        <?= $this->Html->css('normalize') ?>
        <? //cake.css ?>
        <?= $this->Html->css('sweet-alert') ?>
        <?= $this->Html->css('uploadify') ?>
        <?= $this->Html->css('datepicker') ?>
        <?//index.css ?>
        <?= $this->Html->css('style') ?>

        <?= $this->Html->script('jquery') ?>
        <?= $this->Html->script('sweet-alert.min') ?>
        <?= $this->Html->script('functions') ?>
    </head>

    <body>

        <header class="headerApp">

            <nav id="navigation">
                <ul class="menu">
                    <?php 
                        if($this->request->session()->read('user')) { ?>
                            <li class="profile_picture showLarge" style="background-image:url(<?=$this->request->session()->read('picture')?>);">
                            </li>
                            <?php if($this->request->session()->read('type') == 'modeuse') { ?>
                                
                                <!-- Menu Modeuse -->
                                <li>
                                    <?= $this->Html->link(__("Propositions"), ['controller' => 'Offers', 'action' => 'index'], ['class' => 'link_propositions']) ?>
                                </li>

                                <li>
                                    <?= $this->Html->link(__("Messages"), ['controller' => 'Messages', 'action' => 'index'], ['class' => 'messages']) ?>
                                </li>

                                <li>
                                    <?= $this->Html->link(__("Compte"), ['controller' => 'Profil', 'action' => 'index'], ['class' => 'profil']) ?>
                                </li>

                           <?php } elseif ($this->request->session()->read('type') == 'brand') { ?>
                                <!-- Menu Marque -->

                                <li>
                                    <?= $this->Html->link(__("Compte"), ['controller' => 'Profil', 'action' => 'index'], ['class' => 'profil']) ?>
                                </li>

                                <li>
                                    <?= $this->Html->link(__("Dashboard"), ['controller' => 'Dashboard', 'action' => 'index'], ['class' => 'dashboard']) ?>
                                </li>

                                <li>
                                    <?= $this->Html->link(__("Noddiz"), ['controller' => 'Home', 'action' => 'index'], ['class' => 'home']) ?>
                                </li>

                                <li>
                                    <?= $this->Html->link(__("Favoris"), ['controller' => 'Favoris', 'action' => 'index'], ['class' => 'favs']) ?>
                                </li>

                                <li>
                                    <?= $this->Html->link(__("Messages"), ['controller' => 'Messages', 'action' => 'index'], ['class' => 'messages']) ?>
                                </li>
                                
                            <?php } ?>
                        

                    <?php } else { ?>


                    <?php } ?>
                    
                </ul>
            </nav>

        </header>

        <div id="container">

            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>


            <!-- <footer>
                <section class="socials">
                    <h3 class="showLarge">rejoins vite notre réseau de noddiz :</h3>
                    <ul id="sectionSocial">
                        <li class="facebook"><a target="_blank" href="https://www.facebook.com/noddi.eu">facebook</a></li>
                        <li class="twitter"><a target="_blank" href="https://twitter.com/theNoddi">twitter</a></li>
                        <li class="instagram"><a target="_blank" href="https://instagram.com/thenoddi">Instagram</a></li>
                        <li class="snapchat"><a target="_blank" href="#">Snapchat</a></li>
                        <li class="pinterest"><a target="_blank" href="https://fr.pinterest.com/noddi0434/">Pinterest</a></li>
                    </ul>
                </section>
                <ul>
                    <li><a href="#">Nous contacter</a></li>
                    <li><a href="#">Plan du site</a></li>
                    <li><a href="#">Conditions générales d'utilisation</a></li>
                    <li><a href="#">Mentions légales</a></li>
                </ul>
                <small>© 2015 Noddi  - Tous droits réservés</small>
            </footer> -->

        </div>

        <!-- LOADER -->
        <div class="loader">
            <div class="rectangle-bounce selected">
              <div class="rect1"></div>
              <div class="rect2"></div>
              <div class="rect3"></div>
              <div class="rect4"></div>
              <div class="rect5"></div>
            </div>
        </div>
        
        <!-- LOADER IE -->
        <div class="loaderIE">
            <img src="<?= $this->request->base ?>/img/loader.gif" alt="" />
        </div>

        <script>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '<?=FB_APP_ID?>',
              xfbml      : true,
              version    : 'v2.4'
            });
          };

          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/en_US/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
           }(document, 'script', 'facebook-jssdk'));
        </script>

        <div id="fb-root"></div>

        <script>
            var WEB_URL = "<?=$this->request->base?>";
            var FB_APP_ID = "<?=FB_APP_ID?>";
            var FB_APP_SECRET = "<?=FB_APP_SECRET?>";

            console.log(FB_APP_SECRET);
        </script>

        <?= $this->Html->script('jquery.uploadify.min') ?>
        <?= $this->Html->script('bootstrap.min') ?>
        <?= $this->Html->script('bootstrap-datepicker') ?>
        <!--<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TweenMax.min.js"></script>-->

        <?= $this->Html->script('landing') ?>
        <?= $this->Html->script('main') ?>

        <!--    GOOGLE ANALYTICS    -->
       <!-- <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-64754298-1', 'auto');
            ga('send', 'pageview');
        </script>-->

    </body>
</html>

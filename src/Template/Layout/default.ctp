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

        <style>
            .wrapper_form {
                width: 400px;
                margin: 0 auto;
            }

            .wrapper_form textarea {
                resize: none;
            }

            .menu li {
                display: inline-block;
            }
        </style>
        
        <? //bootstrap.css ?>
        <? // base.css ?>
        <?= $this->Html->css('normalize') ?>
        <? //cake.css ?>
        <?= $this->Html->css('sweet-alert') ?>
        <?= $this->Html->css('uploadify') ?>
        <?= $this->Html->css('datepicker') ?>
        <?//index.css ?>
        <?= $this->Html->css('style') ?>
    </head>

    <body>

        <header class="headerApp">

            <nav id="navigation">
                <ul class="menu">

                    <?php if($this->request->session()->read('user')) { ?>
                        
                        <li>
                            <?= $this->Html->link('Home', ['controller' => 'Home', 'action' => 'index'], ['class' => 'button']); ?>
                        </li>

                        <li>
                            <?= $this->Html->link('Votre profil', ['controller' => 'Profil', 'action' => 'index'], ['class' => 'button']); ?>
                        </li>
                        <li>
                            <?php
                                echo $this->Form->create(null, [
                                    'url' => ['controller' => 'Users', 'action' => 'disconnect']
                                ]);

                                echo $this->Form->input('username', ["type" => "hidden"]);
                                echo $this->Form->button('Disconnect', ["class"=> "button"]);
                                echo $this->Form->end(); 
                            ?>
                        </li>

                    <?php } else { ?>

                        <li>
                            <?= $this->Html->link(__('Connexion'), ['controller' => 'Users', 'action' => 'login'], ['class' => 'button reversed']) ?>
                        </li>
                        <li>
                            <?= $this->Html->link(__('Inscription'), ['controller' => 'Users', 'action' => 'sign_in'], ['class' => 'button reversed']) ?>
                        </li>

                    <?php } ?>
                    
                </ul>
            </nav>

        </header>

        <div id="container">

                <?= $this->Flash->render() ?>

                    <?= $this->fetch('content') ?>

            <footer>

                <!-- <div class="field">

                    <div>
                        <div class="follow_us">Suivez-nous sur</div>

                        <ul class="socials">
                            <li><a target="_blank" title="Page Facebook" class="facebook" href="https://www.facebook.com/noddi.eu"></a></li>
                            <li><a target="_blank" title="Page Twitter" class="twitter" href="https://twitter.com/theNoddi"></a></li>
                            <li><a target="_blank" title="Page Instagram" class="instagram" href="https://instagram.com/thenoddi"></a></li>
                            <li><a title="Page Snapchat" class="snapchat" href="#"></a></li>
                            <li><a target="_blank" title="Page Pinterest" class="pinterest" href="https://fr.pinterest.com/noddi0434/"></a></li>
                        </ul>
                    </div>
                </div>
 -->                
            </footer>
        </div>

        <script>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '899235186815679',
              xfbml      : true,
              version    : 'v2.2'
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

        <?= $this->Html->script('jquery') ?>
        <?= $this->Html->script('sweet-alert.min') ?>
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

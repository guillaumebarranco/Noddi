<?php
    $tab_lifestyle = array();
    $tab_lifestyle[] = "Bohème";
    $tab_lifestyle[] = "Hippie Chic";
    $tab_lifestyle[] = "Chic";
    $tab_lifestyle[] = "Casual";
    $tab_lifestyle[] = "Street fashion";
    $tab_lifestyle[] = "Excentrique";
    $tab_lifestyle[] = "Pinup";
    $tab_lifestyle[] = "Rétro vintage";
    $tab_lifestyle[] = "Glam rock";
    $tab_lifestyle[] = "Baroque";
    $tab_lifestyle[] = "Flashy";
    $tab_lifestyle[] = "Old School";
    $tab_lifestyle[] = "Romantique";

    function getValue($text) {
        $text = str_replace(" ", "_", $text);
        return $text;
    }


    $i = 0;
    foreach ($tab_lifestyle as $key => $lifestyle) {
        $tab_lifestyle[$i] = array();
        $tab_lifestyle[$i]['name'] = $lifestyle;
        $tab_lifestyle[$i]['value'] = getValue($lifestyle);
        $i++;
    }

    $tab_personnality = array();
    $tab_personnality[] = "Amusante";
    $tab_personnality[] = "Bavarde";
    $tab_personnality[] = "Curieuse";
    $tab_personnality[] = "Sincère";
    $tab_personnality[] = "Gourmande";
    $tab_personnality[] = "Joueuse";
    $tab_personnality[] = "optimiste";
    $tab_personnality[] = "Patiente";
    $tab_personnality[] = "Sensible";
    $tab_personnality[] = "Réfléchie";
    $tab_personnality[] = "Sociable";
    $tab_personnality[] = "Spontanée";
    $tab_personnality[] = "Rêveuse";

    $i = 0;
    foreach ($tab_personnality as $key => $personnality) {
        $tab_personnality[$i] = array();
        $tab_personnality[$i]['name'] = $personnality;
        $tab_personnality[$i]['value'] = getValue($personnality);
        $i++;
    }

    $tab_echange = array();
    $tab_echange[] = "Don";
    $tab_echange[] = "Prêt";
    $tab_echange[] = "Invitation";
    $tab_echange[] = "Dégustation offerte";
    $tab_echange[] = "Boisson offerte";

    $i = 0;
    foreach ($tab_echange as $key => $echange) {
        $tab_echange[$i] = array();
        $tab_echange[$i]['name'] = $echange;
        $tab_echange[$i]['value'] = getValue($echange);
        $i++;
    }

    $tab_interest = array();
    $tab_interest[] = "le cinéma";
    $tab_interest[] = "la culture";
    $tab_interest[] = "la littérature";
    $tab_interest[] = "la mode";
    $tab_interest[] = "le voyages";
    $tab_interest[] = "le sport";
    $tab_interest[] = "la culture geek";
    $tab_interest[] = "les langues";
    $tab_interest[] = "la nature";
    $tab_interest[] = "la cuisine";
    $tab_interest[] = "les animaux";
    $tab_interest[] = "les Spectacles";
    $tab_interest[] = "l'architecture";
    $tab_interest[] = "les cosmétiques";

    $i = 0;
    foreach ($tab_interest as $key => $echange) {
        $tab_interest[$i] = array();
        $tab_interest[$i]['name'] = $echange;
        $tab_interest[$i]['value'] = getValue($echange);
        $i++;
    }

    $tab_socials = array();
    $tab_socials[] = "facebook";
    $tab_socials[] = "twitter";
    $tab_socials[] = "instagram";
    $tab_socials[] = "vine";
    $tab_socials[] = "snapchat";
    $tab_socials[] = "pinterest";
    $tab_socials[] = "tumblr";
    $tab_socials[] = "Flickr";
    $tab_socials[] = "youtube";

    $i = 0;
    foreach ($tab_socials as $key => $echange) {
        $tab_socials[$i] = array();
        $tab_socials[$i]['name'] = $echange;
        $tab_socials[$i]['value'] = getValue($echange);
        $i++;
    }
?>



<section class="page page_signin modeuse">

	<div class="stepsSignIn">
		<ul>
			<li id="step1" class="active">1</li>
			<li id="step2" >2</li>
			<li id="step3" >3</li>
			<li id="step4" >4</li>
		</ul>
	</div>

	<?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'sign_in_modeuse'], 'class' => 'register_modeuse']) ?>

		<div class="formModeuse">

			<div class="form_brand_one">
				<h2>Création de compte</h2>

				<p>
					Tu dois disposer de comptes Facebook et Instagram pour t'inscrire.
				</p>

				<p>
					200 followers minimum sur Instagram sont requis pour poursuivre la création de ton compte.
				</p>

				<div class="button fb_button">S'inscrire avec Facebook</div>
			</div>

			<div class="form_brand_two">

				<?= $this->Form->input('instagram', ['placeholder' => "Nom d'utilisateur sur Instagram"]) ?>
				<?= $this->Form->input('twitter', ['placeholder' => "Nom d'utilisateur sur Twitter"]) ?>

				<h2>Informations Générales</h2>

				<?= $this->Form->input('email', ['placeholder' => "Email"]) ?>

				<?= $this->Form->input('firstname', ['placeholder' => "Prénom"]) ?>

				<?= $this->Form->input('lastname', ['placeholder' => "Nom"]) ?>

				<label for="birthday">Date de Naissance</label>
				<input type="text" name="birthday">

				<?= $this->Form->input('city', ['placeholder' => "Ville"]) ?>

				<a class="button get_form_brand_three">Etape Suivante</a>
			</div>

			<div class="form_brand_three">
				<div class="sentenceSelect">
					<p>
						J'aime principalement 
					</p>
					<select name="hobbie-one">
						<?php  foreach ($tab_interest as $interest) {   
							echo"<option value=".$interest['value']." >" .$interest['name']. "</option> ";
						} ?>
					</select>
					<p>et</p>
					<select name="hobbie-two">
						<?php  foreach ($tab_interest as $interest) {   
							echo"<option value=".$interest['value']." >" .$interest['name']. "</option> ";
						} ?>
					</select>
					<p>Les gens disent de moi que je suis</p>
					<select name="iAmOne">
						<?php  foreach ($tab_personnality as $personnality) {   
							echo"<option value=".$personnality['value']." >" .$personnality['name']. "</option> ";
						 } ?>
					</select>
					<p> et </p>
					<select name="iAmTwo">
						<?php  foreach ($tab_personnality as $personnality) {   
							echo"<option value=".$personnality['value']." >" .$personnality['name']. "</option> ";
						 } ?>
					</select>
				</div>
				
				<p>Choisis deux styles vestimentaires que tu portes au quotidien:</p>
				<div class="checklist">
				<?php  foreach ($tab_lifestyle as $lifestyle) {  
					echo"<input type=\"checkbox\" name='styleWear' id=".$lifestyle['value']." value=".$lifestyle['value'].">
					<label for=".$lifestyle['value']." class=\"showLabel\">
						".$lifestyle['name']."
					</label>";
				} ?>

				</div>

				<textarea name="myDescription" id="description" placeholder="Votre description"></textarea>
				
				<a class="button get_form_brand_four">Etape Suivante</a>
			</div>

			<div class="form_brand_four">
				<p>As-tu un blog ?</p>
				 <div class="radiolist">
					<input type="radio" name="blogAdmin" id="blog_yes" value="blog_yes">
					<label for="blog_yes" class="showLabel">
						Oui
					</label>
					<input type="radio" name="blogAdmin" id="blog_no" value="blog_no">
					<label for="blog_no" class="showLabel">
						Non
					</label>
				</div>
				<p>As-tu déjà travaillé avec une marque ?</p>
				 <div class="radiolist">
					<input type="radio" name="brandExperience" id="brand_exp_yes" value="brand_exp_yes">
					<label for="brand_exp_yes" class="showLabel">
						Oui
					</label>
					<input type="radio" name="brandExperience" id="brand_exp_no" value="brand_exp_no">
					<label for="brand_exp_no" class="showLabel">
						Non
					</label>
				</div>
				<p>Sélectionne les réseaux sociaux sur lesquels tu es présente:</p>
				<div class="checklist">
					<?php  foreach ($tab_socials as $socials) {  
						echo"<input type=\"checkbox\" name='social_presence' id=".$socials['value']." value=".$socials['value'].">
						<label for=".$socials['value']." class=\"showLabel\">
							".$socials['name']."
						</label>";
					} ?>
				</div>
				<?= $this->Form->button('Valider l\'inscription', ["class"=> "button small"]); ?>

		    	
			</div>
		</div>

	<?= $this->Form->end() ?>
</section>

<?= $this->Html->script('register') ?>
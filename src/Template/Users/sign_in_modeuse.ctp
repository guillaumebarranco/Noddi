<section class="page page_signin modeuse">
	<header class="headerPage">
	    <h2 class="titlePage">Inscription</h2>
	    <div class="previousStepMenu"><a href="#">Précédent</a></div>
	</header>
	<div class="createFacebookAccount">
		.
		<p>Tu dois disposer de comptes Facebook et Instagram pour t'inscrire.</p>
		<p>200 followers minimum sur Instagram sont requis pour poursuivre la création de ton compte.</p>

		<div class="button fb_button">S'inscrire avec Facebook</div>
	</div>
	
	<div class="inscriptionVisu"></div>
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

				
			</div>

			<div class="form_brand_two">


				<label for="instagram showLabel">
				instagram
				</label>
					<input class="instagram" type="text" placeholder="Nom d'utilisateur sur Instagram">
				<?= $this->Form->input('instagram', ['placeholder' => "Nom d'utilisateur sur Instagram", "class" => "instagram"]) ?>
				<?= $this->Form->input('twitter', ['placeholder' => "Nom d'utilisateur sur Twitter", "class" => "twitter"]) ?>


				<?= $this->Form->input('email', ['placeholder' => "Email", "class" => "email"]) ?>

				<?= $this->Form->input('firstname', ['placeholder' => "Prénom", "class" => "firstname"]) ?>

				<?= $this->Form->input('lastname', ['placeholder' => "Nom", "class" => "lastname"]) ?>

				<label for="birthday">Date de Naissance</label>
				<input type="hidden" name="birthday">

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
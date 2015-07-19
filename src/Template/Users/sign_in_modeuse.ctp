<?php include('tab.php');  ?>

<section class="page page_signin modeuse page_noConnect">
	<header class="headerPage">
	    <h2 class="titlePage">Inscription</h2>
	    <a href="<?=$this->request->base?>">
	    	<div class="previousStepMenu"></div>
	    </a>
	    
	</header>
	<div class="createFacebookAccount">
		<div class="content">
			<h3>Création de compte modeuse</h3>
			<p>Tu dois disposer de comptes Facebook et Instagram pour t'inscrire.</p>
			<p>200 followers minimum sur Instagram sont requis pour poursuivre la création de ton compte.</p>
			<div class="button fb_button" id="get_form_brand_one">S'inscrire avec Facebook</div>
		</div>
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
				<div class="offsetForm">
					<label class="displayLabel instagramUsername" for="instagramUsername">instagram</label>
					<?= $this->Form->input('instagramUsername', ['placeholder' => "Nom d'utilisateur sur Instagram", "class" => "instagramUsername"]) ?>
					
					<label class="displayLabel twitterUsername" for="twitterUsername">twitter</label>
					<?= $this->Form->input('twitterUsername', ['placeholder' => "Nom d'utilisateur sur Twitter", "class" => "twitterUsername"]) ?>

					<label class="displayLabel email" for="email">email</label>
					<?= $this->Form->input('email', ['placeholder' => "Email", "class" => "email"]) ?>
					
					<div class="rowInput">
						<label class="displayLabel firstname" for="firstname">Prénom</label>
						<?= $this->Form->input('firstname', ['placeholder' => "Prénom", "class" => "firstname"]) ?>

						<label class="displayLabel lastname" for="lastname">Nom</label>
						<?= $this->Form->input('lastname', ['placeholder' => "Nom", "class" => "lastname"]) ?>
					</div>					

					
					<label class="displayLabel birthday" for="birthday">Age</label>
					<input type="hidden" name="birthday">

					<label class="displayLabel city" for="city">Ville</label>
					<?= $this->Form->input('city', ['placeholder' => "Ville"]) ?>
				</div>

				<a id="get_form_brand_two" class="button reversed">Etape Suivante</a>		
			</div>

			<div class="form_brand_two">
				<div class="sentenceSelect">
					<p>
						J'aime principalement 
					</p>
					<select name="hobbie-one">
						<?php foreach ($tab_interest as $interest) { ?>
						    <option value="<?=$interest['value']?>"><?=$interest['name']?></option>
						<?php } ?>
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
				
				<p>Choisis 2 styles vestimentaires que tu portes au quotidien:</p>
				<div id="styleWearCheckboxes" class="checklist">
				<?php  foreach ($tab_lifestyle as $lifestyle) {  
					echo"<input type=\"checkbox\" name='styleWear' id=".$lifestyle['value']." value=".$lifestyle['value'].">
					<label for=".$lifestyle['value']." class=\"showLabel\">
						".$lifestyle['name']."
					</label>";
				} ?>

				</div>

				<textarea name="myDescription" id="description" placeholder="Votre description"></textarea>
				
				<a id="get_form_brand_three" class="button reversed">Etape Suivante</a>
			</div>

			<div class="form_brand_three">
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
				<a id="get_form_brand_four" class="button reversed">Etape Suivante</a>
			</div>

			<div class="form_brand_four">	
				<input type="file" id="myUpload" />
				<input type="hidden" name="picture"/>
				<div class="the_picture">
					<img src="" alt="" width="200" style="border-radius: 50%;"/>
				</div>
				<?= $this->Form->button('Valider l\'inscription', ["class"=> "button reversed"]); ?>
			</div>
		</div>

	<?= $this->Form->end() ?>
</section>

<?= $this->Html->script('register') ?>
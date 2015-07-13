<section class="page page_signin modeuse">
<div class="stepsSignIn">
	<ul>
		<li id="step1" class="active">1</li>
		<li id="step2" >2</li>
		<li id="step3" >3</li>
		<li id="step4" >4</li>
	</ul>
</div>
	<div class="formBrand">
		<div class="form_brand_one">
			<h2>Création de compte</h2>

			<p>
				Tu dois disposer de comptes Facebook et Instagram pour t'inscrire.
			</p>

			<p>
				200 followers minimum sur Instagram sont requis pour poursuivre la création de ton compte.
			</p>

			<button class="button fb_button">S'inscrire avec Facebook</button>
		</div>

<style>
	.register_modeuse {
		width: 400px;
	}
</style>
<?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'sign_in_modeuse'], 'class' => 'register_modeuse']) ?>

		<div class="form_brand_two">

			<?= $this->Form->input('instagram', ['placeholder' => "Nom d'utilisateur sur Instagram"]) ?>
			<?= $this->Form->input('twitter', ['placeholder' => "Nom d'utilisateur sur Twitter"]) ?>

			<h2>Informations Générales</h2>

			<?= $this->Form->input('email', ['placeholder' => "Email"]) ?>

			<?= $this->Form->input('firstname', ['placeholder' => "Prénom"]) ?>

			<?= $this->Form->input('lastname', ['placeholder' => "Nom"]) ?>

			<label for="birthday">Date de Naissance</label>

			<?= $this->Form->input('city', ['placeholder' => "Ville"]) ?>

			<a class="button get_form_brand_three">Etape Suivante</a>
		</div>

		<div class="form_brand_three">
			<div class="sentenceSelect">
				<p>
					J'aime principalement 
				</p>
				<select name="hobbie-one">
					<option value="value1">Valeur 1</option> 
					<option value="value2">Valeur 2</option>
					<option value="value3">Valeur 3</option>
				</select>
				<p>et</p>
				<select name="hobbie-two">
					<option value="value1">Valeur 1</option> 
					<option value="value2">Valeur 2</option>
					<option value="value3">Valeur 3</option>
				</select>
				<p>Les gens disent de moi que je suis</p>
				<select name="iAmOne">
					<option value="value1">Valeur 1</option> 
					<option value="value2">Valeur 2</option>
					<option value="value3">Valeur 3</option>
				</select>
				<p> et </p>
				<select name="iAmTwo">
					<option value="value1">Valeur 1</option> 
					<option value="value2">Valeur 2</option>
					<option value="value3">Valeur 3</option>
				</select>
			</div>
			
			<p>Choisis deux styles vestimentaires que tu portes au quotidien:</p>
			<div class="checklist">
				<input type="checkbox" name="styleWear" id="boheme" value="boheme">
				<label for="boheme" class="showLabel">
					boheme
				</label>
				<input type="checkbox" name="styleWear" id="romantique" value="romantique">
				<label for="romantique" class="showLabel">
					romantique
				</label>
				<input type="checkbox" name="styleWear" id="thug" value="thug">
				<label for="thug" class="showLabel">
					thug
				</label>
				<input type="checkbox" name="styleWear" id="lascars" value="lascars">
				<label for="lascars" class="showLabel">
					lascars
				</label>
				<input type="checkbox" name="styleWear" id="test" value="test">
				<label for="test" class="showLabel">
					test
				</label>
			</div>

			<textarea name="myDescription" id="description">Votre description</textarea>
			<p>Photo profil TODO</p>
			
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
				<input type="checkbox" name="social_presence" id="facebook" value="facebook">
				<label for="facebook" class="showLabel">
					Facebook
				</label>
				<input type="checkbox" name="social_presence" id="twitter_check" value="twitter">
				<label for="twitter_check" class="showLabel">
					Twitter
				</label>
				<input type="checkbox" name="social_presence" id="instagram_check" value="instagram">
				<label for="instagram_check" class="showLabel">
					Instagram
				</label>
				<input type="checkbox" name="social_presence" id="pinterest" value="pinterest">
				<label for="pinterest" class="showLabel">
					Pinterest
				</label>
				<input type="checkbox" name="social_presence" id="snapchat" value="snapchat">
				<label for="snapchat" class="showLabel">
					Snapchat
				</label>
				<input type="checkbox" name="social_presence" id="vine" value="vine">
				<label for="vine" class="showLabel">
					Vine
				</label>
				<input type="checkbox" name="social_presence" id="tumblr" value="tumblr">
				<label for="tumblr" class="showLabel">
					Tumblr
				</label>
				<input type="checkbox" name="social_presence" id="flickr" value="flickr">
				<label for="flickr" class="showLabel">
					Flickr
				</label>
				<input type="checkbox" name="social_presence" id="youtube" value="youtube">
				<label for="youtube" class="showLabel">
					Youtube
				</label>
			</div>
			<?= $this->Form->button('Valider l\'inscription', ["class"=> "button small"]); ?>

	    	<?= $this->Form->end() ?>
		</div>
	</div>
</div>

<?= $this->Html->script('register') ?>
<div class="wrapper_form">

    <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'sign_in_brand'], 'class' => 'register_brand']) ?>
	
	<div class="form_brand_one">
		<h2>Création de compte</h2>

		<p>
			Tu dois disposer de comptes Facebook et Instagram pour t'inscrire.
		</p>

		<p>
			200 followers minimum sur Instagram sont requis pour poursuivre la création de ton compte.
		</p>

		<button class="button fb_button get_form_brand_two">S'inscrire avec Facebook</button>
	</div>


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

		<p>
			J'aime principalement 
		</p>

		<?= $this->Form->button('Sign In', ["class"=> "button small"]); ?>

    	<?= $this->Form->end() ?>
	</div>
	   
</div>
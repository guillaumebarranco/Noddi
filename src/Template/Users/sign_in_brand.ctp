<section class="page page_signin brand">
<div class="stepsSignIn">
	<ul>
		<li id="step1" class="active">1</li>
		<li id="step2" >2</li>
		<li id="step3" >3</li>
	</ul>
</div>

    <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'sign_in_brand'], 'class' => 'register_brand']) ?>
	<div class="formBrand">
		<div class="form_brand_one">
			<h2>Création de compte</h2>

		    <?= $this->Form->input('username', ['label' => '', 'placeholder' => "Nom d'utilisateur"]) ?>
		    <?= $this->Form->input('password', ['label' => '', 'placeholder' => "Mot de passe"]) ?>
		    <?= $this->Form->input('email', ['label' => '', 'placeholder' => "Email"]) ?>

		    <h2>Informations générales</h2>

		    <?= $this->Form->input('name', ['label' => '', 'placeholder' => "Nom de l'entreprise"]) ?>	    

		    <div>
				<input type="file" id="upload" />
				<input type="hidden" name="picture" />
			</div>

			<div class="the_picture">
				<img src="" width="150" />
			</div>

			
			<!-- <label class="showLabel">
				<input type="radio" name="type" id="cool" value="cool">
				cool
			</label>
			<label class="showLabel">
				<input type="radio" name="type" id="hype" value="hype">
				hype
			</label>

			<label class="showLabel">
				<input type="checkbox" name="check" id="super" value="super">
				super
			</label>
			<label class="showLabel">
				<input type="checkbox" name="check" id="nice" value="nice">
				nice
			</label> -->




			<a class="button get_form_brand_two">Etape Suivante</a>
		</div>

		<div class="form_brand_two">

			<?= $this->Form->input('website', ['placeholder' => 'URL de votre site']) ?>

			<label for="bio">Bio</label>
			<?= $this->Form->textarea('bio', ['placeholder' => 'Description (200 caractères)', 'maxlength' => 200]) ?>

			<p>
				Sélectionnez le type d'activité de votre entreprise : 
			</p>

			<ul class="select_activities">
				<?php foreach ($activities as $key => $activity) {
					echo "<li class='button' data-activity=".$activity['id'].">".$activity['name']."</li>";
				} ?>
				<li class="button" data-activity="other">Autre</li>
			</ul>

			<input type="hidden" name="activity_id" />

			<a class="button get_form_brand_three">Etape Suivante</a>
		</div>

		<div class="form_brand_three">

			<select name="type_commerce" id="">
				<option selected disabled>Type de commerce</option>
				<option value="boutique">Boutique</option>
				<option value="e-commerce">E-commerce</option>
				<option value="all">Les deux</option>
			</select>

			<?= $this->Form->input('city', ['label' => '', 'placeholder' => 'City']) ?>

			<input type="hidden" name="type" value="brand" />

			<p>Après validation, vous recevrez un mail de confirmation</p>

			<?= $this->Form->button('S\'inscrire et terminer', ["class"=> "button small"]); ?>

	    	<?= $this->Form->end() ?>
		</div>
	</div>
	   
</section>
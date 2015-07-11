<div class="wrapper_form">

    <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'sign_in_brand']]) ?>
	
	<div class="form_brand_one">
		<h2>Création de scène</h2>

	    <?= $this->Form->input('username', ['label' => '', 'placeholder' => "Nom d'utilisateur"]) ?>
	    <?= $this->Form->input('password', ['label' => '', 'placeholder' => "Mot de passe"]) ?>

	    <h2>Informations générales</h2>

	    <?= $this->Form->input('name', ['label' => '', 'placeholder' => "Nom de l'entreprise"]) ?>	    

	    <div>
			<input type="file" id="upload" />
			<input type="hidden" name="picture" />
		</div>

		<div class="the_picture">
			<img src="" width="150" />
		</div>

		<a class="button get_form_brand_two">Etape Suivante</a>
	</div>

	<div class="form_brand_two">

		<?= $this->Form->input('website', ['placeholder' => 'http://monsite.fr']) ?>

		<label for="bio">Bio</label>
		<?= $this->Form->textarea('bio') ?>

		<p>
			Sélectionnez le type d'activité de votre entreprise : 
		</p>

		<ul class="select_activities">
			<?php foreach ($activities as $key => $activity) {
				echo "<li class='button' data-activity=".$activity['id'].">".$activity['name']."</li>";
			} ?>
			<li data-activity="other">Autre</li>
		</ul>

		<input type="hidden" name="activity_id" />

		<a class="button get_form_brand_three">Etape Suivante</a>
	</div>

	<div class="form_brand_three">

		<select name="type_commerce" id="">
			<option value="boutique">Boutique</option>
		</select>

		<input type="text" name="city" />

		<input type="hidden" name="type" value="brand" />

		<?= $this->Form->button('Sign In', ["class"=> "button small"]); ?>

    	<?= $this->Form->end() ?>
	</div>
	   
</div>
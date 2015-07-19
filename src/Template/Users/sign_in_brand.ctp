<section class="page page_signin brand page_noConnect">
<div class="inscriptionVisu inscriptionBrand"></div>
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
			<div class="offsetForm">
				<label class="displayLabel firstname username" for="username">Nom utilisateur</label>
			    <?= $this->Form->input('username', ['label' => '', 'placeholder' => "Nom d'utilisateur"]) ?>
				
				<label class="displayLabel password" for="password">Mot de passe</label>
			    <?= $this->Form->input('password', ['label' => '', 'placeholder' => "Mot de passe"]) ?>

				<label class="displayLabel email" for="email">Mot de passe</label>
			    <?= $this->Form->input('email', ['label' => '', 'placeholder' => "Email"]) ?>

			    <h2>Informations générales</h2>

				<label class="displayLabel store" for="name">Nom de l'entreprise</label>
			    <?= $this->Form->input('name', ['label' => '', 'placeholder' => "Nom de l'entreprise"]) ?>	    

			    <div>
					<input type="file" id="upload" class="button reversed" />
					<input type="hidden" name="picture" />
				</div>

				<div class="the_picture">
					<img src="" width="150" />
				</div>
			</div>

			<a class="button get_form_brand_two dark reversed">Etape Suivante</a>
		</div>

		<div class="form_brand_two">
		<div class="offsetForm">
			<label class="displayLabel website" for="website">Site web</label>
			<?= $this->Form->input('website', ['placeholder' => 'URL de votre site']) ?>

			<label for="bio">Bio</label>
			<?= $this->Form->textarea('bio', ['placeholder' => 'Description (200 caractères)', 'maxlength' => 200]) ?>

			<p>
				Sélectionnez le type d'activité de votre entreprise : 
			</p>
			
			
			<div class="select_activities radiolist">
				<?php foreach ($activities as $key => $activity) {
					echo "<input type=\"radio\" name=\"activity_id\" id=".$activity['id']." value=".$activity['id']."><label for=".$activity['id']." class=\"showLabel\">".$activity['name']."</label>";
				} ?>
				<input type="radio" name="activity_id" id="other" data-activity="other"/>
				<label for="other" class="showLabel">Autre</label>
			</div>
		</div>		
		
			<a class="button get_form_brand_three">Etape Suivante</a>
		</div>

		<div class="form_brand_three">
			<div class="offsetForm">
				<label class="displayLabel store" for="city">Type de commerce</label>
				<select class="brandType" name="type_commerce" id="">
					<option selected disabled>Type de commerce</option>
					<option value="boutique">Boutique</option>
					<option value="e-commerce">E-commerce</option>
					<option value="all">Les deux</option>
				</select>
				

				<label class="displayLabel city" for="city">Ville</label>
				<?= $this->Form->input('city', ['label' => '', 'placeholder' => 'City']) ?>

				<input type="hidden" name="type" value="brand" />
				
			</div>

			<p>Après validation, vous recevrez un mail de confirmation</p>

			<?= $this->Form->button('Finaliser mon inscription', ["class"=> "button reversed"]); ?>

	    	<?= $this->Form->end() ?>
		</div>
	</div>
	   
</section>

<?=$this->Html->script('register')?>
<section class="page page_account">
	<header class="headerPage">
	    <h2 class="titlePage">Mon Compte</h2>
	    <!-- <div class="previousStepMenu"><a href="#">Précédent</a></div> -->
	</header>
	<?php
		// Get the User Session and his caractéristiques
		$session = $this->request->session();

		if($session->read('type') == 'modeuse') {
			$user = $modeuse['user']; ?>

			<ul class="menu_profil">
				<li>
					<a href="#" data-section="profile">Modifier mon profil</a>
				</li>

				<li>
					<a href="#" data-section="notifications">Notifications par email</a>
				</li>

				<li>
					<a href="#" data-section="preferences">Préférences</a>
				</li>

				<li>
					<a href="#" data-section="conditions">Conditions d'utilisation</a>
				</li>

				<li>
					<a href="#" data-section="mentions">Mentions légales</a>
				</li>

				<li>
					<a href="#" data-section="notifications">FAQ</a>
				</li>

				<li>
					<?= $this->Html->link(__('Déconnexion'), ['controller' => 'Users', 'action' => 'disconnect'], ['class' => 'disconnect']) ?>
				</li>

				<br><br>

				<li>
					<a href="#" data-section="maj">Mise à jour 1.0</a>
				</li>

				<li>
					<a href="#" data-section="contact">Nous contacter</a>
				</li>

			</ul>

		<?php } elseif($session->read('type') == 'brand') {
			$user = $brand['user']; ?>

			<ul class="menu_profil">
				<li>
					<a href="#" data-section="profile">Profil</a>
				</li>

				<li>
					<a href="#" data-section="offers">Offres</a>
				</li>

				<li>
					<?= $this->Html->link(__('Déconnexion'), ['controller' => 'Users', 'action' => 'disconnect'], ['class' => 'disconnect']) ?>
				</li>
			</ul>
		<?php }
	?>



	<div class="profile_section profile">
		<header class="globalInfo">
			<img src="" alt="profile picture"/>
			<div class="contentInfos">
				<h3><?= $user->username ?></h3>
				<p><?= $user->bio ?></p>
			</div>
			<div class="notifications"></div>
		</header>
		

		<div>Username : <?= $user->username ?></div>
		
		<div>Biographie : <p></p></div>
		
		<div>Website : <a target="_blank" href="<?= $user->website ?>"><?= $user->website ?></a></div>
		
		<div class="the_picture">
			Picture : <img src="<?= $user->picture ?>" width="150" alt="Image de <?= $user->username ?>" />
		</div>
		
		<div>Type : <?= $user->type ?></div>


		<?php if($session->read('type') == 'brand') { ?>

			<div>Nom : <?= $brand->name ?></div>

			<div>Secteur d'activité : <?= $activities[$brand->activity_id] ?></div>

			<h3>Compléter Profil</h3>

			<div class="update_profil">
				<br><br>

				<div>
					<input type="hidden" class="user_id" value="<?=$user->id?>">
					<input type="file" id="upload" />
				</div>

				<?= $this->Form->create($brand) ?>
				<input type="hidden" name="brand_id" value="<?=$brand->id?>">
				<input type="hidden" name="type" value="<?=$user->type?>">
				<?= $this->Form->input('name'); ?>
				<?= $this->Form->select('activities._ids', $activities, [ 'name' => 'activities[_ids][]', 'class' => 'activities']); ?>
				
				<button>Valider</button>
			    <?= $this->Form->end() ?>
			</div>
	</div>


	<div class="profile_section offers">
		<h2>Offres</h2>

		<button class="small show_create_offer">Créer une offre</button>

		<div class="create_offer wrapper_form">
			<?php
			    echo $this->Form->create();

			    echo $this->Form->input('title');
			    echo $this->Form->input('description');
			    echo $this->Form->input('date_begin');
			    echo $this->Form->input('date_end');
			    echo $this->Form->select('activities._ids', $activities, [ 'name' => 'activities[_ids][]', 'class' => 'activities']);
			    echo $this->Form->input('multiple_targets');
			    echo $this->Form->input('expected_targets'); ?>

			    <input type="hidden" name="brand_id" value="<?=$brand->id?>">
			    <?php echo $this->Form->button('Créer', ["class"=> "button small"]);

			    echo $this->Form->end(); 
			?>
		</div>

		<div>Liste des offres : 
			<ul>
				<?php foreach ($offers as $key => $offer) { ?>
					<li><?= $this->Html->link($offer->title, ['controller' => 'Offers', 'action' => 'view', $offer->id], ["target" => "_blank"]) ?></li>
				<?php } ?>
			</ul>
		</div>
	</div>


	<?php } else { ?>

			<div>
				Prénom : <?= $modeuse->firstname ?>
			</div>

			<?php if($modeuse->instagram != null) { ?>
				<h4>Instagram</h4>
				<div>Username : <?= $modeuse->instagram ?></div>
				<div>Followers : <?= $modeuse->insta_followers ?></div>
			<?php } ?>

			<?php if($modeuse->twitter != null) { ?>
				<h4>Twitter</h4>
				<div>Username : <?= $modeuse->twitter ?></div>
			<?php } ?>

			<?php if($modeuse->facebook != null) { ?>
				<h4>Facebook</h4>
				<div>Username : <?= $modeuse->facebook ?></div>
			<?php } ?>

			<?php if($modeuse->pinterest != null) { ?>
				<h4>Pinterest</h4>
				<div>Username : <?= $modeuse->pinterest ?></div>
			<?php } ?>
			

			<h3>Compléter Profil</h3>

			<details class="update_profil">

				<div>
					<input type="hidden" class="user_id" value="<?=$user->id?>">
					<input type="file" id="upload" />
				</div>

				<?= $this->Form->create($modeuse) ?>
				<input type="hidden" name="type" value="<?=$user->type?>">
				<input type="hidden" name="modeuse_id" value="<?=$modeuse->id?>">
				<?= $this->Form->input('firstname'); ?>
				<?= $this->Form->input('instagram'); ?>
				<?= $this->Form->input('twitter'); ?>
				<?= $this->Form->input('facebook'); ?>
				<?= $this->Form->input('pinterest'); ?>
				<?= $this->Form->input('city'); ?>
				
				<button>Valider</button>
			    <?= $this->Form->end() ?>
			    
			</details>
	</div>	

	<div class="profile_section offers">
		<h2>Offres</h2>

		<button class="small show_create_offer">Créer une offre</button>

		<div class="create_offer wrapper_form">
			<?php
			    echo $this->Form->create();

			    echo $this->Form->input('title');
			    echo $this->Form->input('description');
			    echo $this->Form->input('date_begin');
			    echo $this->Form->input('date_end');
			    echo $this->Form->select('activities._ids', $activities, [ 'name' => 'activities[_ids][]', 'class' => 'activities']);
			    echo $this->Form->input('multiple_targets');
			    echo $this->Form->input('expected_targets'); ?>

			    <input type="hidden" name="brand_id" value="<?=$brand->id?>">
			    <?php echo $this->Form->button('Créer', ["class"=> "button small"]);

			    echo $this->Form->end(); 
			?>
		</div>

		<div>Liste des offres : 
			<ul>
				<?php foreach ($offers as $key => $offer) { ?>
					<li><?= $this->Html->link($offer->title, ['controller' => 'Offers', 'action' => 'view', $offer->id], ["target" => "_blank"]) ?></li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<?php } ?>

</section>


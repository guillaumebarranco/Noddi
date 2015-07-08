<?php
	$session = $this->request->session();

	if($session->read('type') == 'modeuse') {
		$user = $modeuse['user']; ?>

		<ul class="menu_profil">
			<li>
				<a href="#" data-section="profile">Profil</a>
			</li>

			<li>
				<a href="#" data-section="offers">Offres Postulées</a>
			</li>
		</ul>

	<?php } else {
		$user = $brand['user']; ?>

		<ul class="menu_profil">
			<li>
				<a href="#" data-section="profile">Profil</a>
			</li>

			<li>
				<a href="#" data-section="offers">Offres</a>
			</li>
		</ul>

	<?php }

?>

<div class="profile_section profile">

	<h2>Profil</h2>

	<div>
		Username : <?= $user->username ?>
	</div>
	
	<div>
		Biographie : <p><?= $user->bio ?></p>
	</div>
	
	<div>
		Website : <?= $user->website ?>
	</div>
	
	<div class="the_picture">
		Picture : <img src="<?= $user->picture ?>" width="150" alt="Image de <?= $user->username ?>" />
	</div>
	
	<div>
		Type : <?= $user->type ?>
	</div>


	<?php if($session->read('type') == 'brand') { ?>

		<div>
			Nom : <?= $brand->name ?>
		</div>

		<div>
			Secteur d'activité : <?= $activities[$brand->activity_id] ?>
		</div>

		<h3>Compléter Profil</h3>

		<div class="update_profil">
			<br><br>

			<div>
				<input type="hidden" class="user_id" value="<?=$user->id?>">
				<input type="file" id="upload" />
			</div>

			<?= $this->Form->create($brand) ?>
			<input type="hidden" name="brand_id" value="<?=$brand->id?>">
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

		<h3>Compléter Profil</h3>

		<details class="update_profil">

			<div>
				<input type="hidden" class="user_id" value="<?=$user->id?>">
				<input type="file" id="upload" />
			</div>

			<?= $this->Form->create($modeuse) ?>
			<input type="hidden" name="modeuse_id" value="<?=$modeuse->id?>">
			<?= $this->Form->input('firstname'); ?>
			
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
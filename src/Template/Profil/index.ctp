<?php
	$session = $this->request->session();

	if($session->read('type') == 'modeuse') {
		$user = $modeuse['user'];
	} else {
		$user = $brand['user'];
	}
	

?>

<h2>Profil</h2>

<div>
	<div>
		Username : <?= $user->username ?>
	</div>
	
	<div>
		Biographie : <p><?= $user->bio ?></p>
	</div>
	
	<div>
		Website : <?= $user->website ?>
	</div>
	
	<div>
		Picture : <img src="<?= $user->picture ?>" width="150" alt="Image de <?= $user->username ?>" />
	</div>
	
	<div>
		Type : <?= $user->type ?>
	</div>

	<?php if($session->read('type') == 'brand') { ?>
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

		Liste des offres : 
		<ul>
			<?php foreach ($offers as $key => $offer) { ?>
				<li><?= $this->Html->link($offer->title, ['controller' => 'Offers', 'action' => 'view', $offer->id]) ?></li>
			<?php } ?>
		</ul>
	<?php } ?>
	
</div>
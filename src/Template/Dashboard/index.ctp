<section class="page page_dashboard">
	<header class="headerPage">
	    <h2 class="titlePage">Dashboard</h2>
	    <!-- <div class="previousStepMenu"><a href="#">Précédent</a></div> -->
	</header>

	<div class="timeline"> <?=$offer->created->format('j-m -  H:i') ?></div>

	<article class="proposition">
		<h2><?=$offer->title?></h2>
		<div class="content">
			<img src="img/offers/<?=$offer->uniquid?>/1.png" alt="" />
			<div class="proposition_content">
				<b><?=$offer->lifestyle?></b>
				<p><?=$offer->exchange?></p>
			</div>
			<footer class="proposition_buttons">
				<div class="edit">Editer</div>
				<div class="delete deleteOffer" data-offer="<?=$offer->id?>">Supprimer</div>
			</footer>
		</div>
	</article>

	<?php if(!empty($applies_brand)) { ?>

		<div class="propositions">

		<?php foreach ($applies_brand as $key => $apply_brand) { ?>
	
			<div class="proposition_sent">
				<img src="<?=$apply_brand->modeus->user->picture?>" alt="" />
				<div class="info">Demande envoyée à <?=$apply_brand->modeus->firstname?></div>
				<div class="status">EN ATTENTE</div>
			</div>

		<?php } ?>

		</div>

	<?php } ?>

	<?php if(!empty($applies_modeuse)) { 

		foreach ($applies_modeuse as $key => $apply_modeuse) { 

			if($apply_modeuse->accepted != 2) { ?>

			<div class="proposition_received">
				<img src="<?=$apply_modeuse->modeus->user->picture?>" width="50" alt="">
				<p>Demande reçue de <?=$apply_modeuse->modeus->firstname?></p>

				<footer>
					<div class="accept acceptApply" data-offer="<?=$offer->id?>" data-apply="<?=$apply_modeuse->id?>" data-modeuse="<?=$apply_modeuse->modeus->id?>">Accepter</div>
					<div class="decline removeApply" data-apply="<?=$apply_modeuse->id?>">Décliner</div>
				</footer>
			</div>
		<?php }
		}
	} ?>
	

	<?= $this->Html->link(__('Continuer la recherche de Noddiz'), ['controller' => 'Home', 'action' => 'index'], ['class' => 'button']) ?>

</section>

<?= $this->Html->script('offers') ?>
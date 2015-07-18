<section class="page page_dashboard">
	<header class="headerPage">
	    <h2 class="titlePage">Dashboard</h2>
	    <!-- <div class="previousStepMenu"><a href="#">Précédent</a></div> -->
	</header>

	
	<?php if(!empty($finished_offers[0])) { ?>
		<button class="button">Propositions terminées</button> 
		<button class="button">Proposition en cours</button>
	<?php } ?>

	<article class="proposition">

		<div class="blue_header">
			<h2><?=$offer->title?></h2>
			<span class="delete deleteOffer" data-offer="<?=$offer->id?>"></span>
		</div>
		
		<div class="content">
			<img src="img/offers/<?=$offer->uniquid?>/1.png" alt="" />
			<div class="proposition_content">
				<b><?=$offer->type->name?></b>
				<p><?=$offer->exchange?></p>
				<p class="borderTop">EN ATTENTE</p>
			</div>
		</div>

	</article>
	
	<?php 
		if(!empty($applies_modeuse[0]) || !empty($applies_brand[0])) {
			echo $this->Html->link(__('Voir ma proposition'), ['action' => 'view', $offer->id], ['class' => 'button']);
		}
	?>

	<?= $this->Html->link(__('Continuer la recherche de Noddiz'), ['controller' => 'Home', 'action' => 'index'], ['class' => 'button']) ?>

</section>

<?= $this->Html->script('offers') ?>
<section class="page page_dashboard">
	<header class="headerPage">
	    <h2 class="titlePage">Dashboard</h2>
	    <!-- <div class="previousStepMenu"><a href="#">Précédent</a></div> -->
	</header>

	
	<?php if(!empty($finished_offers[0])) { ?>
		<button class="button">Propositions terminées</button> 
		<button class="button">Proposition en cours</button>
	<?php } ?>

	<div class="timeline"> <?=$offer->created->format('j-m -  H:i') ?></div>

	<?php if(!empty($applies_brand[0])) { ?>

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

	<?php if(!empty($applies_modeuse[0])) { 

		foreach ($applies_modeuse as $key => $apply_modeuse) { 

			if($apply_modeuse->accepted != 2) { ?>

			<div class="proposition_received">
				<div></div>
				<div class="profile_picture" style="background-image: url(<?=$apply_modeuse->modeus->user->picture?>);"></div>
				<p>Demande reçue de <?=$apply_modeuse->modeus->firstname?></p>

				<footer>
					<div class="button accept acceptApply" data-offer="<?=$offer->id?>" data-apply="<?=$apply_modeuse->id?>" data-modeuse="<?=$apply_modeuse->modeus->id?>">Accepter</div>
					<div class="button decline removeApply" data-apply="<?=$apply_modeuse->id?>">Décliner</div>
				</footer>
			</div>
		<?php }
		}
	} ?>

	<article class="proposition">

		<div class="blue_header">
			<h2><?=$offer->title?></h2>
			<span class="delete deleteOffer" data-offer="<?=$offer->id?>"></span>
		</div>
		
		<div class="content">
			<img src="<?=$this->request->base?>/img/offers/<?=$offer->uniquid?>/1.png" alt="" />
			<div class="proposition_content">
				<b><?=$offer->type->name?></b>
				<p><?=$offer->exchange?></p>
				<p class="borderTop">EN ATTENTE</p>
			</div>
			<!--<footer class="proposition_buttons">
				<div class="edit">Editer</div>
				<div class="delete deleteOffer" data-offer="<?=$offer->id?>">Supprimer</div>
			</footer> -->
		</div>
	</article>
	
</section>

<?= $this->Html->script('offers') ?>
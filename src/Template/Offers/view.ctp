<?php if($this->request->session()->read('type') == 'modeuse') { ?>
<section class="page page_viewOffer">
	<header class="headerPage">
	    <h2 class="titlePage">Fiche Proposition</h2>
	    <div class="previousStepMenu">
	    	<a href="<?=$this->request->base?>/offers">
	    		Précédent
	    	</a>
	    </div>
	</header>
	<div class="content">
		<article class="offer">
			<header style="background-image:url('<?=$this->request->base?>/img/offers/<?=$offer->uniquid?>/1.png');"></header>
			<div class="contentArticle">
				<h3>Informations générales</h3>
				<div class="infoBrand">
					<img src="<?=$offer->brand->user->picture?>" alt="infos">
					<div class="infoBranText">
						<h4><?=$offer->brand->name?></h4>
						<p><?=$offer->brand->activity->name?></p>
						<p><?=$offer->brand->city?></p>
					</div>
				</div>
			</div>
			<footer>
				<h3>Informations sur l'offre <small><?=$offer->title?></small></h3>
				<p><?=$offer->description?></p>
				<p>En échange de <strong><?=$offer->type->name?></strong> (<strong><?=$offer->exchange?></strong> de <strong><?=$offer->brand->name?></strong> ), tu t'engages à partager le bon plan à ta communauté.</p>
				<p>Disponibilité : A partir de maintenant</p>
				<div class="apply_offer button reversed" data-offer="<?=$offer->id?>" data-fromwho="<?=$this->request->session()->read('type')?>" data-modeuse="<?=$this->request->session()->read('modeuse_id')?>">Utiliser mon boost</div>
			</footer>
		</article>
	</div>

	
</section>


<?php } ?>

<?= $this->Html->script('offers') ?>
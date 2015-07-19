<?php if($this->request->session()->read('type') == 'modeuse') { ?>

    <h1>Fiche Proposition</h1>

    <h2>Informations générales</h2>

    <img src="<?=$this->request->base?>/img/offers/<?=$offer->uniquid?>/1.png" width="200" alt="" />
	
	<p><?=$offer->brand->name?></p>
	<p><?=$offer->brand->activity->name?></p>
	<p><?=$offer->brand->city?></p>

	<div>
		<h3><?=$offer->title?></h3>
    	<p><?=$offer->description?></p>
	</div>

	<h2>Informations sur l'offre</h2>

	<p>
		En échange de <strong><?=$offer->type->name?></strong> (<strong><?=$offer->exchange?></strong> de la Petite Luciole), tu t'engages à partager le bon plan à ta communauté.
	</p>

	<p>
		Disponibilité : A partir de maintenant
	</p>
    

    <button class="apply_offer button" data-offer="<?=$offer->id?>" data-fromwho="<?=$this->request->session()->read('type')?>" data-modeuse="<?=$this->request->session()->read('modeuse_id')?>">Utiliser mon boost</button>


<?php } ?>
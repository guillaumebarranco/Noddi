<?php if($this->request->session()->read('type') == 'modeuse') { ?>

    <h1>Fiche Proposition</h1>

    <h2>Informations générales</h2>

    <?=$offer->title?>
    
    

    <?=$offer->description?>

    <button class="apply_offer button" data-offer="<?=$offer->id?>" data-fromwho="<?=$this->request->session()->read('type')?>" data-modeuse="<?=$this->request->session()->read('modeuse_id')?>">Utiliser mon boost</button>






<?php } ?>
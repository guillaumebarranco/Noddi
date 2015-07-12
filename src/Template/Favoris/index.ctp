<ul>
    <?php foreach ($favoris as $key => $favori) { 
        ?>
        <li>
            <?=$favori->modeus->firstname?>
            <img src="<?=$favori->modeus->picture?>" width="150" alt="" />
            <button class="button delete_favori" data-favori="<?=$favori->id?>">Supprimer favori</button>
        </li>
    <?php } ?>
</ul>
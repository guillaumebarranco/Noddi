
<div class="page_index">
	<section class="section_home">
	
		<header class="headerPage">
			<h2 class="titlePage">Favoris</h2>
		</header>

		<ul class="all_favoris">
		    <?php 
		    if(!empty($favoris[0])) {
		    	foreach ($favoris as $key => $favori) { ?>

			        <li class="modeuse">

						<a href="/Noddi/Modeuses/view/<?=$favori->modeus->id?>">
							<div class="modeusePic" style="background-image:url(<?=$favori->modeus->user->picture?>);"></div>
						</a>

						<div class="infoModeuse">
							<p class="modeuseName"><?=$favori->modeus->firstname?></p>

							<ul class="modeuseStats">
								<li class="stat facebook"><?=$favori->modeus->facebook_followers?></li>
								<li class="stat twitter"><?=$favori->modeus->twitter_followers?></li>
								<li class="stat instagram"><?=$favori->modeus->insta_followers?></li>
							</ul>

							<div class="delete_favori" data-favori="<?=$favori->id?>"></div>
						</div>
					</li>




			    <?php }
			    } else {
			    	echo "<p>Vous n'avez pas de favori pour le moment. Ajoutez-en parmi les Noddiz !</p>";
			    	echo $this->Html->link(__('Voir les Noddiz'), ['controller' => 'Home', 'action' => 'index'], ['class' => 'button']);
			    } ?>
		    
		</ul>
	</section>
</div>


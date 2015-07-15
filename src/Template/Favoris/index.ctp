
<div class="page_index">
	<section class="section_home section_les_noddiz">
		<ul class="all_favoris">
		    <?php foreach ($favoris as $key => $favori) { 
		        ?>

		        <li class="modeuse">

					<a href="/Noddi/Modeuses/view/<?=$favori->modeus->id?>">
						<img class="modeusePic" src="<?=$favori->modeus->picture?>" />
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
		    <?php } ?>
		</ul>
	</section>
</div>


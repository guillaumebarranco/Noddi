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
	
</div>
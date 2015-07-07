<?php if($this->request->session()->read('user')) { ?>
	
	<h2>Bon retour sur la plateforme Noddi <strong><?= $this->request->session()->read('username') ?></strong> !</h2>

	<p>
		Vous êtes une 

		<strong>
			<?php if($this->request->session()->read('type') == 'brand') {
				echo 'marque';
			} else {
				echo $this->request->session()->read('type');
			} ?>
		</strong>

		<p>
			Vous pouvez vous rendre sur <?= $this->Html->link(__('votre profil'), ['controller' => 'Profil', 'action' => 'index']) ?>
		</p>

	</p>

<?php } else { ?>
	
	<h2>Bienvenue sur la plateforme Noddi !</h2>

<?php } ?>

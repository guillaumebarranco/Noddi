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

	
	<h1>Bienvenue sur la plateforme Noddi !</h1>
	<h2>Bienvenue sur la plateforme Noddi !</h2>
	<h3>Bienvenue sur la plateforme Noddi !</h3>
	<h4>Bienvenue sur la plateforme Noddi !</h4>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, mollitia porro deleniti unde deserunt illum temporibus, vitae voluptatibus dolorem ipsam est. Accusamus, alias, neque?</p>

<form action="#">
	<input type="text" placeholder="lol">
	<input type="password" placeholder="super">
	<div class="button regular">Valider</div>
	<div class="button reversed">Connexion</div>
	<div class="button regular small">Valider</div>
</form>


<?= $this->Html->link(__('Inscription Marque'), ['controller' => 'Users', 'action' => 'sign_in_brand'], ['class' => 'button']) ?>

<button>Inscription modeuse</button>

<div>
	<button>Se connecter</button>
</div>


<ul>
	<li>Explication</li>
	<li>Explication</li>
	<li>Explication</li>
</ul>

<section>
	Explication
</section>

<section>
	Explication
</section>

<?php } ?>

<section class="page page_login">
	<div class="logo">
		<img src="<?=$this->request->base?>/img/logo.svg" alt="Noddi logo"/>
	</div>
	<div class="connectSections">
		<h2>Modeuses</h2>
		<button class="button fb_button">Se connecter via Facebook</button>
	</div>


	<div class="connectSections">
		<h2>Professionnel</h2>

		<?php
		    echo $this->Form->create(null, [
		        'url' => ['controller' => 'Users', 'action' => 'login']
		    ]);

		    echo $this->Form->input('username');
		    echo $this->Form->input('password');

		    echo $this->Form->button('Se connecter', ["class"=> "button small reversed"]);

		    echo $this->Form->end(); 
		?>
	</div>

	<div>
		<?= $this->Html->link(__("Je n'ai pas encore de compte"), ['controller' => 'Users', 'action' => 'sign_in']) ?>
	</div>

</section>

<?= $this->Html->script('register') ?>
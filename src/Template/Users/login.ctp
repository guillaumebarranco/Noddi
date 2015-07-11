<section class="page_login" style="width: 500px; margin: 0 auto;">

	<div style="border:solid 1px black; padding: 10px;">
		<h2>Modeuses</h2>

		<button class="button fb_button">Se connecter via Facebook</button>
	</div>

	<br>

	<div style="border:solid 1px black; padding: 10px;">
		<h2>Marques</h2>

		<?php
		    echo $this->Form->create(null, [
		        'url' => ['controller' => 'Users', 'action' => 'login']
		    ]);

		    echo $this->Form->input('username');
		    echo $this->Form->input('password');

		    echo $this->Form->button('Se connecter', ["class"=> "button small"]);

		    echo $this->Form->end(); 
		?>
	</div>

	<div>
		<?= $this->Html->link(__("Je n'ai pas encore de compte"), ['controller' => 'Users', 'action' => 'sign_in']) ?>
	</div>

</section>

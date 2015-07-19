<section class="page page_login">
	<header class="headerPage">
	    <h2 class="titlePage">Se connecter</h2>
	    <div class="previousStepMenu">
	    	<a href="<?=$this->request->base?>">
	    		Précédent
	    	</a>
	    </div>
	</header>
	<section class="connect">
		<div class="connectSections modeuse">
			<h2>Modeuses</h2>
			<div class="content">
				<button class="button fb_button">Se connecter via Facebook</button>
			</div>
		</div>

		<div class="connectSections brand">
			<h2>Professionnel</h2>
			<div class="content">
				<div class="offsetForm">
					<?php
					    echo $this->Form->create(null, [
					        'url' => ['controller' => 'Users', 'action' => 'login']
					    ]);?>

					    <label class="displayLabel username" for="username">Nom utilisateur</label>
					    <?php echo $this->Form->input('username');?>
					    <label class="displayLabel password" for="password">password</label>
					    <?php echo $this->Form->input('password');?>
				</div>
					    <?php echo $this->Form->button('Se connecter', ["class"=> "button dark reversed"]);

					    echo $this->Form->end(); 
					?>
			</div>
		</div>

		<div class="center signInLink">
			<?= $this->Html->link(__("Je n'ai pas encore de compte"), ['controller' => 'Users', 'action' => 'sign_in']) ?>
		</div>
	</section>

</section>

<?= $this->Html->script('register') ?>

<section class="page page_login">
	<header class="headerPage">
	    <h2 class="titlePage">S'inscrire</h2>
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
				<?= $this->Html->link(__('Inscription Modeuse'), ['controller' => 'Users', 'action' => 'sign_in_modeuse'], ['class' => 'button']) ?>
			</div>
		</div>

		<div class="connectSections brand">
			<h2>Professionnel</h2>
			<div class="content">
				<?= $this->Html->link(__('Inscription Marque'), ['controller' => 'Users', 'action' => 'sign_in_brand'], ['class' => 'button dark']) ?>
			</div>
		</div>

	</section>

</section>

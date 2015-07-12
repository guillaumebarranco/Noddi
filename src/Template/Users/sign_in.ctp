<section class="page page_signin">
<div class="inscriptionType">
	<?= $this->Html->link(__('Inscription Marque'), ['controller' => 'Users', 'action' => 'sign_in_brand'], ['class' => 'button']) ?>

	<?= $this->Html->link(__('Inscription Modeuse'), ['controller' => 'Users', 'action' => 'sign_in_modeuse'], ['class' => 'button']) ?>
</div>
</section>
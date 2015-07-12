<?php if($this->request->session()->read('user')) { ?>
	
	<?php if($this->request->session()->read('type') == 'brand') { ?>
		<p>
			Vite, vite, vive ! Votre notoriété n'attend que vous !
		</p>
		<?= $this->Html->link(__('Créer une offre'), ['controller' => 'Offers', 'action' => 'add'], ['class' => 'button']) ?>
	<?php } else { ?>

	<?php } ?>

<?php } else { ?>

<style>
.button {
	display: inline-block;
	}
	</style>

	<div style="width:320px;margin: 0 auto;">

		<div class="buttons">
			<?= $this->Html->link(__('Inscription Marque'), ['controller' => 'Users', 'action' => 'sign_in_brand'], ['class' => 'button']) ?>
			<button class="button">Inscription modeuse</button>
		</div>
		
		<div class="background-picture">
			<h1>Noddi</h1>
			<p>Mettre sa notoriété à profit n'a jamais été aussi simple</p>
			<?= $this->Html->link(__("Se connecter"), ['controller' => 'Users', 'action' => 'login'], ['class' => 'button']) ?>
		</div>

		<ul class="home_list">
			<li>Une plateforme 100% gratuite pour partager des expériences inédites et exclusives</li>
			<li>De nombreuses marques et modeuses réunies sur une seule et même plateforme</li>
			<li>Des modeuses influentes et des marques sérieuses pour des rencontres fiables</li>
		</ul>

		<div class="background-picture background-modeuse">
			<div>
				<h2>Modeuse</h2>
				<p>
					Toi, modeuse en quête de bons plans. tu souhaites collaborer avec de jeunes créateurs et des boutiques trendy ? Ne cherche plus, Noddi est fait pour toi !
				</p>
				<button class="button">S'inscrire</button>
			</div>
		</div>

		<div class="background-picture background-brand">
			<div>
				<h2>Marque</h2>
				<p>
					Vous êtes à la recherche de visiblité ? Trouvez la modeuse qui parlera de vous auprès de sa communauté et vous fera gagner en notoriété.
				</p>
				<?= $this->Html->link(__("S'inscrire"), ['controller' => 'Users', 'action' => 'sign_in_brand'], ['class' => 'button']) ?>
			</div>
		</div>
	</div>

	

	<!-- 
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
</section> -->

<?php } ?>

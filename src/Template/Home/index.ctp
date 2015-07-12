<?php if($this->request->session()->read('user')) { ?>
	<style>
		.blog_selected, .network_selected, .section_selected, .audience_selected {
			background-color: blue;
		}
	</style>
	<?php if($this->request->session()->read('type') == 'brand') { ?>
		
		<?php if($can_make_offer) { ?>
			<p>
				Vite, vite, vive ! Votre notoriété n'attend que vous !
			</p>
			<?= $this->Html->link(__('Créer une offre'), ['controller' => 'Offers', 'action' => 'add'], ['class' => 'button']) ?>
		<?php } else { ?>

			<h2 class="h2_home">Les Noddiz</h2>

			<div class="section_home section_les_noddiz">
				<button class="button show_socials" >Réseaux sociaux</button>
				<button class="button show_audience">Audience</button>

				<ul class="list_modeuses">				
				</ul>
			</div>

			<div class="section_home section_socials">

				<button class="button show_socials" >Réseaux sociaux</button>
				<button class="button show_audience">Audience</button>

				<h3>Blog</h3>

				<div class="socials_blog">
					<button class="button" data-blog="yes">Oui</button>
					<button class="button" data-blog="no">Non</button>
					<button class="button blog_selected" data-blog="whatever">Peu importe</button>
				</div>
				

				<h3>Réseaux sociaux</h3>
				<p>
					Sélectionnez les réseaux sociaux sur lesquels vous souhaitez que la Noddiz soit présente
				</p>

				<ul class="socials_network">
					<li class="button" data-network="facebook">Facebook</li>
					<li class="button" data-network="twitter">Twitter</li>
					<li class="button" data-network="instagram">Instagram</li>
					<li class="button network_selected" data-network="all">TOUS</li>
				</ul>

				<button class="button filter_home">Filtrer</button>

			</div>

			<div class="section_home section_audience">

				<button class="button show_socials" >Réseaux sociaux</button>
				<button class="button show_audience">Audience</button>

				<p>
					Les totems représentant l'influence d'une modeuse sont calculés grâce à son nombre de followers global, le fait qu'elle ait ou non un blog et le nombre de réseaux sociaux sur lesquels elle est présente.
				</p>

				<ul class="socials_audience">
					<li class="button" data-audience="beginner">Influençeuse débutante</li>
					<li class="button" data-audience="medium">Influençeuse intermédiaire</li>
					<li class="button" data-audience="expert">Influençeuse experte</li>
					<li class="button audience_selected" data-audience="all">TOUS</li>
				</ul>

				<button class="button filter_home">Filtrer</button>

			</div>

		<?php } ?>
		
	<?php } else { ?>

	<?php } ?>

<?php } else { ?>

	<div>

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

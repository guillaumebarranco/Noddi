<div class="page page_index">
	<?php if($this->request->session()->read('user')) { ?>
		
		<?php if($this->request->session()->read('type') == 'brand') { ?>
			<p>
				Vite, vite, vive ! Votre notoriété n'attend que vous !
			</p>
			<?= $this->Html->link(__('Créer une offre'), ['controller' => 'Offers', 'action' => 'add'], ['class' => 'button']) ?>
		<?php } else { ?>

		<?php } ?>

	<?php } else { ?>

		<header>
			<div class="topMenu">
				<div class="logo">
					<img src="<?=$this->request->base?>/img/logo.svg" alt="Noddi logo"/>
				</div>
				<?= $this->Html->link(__("Se connecter"), ['controller' => 'Users', 'action' => 'login'], ['class' => 'button']) ?>
			</div>
			<div class="content">
				<h2>mettre sa notoriété à profit n’a jamais été aussi simple.</h2>
				<?= $this->Html->link(__("Inscription Marque"), ['controller' => 'Users', 'action' => 'sign_in_brand'], ['class' => 'button reversed dark']) ?>
				<?= $this->Html->link(__("Inscription Modeuse"), ['controller' => 'Users', 'action' => 'sign_in_modeuse'], ['class' => 'button reversed']) ?>
			</div>
		</header>

		<section class="servicePresentation">
			<div class="presentation free">
				<h3>Gratuit</h3>
				<p>Une plateforme 100% gratuite pour partager des expériences inédites et exclusives</p>
			</div>
			<div class="presentation simple">
				<h3>Simple & Rapide</h3>
				<p>De nombreuses marques et modeuses réunies sur une seule et même plateforme</p>
			</div>
			<div class="presentation reliable">
				<h3>Fiable</h3>
				<p>Des modeuses influentes et des marques sérieuses pour des rencontres fiables</p>
			</div>
		</section>

		<section class="memberType modeuse">
			<div class="typeDescription">
				<div class="illustration illu1 showLarge"></div>
				<div class="description">
					<h2>Modeuse</h2>
					<p>Toi, la modeuse en quête de bons plans, tu souhaites collaborer avec de jeunes créateurs et des boutiques trendy ? Ne cherche plus, Noddi est fait pour toi !</p>
				</div>
			</div>
			<div class="typeDescription details">
				<div class="illustration illu2 showLarge"></div>
				<div class="description">
					<ul>
						<li><span>1</span>Reçois des offres personnalisées</li>
						<li><span>2</span>Choisis tes créateurs et boutiques</li>
						<li><span>3</span>Partage ton expérience</li>
					</ul>
					<?= $this->Html->link(__("S'inscrire"), ['controller' => 'Users', 'action' => 'sign_in_modeuse'], ['class' => 'button reversed']) ?>
				</div>
			</div>
		</section>

		<section class="memberType marque">
			<div class="typeDescription">
				<div class="illustration illu3 showLarge"></div>
				<div class="description">
					<h2>Marque</h2>
					<p>Jeunes créateurs et boutiques trendy, vous êtes à la recherche de visibilité ? Sur Noddi, trouvez la modeuse qui parlera de vous auprès de sa communauté.</p>
				</div>
			</div>
			<div class="typeDescription details">
				<div class="illustration illu4 showLarge"></div>
				<div class="description">
					<ul>
						<li><span>1</span>Choisissez votre modeuse</li>
						<li><span>2</span>Collaborez avec elle</li>
						<li><span>3</span>Gagnez en notoriété</li>
					</ul>
					<?= $this->Html->link(__("S'inscrire"), ['controller' => 'Users', 'action' => 'sign_in_brand'], ['class' => 'button reversed dark']) ?>
				</div>
			</div>
		</section>
	

	<?php } ?>
</div>
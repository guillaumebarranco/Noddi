<section class="page page_dashboard">
	<header class="headerPage">
	    <h2 class="titlePage">Dashboard</h2>
	    <!-- <div class="previousStepMenu"><a href="#">Précédent</a></div> -->
	</header>

	<div class="timeline">10 juillet - 10:20</div>

	<article class="proposition">
		<h2>Ma Proposition</h2>
		<div class="content">
			<img src="https://pbs.twimg.com/profile_images/473506797462896640/_M0JJ0v8.png" alt="" />
			<div class="proposition_content">
				<b>Bijoux</b>
				<p>Don</p>
			</div>
			<footer class="proposition_buttons">
				<div class="edit">Editer</div>
				<div class="delete">Supprimer</div>
			</footer>
		</div>
	</article>
	
	<div class="propositions">
		<div class="proposition_sent">
			<img src="https://pbs.twimg.com/profile_images/473506797462896640/_M0JJ0v8.png" alt="" />
			<div class="info">Demande envoyée à Anna G.</div>
			<div class="status">EN ATTENTE</div>
		</div>
		<div class="proposition_sent">
			<img src="https://pbs.twimg.com/profile_images/473506797462896640/_M0JJ0v8.png" alt="" />
			<div class="info">Demande envoyée à Anna G.</div>
			<div class="status">EN ATTENTE</div>
		</div>
	</div>


	<div class="proposition_received">
		<img src="https://pbs.twimg.com/profile_images/473506797462896640/_M0JJ0v8.png" width="50" alt="">
		<p>Demande Rçue de Caroline B.</p>
		<footer>
			<div class="accept">Accepter</div>
			<div class="decline">Décliner</div>
		</footer>
	</div>

	<?= $this->Html->link(__('Continuer la recherche de Noddiz'), ['controller' => 'Home', 'action' => 'index'], ['class' => 'button']) ?>

</section>
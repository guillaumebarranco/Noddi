<section class="page page_messagerie">
    <header class="headerPage">
        <h2 class="titlePage">Messagerie</h2>
        <div class="previousStepMenu previousStepMenuMessage"><a href="#">Précédent</a></div>
    </header>





    <div class="all_messages">

        <?php 
        if(!empty($tab_offers)) {
            foreach ($tab_offers as $message) { ?>

                <div class="message">
                    
                    <?php if($this->request->session()->read('type') == 'modeuse') { ?>
                        <h3 class="message_sender"><?=$message['name']?></h3>
                    <?php } else { ?>
                        <h3 class="message_sender"><?=$message['firstname']?> <?=$message['lastname']?></h3>
                    <?php } ?>
        
                    <input type="hidden" class="get_the_type" value="<?=$this->request->session()->read('type')?>">
                    
                    <div class="message_time"><?=$message['created'] ?></div>
                    <p class="message_content"><?=$message['message']?></p>

                    <button class="button seeConversation" data-offer="<?=$message['id']?>">Voir la conversation</button>

                </div>

            <?php } 
        } else {

            echo "<p>Vous n'avez pas de conversation pour le moment.</p>";

            if($this->request->session()->read('type') == 'modeuse') {

                if($modeuse->boost == 1) {

                    echo "<p>Il vous reste cependant un boost pour postule à une offre !";
                        echo $this->Html->link(__('Voir les Offres'), ['controller' => 'Offers', 'action' => 'index'], ['class' => 'button']);
                    echo "</p>";
                    
                } else {

                    echo "<p>Tenez vous au courant de vos propositions éventuelles !</p>";
                    echo $this->Html->link(__('Voir les Offres'), ['controller' => 'Offers', 'action' => 'index'], ['class' => 'button']);
                }

            } else {

                if(!isset($offer[0])) {
                    echo "<p>Vous n'avez pas d'offre, allez vite en faire une !</p>";
                    echo $this->Html->link(__('Créer une offre'), ['controller' => 'Home', 'action' => 'index'], ['class' => 'button']);
                } else {
                    echo'<p>Proposez votre offre à des Noddiz !</p>';
                    echo $this->Html->link(__('Voir les Noddiz'), ['controller' => 'Home', 'action' => 'index'], ['class' => 'button']);
                }
            }
        } ?>

    </div>

    <div class="answer_message">
        <div class="answer_name"></div>
        <textarea name="answer_content" class="answer_content"></textarea>
        <div class="answer_time"></div>

        <button class="button sendMessage">Répondre</button>
    </div>

    <div class="conversation">
        <ul></ul>
        <form action="" class="formSendMessage">
            <textarea name="" id="" cols="30" rows="10"></textarea>
            <button class="button">Envoyer</button>
        </form>
    </div>
    
</section>
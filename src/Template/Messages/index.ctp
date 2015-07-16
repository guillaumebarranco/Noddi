<section class="page page_messagerie">
    <header class="headerPage">
        <h2 class="titlePage">Messagerie</h2>
        <!-- <div class="previousStepMenu"><a href="#">Précédent</a></div> -->
    </header>
    <div class="all_messages">

        <?php foreach ($tab_offers as $message) { ?>

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

        <?php } ?>
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
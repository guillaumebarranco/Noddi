<section class="page page_messagerie">
    <header class="headerPage">
        <h2 class="titlePage">Messagerie</h2>
        <!-- <div class="previousStepMenu"><a href="#">Précédent</a></div> -->
    </header>
    <div class="all_messages">

        <h2>Messages envoyés</h2>

        <?php foreach ($messages as $message) {

            if($message->from_who === 'brand') { ?>

                <div class="message">

                    <h3 class="message_sender"><?=$message->modeus->firstname?> <?=$message->modeus->lastname?></h3>
                    <div class="message_time"><?=$message->created->format('H:i'); ?></div>
                    <p class="message_content"><?=$message->content?></p>

                </div>

            <?php } 
        } ?>

        <h2>Messages reçus</h2>

        <?php foreach ($messages as $message) {

            if($message->from_who === 'modeuse') { ?>

                <div class="message">

                    <h3 class="message_sender"><?=$message->modeus->firstname?> <?=$message->modeus->lastname?></h3>
                    <div class="message_time"><?=$message->created->format('H:i'); ?></div>
                    <p class="message_content"><?=$message->content?></p>

                    <?php if($message->viewed == 0) { 
                        echo 'not viewed';
                        echo '<input type="hidden" name="viewed" value="'.$message->id.'" />';
                    } else {
                        echo 'viewed';
                    } ?>

                    <?php if($message->answered == 0) { ?>

                        <input type="hidden" name="modeuse_id" value="<?=$message->modeus->id?>" />
                        <input type="hidden" name="brand_id" value="<?=$message->brand->id?>" />

                        <button class="button answerMessage">Répondre</button>

                    <?php } else { ?>
                        answered
                    <?php } ?>

                    
                </div>

            <?php } 
        } ?>  
    </div>


    <div class="answer_message">
        <div class="answer_name"></div>
        <textarea name="answer_content" class="answer_content"></textarea>
        <div class="answer_time"></div>

        <button class="button sendMessage">Répondre</button>
    </div>
    
    </section>
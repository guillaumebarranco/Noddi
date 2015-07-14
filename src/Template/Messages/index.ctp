<div class="all_messages">
    <?php foreach ($messages as $message) {

        if($message->from === 'brand') { ?>

            <h2>Messages envoyés</h2>

            <div><?=$message->content?></div>

        <?php } else { ?>

            <h2>Messages reçus</h2>

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

                <input type="hidden" name="modeuse_id" value="<?=$message->modeus->id?>" />
                <input type="hidden" name="brand_id" value="<?=$message->brand->id?>" />


                <button class="button answerMessage">Répondre</button>
            </div>

        <?php } 
    } ?>  
</div>


<div class="answer_message">
    <div class="answer_name"></div>
    <div class="answer_content"></div>
    <div class="answer_time"></div>

    <button class="button sendMessage">Répondre</button>
</div>
<div class="wrapper_form">
	<?php
	    echo $this->Form->create(null, [
	        'url' => ['controller' => 'Users', 'action' => 'sign_in']
	    ]);

	    echo $this->Form->input('username');
	    echo $this->Form->input('password');

	    echo '<label for="bio">Bio</label>';
	    echo $this->Form->textarea('bio');

	    echo $this->Form->input('website', ['placeholder' => 'http://monsite.fr']);
	    echo $this->Form->input('picture', ['type' => 'hidden', 'value' => 'default.jpg']); ?>

	    <select name="type" id="">
	    	<option value="modeuse">Modeuse</option>
	    	<option value="brand">Marque</option>
	    </select>

	    <?php echo $this->Form->button('Sign In', ["class"=> "button small"]);

	    echo $this->Form->end(); 
	?>
</div>
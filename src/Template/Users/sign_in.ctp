<div class="wrapper_form">
	<?php
	    echo $this->Form->create(null, [
	        'url' => ['controller' => 'Users', 'action' => 'sign_in']
	    ]);

	    echo $this->Form->input('username');
	    echo $this->Form->input('password');
	    echo $this->Form->input('bio');
	    echo $this->Form->input('website');
	    echo $this->Form->input('picture'); ?>

	    <select name="type" id="">
	    	<option value="modeuse">Modeuse</option>
	    	<option value="brand">Marque</option>
	    </select>

	    <?php echo $this->Form->button('Sign In', ["class"=> "button small"]);

	    echo $this->Form->end(); 
	?>
</div>
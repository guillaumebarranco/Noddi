<style>
	.wrapper_form {
		width: 400px;
		margin: 0 auto;
	}
</style>

<div class="wrapper_form">
	<?php
	    echo $this->Form->create(null, [
	        'url' => ['controller' => 'Users', 'action' => 'sign_in']
	    ]);

	    echo $this->Form->input('username');
	    echo $this->Form->input('password');
	    echo $this->Form->input('bio');
	    echo $this->Form->input('website');
	    echo $this->Form->input('picture');
	    echo $this->Form->input('type');

	    echo $this->Form->button('Login', ["class"=> "button small"]);

	    echo $this->Form->end(); 
	?>
</div>
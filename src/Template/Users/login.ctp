<div id="login_page">
	<?php
	    echo $this->Form->create(null, [
	        'url' => ['controller' => 'Users', 'action' => 'login']
	    ]);

	    echo $this->Form->input('username');
	    echo $this->Form->input('password');

	    echo $this->Form->button('Login', ["class"=> "button small"]);

	    echo $this->Form->end(); 
	?>
</div>
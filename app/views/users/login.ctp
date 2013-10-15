<div class = "small container">

<div id = "imgContainer"><img src = "/img/signin.png"></div>
<?php
    echo $this->Session->flash('auth');
    echo $this->Form->create('User');
    echo $this->Form->input('username');
    echo $this->Form->input('password');
    echo $this->Form->end('Login');
    echo "<a href = '/users/register'>create an account</a>";
    echo "<a class='forgotpassword' href = '/users/forgotpassword'>forgot your password?</a>";
?>
</div>
<script type='text/javascript'>
	$(document).ready(function(){
		$('#UserUsername').focus();
	});
</script>
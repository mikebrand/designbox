<div class = "small container">

<div id = "imgContainer"><img src = "/img/forgotPW.png"></div>
<?php
    echo $this->Session->flash('auth');
    echo $this->Form->create('User');
    echo $this->Form->input('email');
    echo $this->Form->end('Reset my password');
    echo "<a href = '/users/register'>create an account</a>";
    echo "<a class='forgotpassword' href = '/users/login'>login</a>";
    
    
?>
</div>
<script type='text/javascript'>
	$(document).ready(function(){
		$('#UserEmail').focus();
	});
</script>
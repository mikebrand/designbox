<div class = "small container">

<div id = "imgContainer"><img src = "/img/forgotPW.png"></div>
<?php
    echo $this->Session->flash('auth');
    echo $this->Form->create('User');
    echo $this->Form->input('password');
    echo $this->Form->input('confirm_password',array('type'=>'password'));
    echo $this->Form->input('hash',array('type'=>'hidden','value'=>$resethash));
    echo $this->Form->input('userid',array('type'=>'hidden','value'=>$userid));
    echo $this->Form->end('Reset my password');
    echo "<a href = '/users/register'>create an account</a>";
    echo "<a class='forgotpassword' href = '/users/login'>login</a>";
    
    
?>
</div>
<script type='text/javascript'>
	$(document).ready(function(){
		$('#UserPassword').focus();
	});
</script>
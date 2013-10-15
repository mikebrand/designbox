<div class = "container">
<?php
	echo "<h2 class = 'margin'>".$user['User']['name']."'s Projects</h2>";
	
	if($currentUser['User']['name'] !=$user['User']['name']){
		echo $linkText;
	}
	
foreach($projects as $project){
		if(!empty($project['latest_image'])){
			echo "<div class = \"project_image\">\n";
			
			echo "<a href = \"/projects/view/".$project['Project']['id']."\" style=\"background-image:url(/". $project['latest_image']['url'] ."/". "thumb.project.".$project['latest_image']['filename'].")\">";
			echo "<h2>". $project['Project']['name'] . "</h2>\n";
			echo "</a>\n";
			echo "</div><!--/image-->\n";
		}
	}

?>
</div><!--container-->
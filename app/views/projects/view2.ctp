<div class = "container">
<?php 
	echo "<h2><a href='/'>Your Projects</a> / ".$pages[0]['Project']['name']." <a class = 'action' href = '/pages/add'>+</a></h2>";
	foreach($pages as $page){
		
		
		if(!empty($page['Image'])){
			echo "<div class = \"project_image\">\n";
			
				echo "<a href = \"/pages/share/replace/".base64_encode($page['Page']['id'])."\" style=\"background-image:url(/". $page['latest_image']['url'] ."/". "thumb.project.".$page['latest_image']['filename'].")\">";
				echo "<h2>". $page['Page']['name'] . "</h2>";
				echo "</a>\n";
			echo "</div><!--/image-->\n";
		}
	}
	
?>

</div><!--container-->




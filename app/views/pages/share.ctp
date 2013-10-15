<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=307714979258478";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=307714979258478";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<link rel="stylesheet" href="http://designbox.es/css/colorbox.css" />
<script src="http://designbox.es/js/jquery.colorbox-min.js"></script>


<?php 
//print_r($page);
//print_r($images);
echo "<div class = \"container\">";
$count = 0;
	foreach($images as $image){
		if ($count == 0){
			echo "<h2 id = 'shareHeader'>";
			if($breadcrumbs == 1){
			echo "<a href='/'>Your Projects</a> <span class = 'unemphasised'>/</span> <a href = 'http://designbox.es/projects/view/".$page[0]["Project"]["id"]."'>".$page[0]["Project"]["name"]. "</a> <span class = 'unemphasised'>/</span> ";
			}	
			echo $image['Page']['name']." <span class = 'unemphasised'>(revision 1 of ".count($images).")</span></h2>";
			
			
			
			
			//echo "<a onclick='changeColour()' id='colourChanger' href = ''>See on White</a></p>";
			
			
			

			
			//echo '<div id="mainImage">';
				echo "<div id = \"newAvailable\"></div>";
				//echo "<h2>". $image['Image']['filename'] . "</h2>";
				
				echo "<a class='iframe' href = 'http://designbox.es/images/view/".$image['Image']['id']."'><img  id='mainImage' src = \"/". $image['Image']['url'] ."/". $image['Image']['filename']."\" /></a>";
			
				echo '<div id = "details">';
					//echo "<h2>".$image['Page']['name']."</h2>";
					echo "<dl>";
					//echo "<h2>".$image['Page']['name']."</h2>";
					echo "<dt>Project:</dt> <dd>". $page[0]['Project']['name']. "</dd>";
					echo "<dt>Uploaded by:</dt> <dd>".$user[0]['User']['name']. "</dd>";
					echo "<dt>Uploaded:</dt> <dd>".$date. "</dd>";
					echo "<dt>Filename:</dt> <dd><a target='_blank' href = '/".$image['Image']['url']."/".$image["Image"]["filename"]."'>".$image["Image"]["filename"]."</a></dd>";
										echo "</dl>";
			
					echo $shareSection;
				//echo "</div><!--details-->";
				
			//echo '</div>';
			
			//echo '<div id = "history">';
			echo $history;
			$count +=1;
		} else if($count<=5){
			echo "<div class = \"history_image\">\n";
			
			echo "<a href = \"/pages/share/replace/".base64_encode($image['Page']['id'])."/".$image['Image']['id']."\" style=\"background-image:url(/". $image['Image']['url'] ."/". "thumb.index.".$image['Image']['filename'].")\">";
			
			echo "<h2>". date("jS M. Y", strtotime($image['Image']['created'])) . "</h2></a>";
			
			echo "</div><!--/history_image-->";
			$count +=1;
		}
		
	}
	echo '</div><!--details-->';
	
	echo "<div id = 'fbCommentsContainer'>";
	
			echo "<div class=\"fb-comments\" data-href=\"http://designbox.es/images/view/".$image['Image']['id']."\" data-num-posts=\"5\" data-width=\"620\" data-colorscheme=\"dark\"></div>";
			  
			echo "</div><!--fbCommentsContainer-->";
	echo '</div><!--??-->';
	if(sizeOf($images) > 0) {
		
	}
	
	$queryURL = "/ajax/get_page_modified/".$page[0]['Page']['id']."/".strtotime($page[0]['Page']['updated']);
?>

<script>
	//$(".iframe").colorbox({iframe:true, width:"100%", height:"100%"});
</script>
	<pre>
	
</pre>




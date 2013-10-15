<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=307714979258478";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php 
$count = 0;
	foreach($images as $image){
		if ($count == 0){
			echo "<div class = \"container\">";
echo "Share link: <a href = \"\">http://designbox.es/pages/share/".$user['User']['username']."/".base64_encode($image['Page']['id'])."</a>";
echo "</div><!--container-->";
			echo '<div id="mainImage">';
			//echo "<h2>". $image['Image']['filename'] . "</h2>";
			echo "<img src = \"/". $image['Image']['url'] ."/". $image['Image']['filename']."\" />";
			echo '</div>';
			
			echo '<div class = "container">';
			
			echo '<div id = "details">';
			echo "<h2>".$image['Page']['name']."</h2>";
			echo $page[0]['Project']['name']. "<br />";
			echo $user['User']['name']. "<br />";
			echo $date. "<br />";
			
			echo "</div><!--details-->";
			
			echo "<div id = 'fbCommentsContainer'>";
			echo "<div class=\"fb-comments\" data-href=\"http://designbox.es/pages/view/".$image['Image']['page_id']."\" data-num-posts=\"5\" data-width=\"700\" data-colorscheme=\"dark\"></div>";
			
			echo "</div><!--fbCommentsContainer-->";
			
			echo "</div><!--container-->";
			echo '<div class="container" id = "history">';
			echo "<h2>History</h2>";
			$count +=1;
		} else {
			echo "<div class = \"history_image\">\n";
			
			echo "<a href = \"/images/view/".$image['Image']['id']."\" style=\"background-image:url(/". $image['Image']['url'] ."/". "thumb.index.".$image['Image']['filename'].")\">";
			
			echo "<h2>". date("jS M. Y", strtotime($image['Image']['created'])) . "</h2></a>";
			
			echo "</div><!--/history_image-->";
		}
	}
	if(sizeOf($images) > 0) {
		echo '</div><!--container-->';
	}
?>

<pre>
	
</pre>





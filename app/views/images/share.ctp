<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=307714979258478";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



<?php
;

echo "<div class = \"container\">";
echo "Share link: <a href = \"\">http://designbox.es/pages/share/".base64_encode($img[0]['Image']['id'])."</a>";
echo "</div><!--container-->";
echo '<div id="mainImage">';

echo "<img src = \"/". $img[0]['Image']['url'] ."/". $img[0]['Image']['filename']."\" />";
echo '</div>';

echo '<div class = "container">';

echo '<div id = "details">';
echo "<h2>".$img[0]['Page']['name']."</h2>";
//echo $page['Project']['name']. "<br />";
//echo $user['User']['name']. "<br />";
//echo $date. "<br />";

echo "</div><!--details-->";

echo "<div id = 'fbCommentsContainer'>";
echo "<div class=\"fb-comments\" data-href=\"designbox.es/pages/view/".$img[0]['Image']['id']."\" data-num-posts=\"5\" data-width=\"700\" data-colorscheme=\"dark\"></div>";

echo "</div><!--fbCommentsContainer-->";

echo "</div><!--container-->";
?>
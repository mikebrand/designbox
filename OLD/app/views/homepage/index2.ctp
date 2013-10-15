<style type='text/css'>
	div.pagination {
		text-align:center;
	}
	div.pagination a.prev {
		float:left;
	}
	div.pagination a.next {
		float:right;
	}
	div.pagination a.current {
		color:#fff;
	}
</style>
<div class = "container">
<?php 


	
	echo "<div id = \"yourContent\">";
	echo "<h2>Your Projects <a class = 'action' href = '/projects/add'>+</a></h2>";
	foreach($projects as $project){
		if(!empty($project['latest_image'])){
			echo "<div class = \"index_image\">\n";
			
			echo "<a class='projectBG' href = \"/projects/view/".$project['Project']['id']."\" style=\"background-image:url(". $project['latest_image']['url'] ."/". "thumb.index.".$project['latest_image']['filename'].")\">";
			
			echo "</a>\n";
			echo "<h2>". $project['Project']['name'] . "</h2>\n";
			echo "</div><!--/image-->\n";
		}
	}
	$folmaxpage = $myprojectcount / $itemsperpage;
	echo '<div class="pagination">';
	echo '<a class="prev" href="#">Previous Page</a>';
	for($i=1; $i<=$folmaxpage; $i++) {
		if($currentpage != $i) {
			echo '<a href="#">'.$i.'</a> ';
		} else {
			echo '<a class="current">'.$i.'</a> ';
		}
	}
	echo '<a class="next" href="#">Next Page</a>';
	echo '</div>';
	echo "</div><!--yourContent-->";
	
	echo "<div id = \"followingContent\">";
	echo "<h2>Projects you Follow</h2>";
	foreach($following_projects as $project){
		if(!empty($project['latest_image'])){
			echo "<div class = \"index_image\">\n";
			
				echo "<a class='projectBG' href = \"/projects/view/".$project['Project']['id']."\" style=\"background-image:url(". $project['latest_image']['url'] ."/". "thumb.index.".$project['latest_image']['filename'].")\">";
				echo "</a>\n";
				
				echo "<h2><a class = 'projectLink' href = \"/projects/view/".$project['Project']['id']."\">". $project['Project']['name'] . "</a> by <a href = 'users/view/".$project['User']['username']."'>".$project['User']['name']."</a></h2>\n";
			echo "</div><!--/image-->\n";
						
			
		}
	}
	$folmaxpage = $followingprojectcount / $itemsperpage;
	echo '<div class="pagination">';
	echo '<a class="prev" href="#">Previous Page</a>';
	for($i=1; $i<=$folmaxpage; $i++) {
		if($currentpage != $i) {
			echo '<a href="#">'.$i.'</a> ';
		} else {
			echo '<a class="current">'.$i.'</a> ';
		}
	}
	echo '<a class="next" href="#">Next Page</a>';
	echo '</div>';
	echo "</div><!-followingContent-->";
?>
<div class = "clear">&nbsp</div>
</div><!--container-->

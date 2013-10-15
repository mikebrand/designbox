<style type='text/css'>
	div#wrap {
		width:960px;
		margin:0 auto;
		float:none;
	}
	div#main_image {
		width:640px;
		float:left;
		clear:none;
	}
	div#history {
		width:310px;
		float:right;
		clear:none;
		overflow-x:hidden;
	}
	div#history h2 {
		margin-left:10px;

	}
	div.history_image {
		margin-bottom:10px;
	}
	h1 {
		font-size:300%;
		margin-bottom:30px;
		padding-top:30px;
		color:#ccc;
	}
	h1 a:visited {
		color:#eee;
	}
	dl {
		margin-left:10px;
		margin-bottom:10px;
	}
	dl dt {
		color:#666;
		float:left;
		width:120px;
		margin-right:10px;
		clear:left;
		margin-bottom:5px;
	}
	dl dd {
		color:#AAA;
		float:left;
		margin-bottom:5px;
	}
	dd.share_link {
		width:160px;
		background:#999;
		font-size:70%;
		padding:2px 5px;
		overflow-x:hidden;
		color:#333;
		margin-top:-1px;
	}
	dd.share_link a {
		color:#333;
	}
	div#comments {
		clear:both;
		padding-top:30px;
		width:640px;
	}
	img.avatar {
		float:left;
		width:64px;
		height:64px;
		margin-right:10px;
		margin-bottom:5px;
	}
	p.commentinfo {
		font-weight:bold;
		margin-bottom:5px;
		margin-top:-5px;
	}
	p em {
		font-style:italic;
	}
	div.comment {
		margin-bottom:30px;
	}
	div#main_image img {
		background:#fff;
	}
</style>
<?php
	$currentimage = $images[0];
?>

<div id='wrap'>
	<h1><a href='/projects/view/<?php echo $page[0]['Project']['id']; ?>'><?php echo $page[0]['Project']['name'].'</a> :: '.$currentimage['Page']['name']; ?> (<?php echo sizeOf($images); ?> iterations)</h1>
	<div id='main_image'>
		<h2>Iteration: 1 - <?php echo $currentimage['Image']['created']; ?></h2>
		<img width='640' src='/<?php echo $currentimage['Image']['url'].'/'.$currentimage['Image']['filename']; ?>' />
	</div>
	<div id='history'>
		<h2>Details</h2>
		<dl>
			<dt>Project:</dt><dd><a href='/projects/view/<?php echo $page[0]['Project']['id']; ?>'><?php echo $page[0]['Project']['name']; ?></a></dd>
			<dt>Name:</dt><dd><?php echo $currentimage['Page']['name']; ?></dd>
			<dt>Filename:</dt><dd><?php echo $currentimage['Image']['filename']; ?></dd>
			<dt>Updated:</dt><dd><?php echo $currentimage['Image']['updated']; ?></dd>
			<dt>User:</dt></dt><dd><?php echo $user[0]['User']['name']; ?></dd>
			<dt>Public Link:</dt><dd class="share_link">http://designbox.es/pages/share/<?php echo $user[0]['User']['username']['username'];?>/<?php echo base64_encode($currentimage['Page']['id']); ?></dd>
		</dl>
		<div style='clear:both; padding-top:20px;'></div>
		<h2>History</h2>
	<?php
		$count = 1;
		foreach($images as $image){
			echo "<div class = \"history_image\">\n";
				echo "<a href = \"/images/view/".$image['Image']['id']."\" style=\"background-image:url(/". $image['Image']['url'] ."/". "thumb.index.".$image['Image']['filename'].")\">";
				echo "<h2>". date("jS M. Y", strtotime($image['Image']['created'])) . "</h2></a>";
			echo "</div><!--/history_image-->";
			$count++;
		}
	?>
	</div>
	<div id='comments'>
		<h2>Comments</h2>
		<div class='comment'>
			<img class='avatar' src='' />
			<p class='commentinfo'>Andrew posted on <em>2010-12-12</em> via Email</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sapien lacus, aliquam id placerat non, accumsan sed lectus. Nulla vitae purus dui, et aliquam lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Nulla sodales ultrices porta. Cras vitae ante quis nisl dapibus varius quis non risus. Nam sed eros et felis hendrerit pharetra. Nullam sodales euismod pulvinar. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In est nisl, ultricies a bibendum nec, eleifend sit amet nulla. Curabitur eget pretium est. Fusce ac ligula nec justo venenatis suscipit in nec nibh.</p>
		</div>
		<div class='comment'>
			<img class='avatar' src='' />
			<p class='commentinfo'>Andrew posted on <em>2010-12-12</em> via Email</p>
			<p>Aenean bibendum laoreet ipsum vitae semper. Mauris gravida laoreet venenatis. Integer in dolor arcu. Sed vitae vestibulum lectus. Aenean malesuada velit sed massa rhoncus vehicula. Proin a mauris massa, ac fringilla dolor. Nam vel interdum diam. Sed eget consequat justo. Suspendisse adipiscing, metus a imperdiet tristique, est velit volutpat risus, sit amet imperdiet arcu risus eu erat. Morbi placerat sem at urna pretium consectetur. In dignissim, nibh eu dictum semper, justo magna faucibus orci, vitae blandit orci sem semper leo. Maecenas quis quam odio, nec interdum ligula. Donec convallis malesuada eleifend. Praesent eget lacinia massa.</p>
		</div>
		<div class='comment'>
			<img class='avatar' src='' />
			<p class='commentinfo'>Andrew posted on <em>2010-12-12</em> via Email</p>
			<p>Proin in lectus enim. Praesent eget nunc nibh, ut porttitor urna. Phasellus pretium, nunc sed fringilla fermentum, risus felis mattis erat, ut dictum mi odio vitae tellus. Fusce bibendum luctus est, at bibendum nulla laoreet quis. Pellentesque eu nisi ac velit semper rutrum. In porta consectetur arcu a fermentum. Aenean blandit massa vel leo malesuada mattis. Morbi eget lorem rutrum felis varius interdum. Etiam lacus dolor, imperdiet sed scelerisque ac, euismod et mi. Proin sapien ligula, congue sit amet fringilla non, tempor ut est. Nunc consequat sagittis orci. Quisque interdum, nibh vitae vulputate faucibus, tortor nisi malesuada diam, at interdum erat ante sit amet lorem. Quisque auctor dolor sit amet dui dictum scelerisque. Sed at orci eget quam faucibus mollis. Quisque varius, quam sed rutrum varius, velit mauris faucibus lacus, elementum faucibus risus magna eget augue. Morbi eu tortor nisl, a dictum leo.</p>
		</div>
		<div class='comment'>
			<img class='avatar' src='' />
			<p class='commentinfo'>Andrew posted on <em>2010-12-12</em> via Email</p>
			<p>Suspendisse mollis, massa id faucibus aliquet, nisl justo tincidunt dui, nec tincidunt eros tellus lacinia justo. Vestibulum sagittis risus eu tellus lacinia in iaculis velit faucibus. Donec ac nibh non nisl aliquet adipiscing vitae sit amet massa. Phasellus libero diam, fermentum a elementum sit amet, ultrices non massa. Suspendisse potenti. Ut eu tortor non nisi aliquam laoreet vitae eget leo. Phasellus risus magna, scelerisque vitae pretium pulvinar, malesuada vitae mi. Morbi suscipit massa vitae sem ultrices volutpat. Nulla facilisi. Curabitur nunc ipsum, sagittis eu malesuada id, pharetra sed lorem. Phasellus sit amet enim tellus.</p>
		</div>
		<div class='comment'>
			<img class='avatar' src='' />
			<p class='commentinfo'>Andrew posted on <em>2010-12-12</em> via Email</p>
			<p>Curabitur dapibus, quam feugiat posuere lacinia, risus urna facilisis mauris, sit amet rhoncus ante urna quis nisi. Aliquam non lorem dui, id sagittis nisl. Nunc est dolor, bibendum non mollis nec, aliquet vitae nulla. Nulla facilisi. Nam ut nulla eget turpis consectetur suscipit. Nam varius facilisis iaculis. Duis ornare, metus ut varius blandit, magna justo vulputate leo, id aliquet lectus purus in magna. Cras quis pharetra tellus. Vivamus eget felis sit amet dui placerat ullamcorper sit amet non justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer nec nulla et neque pharetra laoreet. Proin vitae mauris id enim condimentum venenatis.</p>
		</div>
	</div>
</div>
<div style='clear:both;'>fdsa</div>
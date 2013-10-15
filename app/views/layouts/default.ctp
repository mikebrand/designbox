
<html>
	<head>
		<title>Projects: Design Box</title>
		<link type="text/css" href="/css/index.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
		 <script type="text/javascript">
			$(document).ready(function() {
	  			$('.gallery').toggle();
	  			
	  			$('.quickViewButton').click(function() {
	  				$('.gallery').slideToggle('fast');
	  			});
	  			
	  			
	  			
	  				
			});
			function newProject(){
				$('#newProjButton').html('<button onclick="oldProject()">Existing</button>');
				$('.project').html('<label for="ImagePageId">Project</label><input onkeyup = "allowProject()" type="text" name="newPage" /><div class ="uploadButton"  id = "newProjButton"><button onclick="oldProject()">Existing</button></div>');	
				newProjectPage();	
			}
			
			function newProjectPage(){
				$('#newPageButton').html('<input onkeyup = "allowSubmit()" type="text" name="newPage" />');
				
				$('.page').html('<label for="ImagePageId">Page</label><input id = "selectPage" disabled onkeyup = "allowSubmit()" type="text" name="newPage" />');
				$('#uploadTab input[type="submit"]').attr("disabled", true);
				$('#uploadTab input[type="file"]').attr("disabled", true);
			}
			
			function oldProject(){
				$('#newProjButton').html('<button onclick="newProject()">Create New</button>');
				$('.project').html('<label for="ImagePageId">Project</label><select  onChange="allowProject()" name="data[Image][page_id]" id="ImagePageId"><option value="47">Concept</option><option value="46">All Together</option><option value="54">Mac App</option><option value="55">Mac App</option></select><div class ="uploadButton"  id = "newProjButton"><button onclick="newProject()">Create New</button></div>');
				oldProjectPage();
			}
			
			function oldProjectPage(){
				$('#newPageButton').html('<button onclick="newPage()">Create New</button>');
				$('.page').html('<label for="ImagePageId">Page</label><select onChange="oldPage()" id = "selectPage" disabled name="data[Image][page_id]" id="ImagePageId"><option value="47">Concept</option><option value="46">All Together</option><option value="54">Mac App</option></select><div class ="uploadButton"  id = "newPageButton"><button disabled onclick="newPage()">Create New</button></div');
			}
			
			
			function allowProject(){
				//test for dropdown selection
				
				//alert("squeek");
				if($(".project input[type='text']").length>0){
					//alert("meow");
					if($(".project input[type='text']").val().length< 1)
					{
						//alert("meow");
						$('#selectPage').attr("disabled", true);
					}else {	
						//alert("ruff");			
						$('#selectPage').removeAttr("disabled");
						$('#newPageButton button').removeAttr("disabled");
					}
				} else {	
					//alert("ruff");			
					$('#selectPage').removeAttr("disabled");
					$('#newPageButton button').removeAttr("disabled");
				}
			}
			
			function allowPages(){
			if($(".project input[type='text']").val().length< 1)
				{
					//alert("meow");
					$('#selectPage').attr("disabled", true);
				}else {	
					//alert("ruff");			
					$('#selectPage').removeAttr("disabled");
					
				}
			}
			
			function oldPage(){
				$('#newPageButton').html('<button onclick="newPage()">Create New</button>');
				$('.page').html('<label for="ImagePageId">Page</label><select onChange="allowSubmit()" id = "selectPage" name="data[Image][page_id]" id="ImagePageId"><option value="47">Concept</option><option value="46">All Together</option><option value="54">Mac App</option></select><div class ="uploadButton"  id = "newPageButton"><button onclick="newPage()">Create New</button></div');
			}
			
			function newPage(){
				$('#newPageButton').html('<input onkeyup = "allowSubmit()" type="text" name="newPage" />');
				
				$('.page').html('<label for="ImagePageId">Page</label><input onkeyup = "allowSubmit()" type="text" name="newPage" /><div class ="uploadButton"  id = "newProjButton"><button onclick="oldPage()">Existing</button></div>');
				
			}
			
			
			
			function allowSubmit(){
				//test for dropdown selection
				
				//alert("squeek");
				if($(".page input[type='text']").length>0){
					//alert("meow");
					if($(".project input[type='text']").val().length< 1)
					{
						//alert("meow");
						$('#uploadTab input[type="submit"]').attr("disabled", true);
					} else {	
					
						$('#uploadTab input[type="submit"]').removeAttr("disabled");
						$('#uploadTab input[type="file"]').removeAttr("disabled");
					}
				} else {	
					//alert("ruff");			
					$('#uploadTab input[type="submit"]').removeAttr("disabled");
					$('#uploadTab input[type="file"]').removeAttr("disabled");
				}
			}
			
			
			
			
			
		</script>
	</head>
	
	<body>
		<?php
		if(!isset($removeheader) || ($removeheader == false)) { 
			echo "<nav>";
			echo "<ul>";
				echo '<li><a id = "homeLink" href = "/"></a></li>';
				
				
					if($userdetails) {
						echo '<li><a href = "/users/logout">Log Out</a></li>';
						echo '<li style="width:110px; overflow-x:hidden;"><a href = "/users/view/'.$userdetails['User']['username'].'">'.$userdetails['User']['name'].'</a></li>';
						echo '<li><a id = "upload" href = "/images/add">Upload</a></li>';
					} else {
						echo '<li id = "about">Design Box is a project by <a href = "http://www.mikebrand.co">Mike Brand</a> and <A href = "http://www.ablydesign.com.au">Andrew Dekker</a>.</li>';
					}
				
				
				
			echo "</ul>";
		echo "</nav>";
		}
		?>
		<!--<div id = "uploadTab">
			<form action="" id="ImageAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<div style="display:none;">
					<input type="hidden" name="_method" value="POST" />
				</div>
				<fieldset>
					<div class="project input select">
						
						<label for="ImagePageId">Project</label>
						
						<select onChange="allowProject()" name="data[Image][page_id]" id="ImagePageId">
							<option value="47">Concept</option>
							<option value="46">All Together</option>
							<option value="54">Mac App</option>
						</select>
						
						<div class ="uploadButton"  id = "newProjButton">
							<button onclick="newProject()">Create New</button>
						</div><!--/newProjButton/
					</div>
					
					<div class="page input select">
						<label for="ImagePageId">Page</label>
						<select onChange="allowSubmit()" id = "selectPage" disabled name="data[Image][page_id]" id="ImagePageId">
							<option value="47">Concept</option>
							<option value="46">All Together</option>
							<option value="54">Mac App</option>
						</select>
						<div class ="uploadButton"  id = "newPageButton">
							<button disabled onclick="newPage()">Create New</button>
						</div><!--/newProjButton--
					</div>
					
					<div class="input file">
						<label for="ImageFilename">Choose a file</label>
						<input disabled type="file" name="data[Image][filename]" id="ImageFilename" />
					</div>
					
				</fieldset>
				<div class="submit">
					<input disabled type="submit" value="Submit" />
				</div>
			</form>
		</div><!--/upload tab-->
<?php
	echo $this->Session->flash();
	echo $content_for_layout; 
?>
<div class = "clear">&nbsp</div>
	<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
	</body>
</html>

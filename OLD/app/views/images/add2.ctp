<style type='text/css'>
	div#uploadarea label {
		font-size:110%;
		text-align:left;
		display:block;
		margin-bottom:2px;
	}
	div#uploadarea fieldset {
		text-align:left;
	}
	div#uploadarea div.element {
		margin-bottom:10px;
	}
	div#uploadarea div.element select {
		width:300px;
	}
</style>
<div id="uploadarea" class="images form container small">
<?php echo $this->Form->create('Image', array('type' => 'file'));?>
	
			<form action="" id="ImageAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<div style="display:none;">
					<input type="hidden" name="_method" value="POST" />
				</div>
				<fieldset>
					<div class="project input select">
						
						<label for="ImagePageId">Project</label>
						
						<select onChange="allowProject()" name="data[Image][page_id]" id="ImagePageId">
							<?php 
							
							
							 ?>
							<option value="47">Concept</option>
							<option value="46">All Together</option>
							<option value="54">Mac App</option>
						</select>
						
						<div class ="uploadButton"  id = "newProjButton">
							<button onclick="newProject()">Create New</button>
						</div><!--/newProjButton//-->
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
						</div><!--/newProjButton-->
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
	
	<!--<fieldset>
		<div id = "imgContainer"><img src = "/img/uploadfiles.png"></div>
		<label>1. Choose Project</label>
		<div class='element'>
			<select></select>
			<input type='button' value='Create New' />
		</div>
		<label>2. Choose Page</label>
		<div class='element'>
			<select></select>
			<input type='button' value='Create New' />
		</div>
		<label>3. Choose Files</label>
		<input type='file' name='files' multiple='multiple' />
	</fieldset>
	<div class="span5">
        <!-- The global progress bar 
        		<div class="progress progress-success progress-striped active fade">
			<div class="bar" style="width:0%;"></div>
		</div>
	</div>-->
<?php //echo $this->Form->end(__('Upload', true));?>

<script>function newProject(){
				$('#newProjButton').html('<button onclick="oldProject()">Existing</button>');
				$('.project').html('<label for="ImagePageId">Project</label><input onkeyup = "allowProject()" type="text" name="newPage" /><div class ="uploadButton"  id = "newProjButton"><button onclick="oldProject()">Existing</button></div>');	
				newProjectPage();	
			}
			
			function newProjectPage(){
				$('#newPageButton').html('<input onkeyup = "allowSubmit()" type="text" name="newPage" />');
				
				$('.page').html('<label for="ImagePageId">Page</label><input id = "selectPage" disabled onkeyup = "allowSubmit()" type="text" name="newPage" />');
				$('#uploadarea input[type="submit"]').attr("disabled", true);
				$('#uploadarea input[type="file"]').attr("disabled", true);
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
				
				alert("squeek");
				if($(".page input[type='text']").length>0){
					//alert("meow");
					if($(".page input[type='text']").val().length< 1)
					{
						//alert("meow2");
						$('#uploadarea input[type="submit"]').attr("disabled", true);
					} else {	
					
						$('#uploadarea input[type="submit"]').removeAttr("disabled");
						$('#uploadarea input[type="file"]').removeAttr("disabled");
					}
				} else {	
					//alert("ruff");			
					$('#uploadarea input[type="submit"]').removeAttr("disabled");
					$('#uploadarea input[type="file"]').removeAttr("disabled");
				}
			}
</script>
</div>

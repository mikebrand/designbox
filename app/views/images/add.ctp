<style type='text/css'>
	div#uploadarea label {
		font-size:110%;
		text-align:left;
		display:block;
		margin-bottom:5px;
		margin-top:28px;
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
	div#uploadarea select {
		float:left;
	}
	a.uploadformbutton {
		display:block;
		background: #dad8d8 url(/img/select_bg.png) repeat-x;
		border: solid 1px #000000;
		font-size: 15px;
		font-weight: normal;
		height: 30px;
		position: relative;
		width:140px;
		border-radius:4px;
		-moz-border-radius:4px;
		-webkit-border-radius:4px;
		text-align:center;
		color:#3a3a3a;
		line-height:32px;
		float:right;
		margin-right:30px;
	}
	a.uploadformbutton:hover {
		text-decoration:none;
		color:#000;
	}
	a.uploadformbuttondisabled {
		background: #767773 url(/img/select_bg_disabled.png) repeat-x;
	}
	a.uploadformbuttondisabled:hover {
		color:#333;
	}
	div.filebuttonholder {
		background: url(/img/selectfile.png) no-repeat;		
	}
	input#filebutton {
		height:30px;
		opacity:0;
		width:500px;
	}
	ul#fileslist {
		margin:15px 0;
	}
	ul#fileslist li {
		border-top:1px solid #707070;
		border-bottom:1px solid #707070;
		background-color:#2e2e2e;
		padding:5px;
		margin-top:-1px;
		font-size:14px;
		width:444px;
		list-style-type:none;
	}
	ul#fileslist li img {
		width:36px;
		height:36px;
		float:left;
		margin-right:5px;
	}
	a.MultiFile-remove {
		float:right;
	}
</style>
<div id="uploadarea" class="images form container small">
<?php echo $this->Form->create('Image', array('type' => 'file'));?>
	<fieldset>
		<div id = "imgContainer"><img src = "/img/uploadfiles.png"></div>
		<label>1. Choose Project</label>
		<div class='element'>
			<a class='uploadformbutton' href='javascript:newProject();'>New Project</a>
			<select id="projects" name="data[project]" required="required">
				<option value="choose">-- Choose a project --</option>
				<?php
				foreach($projects as $projectid=>$project) {
					echo '<option value="project_'.$projectid.'">'.$project.'</option>';
				}
				?>
			</select>
		</div>
		<label>2. Choose Page</label>
		<div class='element'>
			<a class='uploadformbutton uploadformbuttondisabled' id='newpagebutton' href='javascript:newPage();'>New Page</a>
			<select id="pages" name="data[page]" required="required">
				<option value="choose">-- Choose a project --</option>
			</select>
		</div>
		<label>3. Choose Files</label>
		<div class='filebuttonholder'>
			<input id='filebutton' multiple='multiple' type='file' name='files[]' accept='image/*' required="required" />
			<ul id='fileslist'>
			
			</ul>
		</div>
	</fieldset>
<?php echo $this->Form->end(__('Upload', true));?>
</div>
<script type='text/javascript' src='/js/jquery.selectbox-0.1.3.min.js'></script>
<script type="text/javascript">

function fileschanged(evt) {
	var files = evt.target.files;
	var output = "";
    for (var i = 0, f; f = files[i]; i++) {
    	if (!f.type.match('image.*')) {
        	continue;
		}
		if(typeof FileReader !== "undefined") {
			output += '<li>'+f.name+' ('+f.type+')</li>';
			var reader = new FileReader();
			reader.onload = (function(theFile,i) {
				return function(e) {
					var preview = $('<img width="20" height="20" class="thumb" src="'+e.target.result+'" title="'+escape(theFile.name)+'"/>');
					$('#fileslist li').eq(i).prepend(preview);
					var size = $('<br /><em>'+Math.round(theFile.size/1000)+' kb</em>');
					$('#fileslist li').eq(i).append(size);
					/*$('#fileslist :last-child img').load(function(e){
						console.log(e.target.width);
					});*/
        		};
			})(f,i);
			reader.readAsDataURL(f);
		} else {
			output += '<li>'+f.name+' ('+f.type+')</li>';
		}
    }
    $('#fileslist').html(output);
}
document.getElementById('filebutton').addEventListener('change', fileschanged, false);

var pagelist = <?php echo json_encode($pagelist); ?>;
function newProject() {
	var existing = $("#projects").html();
	var newProject = prompt("Enter the project title","");
	if (newProject!=null && newProject!="") {
		$("#projects").html(existing+"<option value='"+newProject+"'>"+newProject+"</option>");
		$("#projects").selectbox("detach");
		$("#projects").val(newProject);
		$("#projects").selectbox("attach");
		setupSelectBox();
		$("#newpagebutton").removeClass("uploadformbuttondisabled");
		newPage();
  	}
}
function newPage() {
	if(!$("#newpagebutton").hasClass("uploadformbuttondisabled")) {
		var existing = $("#pages").html();
		var newPage = prompt("Enter the page title","");
		if (newPage!=null && newPage!="") {
			$("#pages").html(existing+"<option value='"+newPage+"'>"+newPage+"</option>");
			$("#pages").val(newPage);
			$("#pages").selectbox("detach");
			$("#pages").selectbox("attach");
	  	}
  		$("#pages").selectbox("option","new");
  	}
}
function getPageSelectBoxList(val) {
	var newpagelist = "<option value='choose'>-- Choose a project --</option>";
	var itemslength = 0;
	if(pagelist[val]) {
		var itemslength = getObjectCount(pagelist[val]);
	}
	if(itemslength > 0) {
		newpagelist = "<option value='choose'>-- Choose a page --</option>";
	}
	for(var page in pagelist[val]) {
		newpagelist += "<option value='"+page+"'>"+pagelist[val][page]+"</option>";
	}
	return newpagelist;
}
function getObjectCount(myobj) {
	var count = 0;
	for (k in myobj) if (myobj.hasOwnProperty(k)) count++;
	return count;
}
$(function () {
    setupSelectBox();
    $("#pages").selectbox();
    $("#pages").selectbox("disable");
});

function setupSelectBox() {
	$("#projects").selectbox({
    	onChange: function (val, inst) {
			$("#pages").html(getPageSelectBoxList(val));
			var itemslength = 0;
			if(pagelist[val]) {
				var itemslength = getObjectCount(pagelist[val]);
			}
			$("#pages").selectbox("detach");
			$("#pages").selectbox("attach");
			if(itemslength > 0) {
				$("#pages").selectbox("enable");
				$("#newpagebutton").removeClass("uploadformbuttondisabled");
			} else {
				$("#pages").selectbox("disable");
				$("#newpagebutton").addClass("uploadformbuttondisabled");
			}
		}
    });
}

</script>
<style type='text/css'>
.sbHolder{
	background: #dad8d8 url(/img/select_bg.png) repeat-x;
	border: solid 1px #000000;
	font-size: 15px;
	font-weight: normal;
	height: 30px;
	position: relative;
	width: 300px;
	border-radius:4px;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
}
.sbSelector{
	display: block;
	height: 30px;
	left: 0;
	line-height: 32px;
	outline: none;
	overflow: hidden;
	position: absolute;
	text-indent: 8px;
	top: 0;
	width: 170px;
}
.sbSelector:link, .sbSelector:visited, .sbSelector:hover{
	color: #3a3a3a;
	outline: none;
	text-decoration: none;
}
.sbToggle{
	background: url(/img/select-icons.png) 0 -116px no-repeat;
	display: block;
	height: 30px;
	outline: none;
	position: absolute;
	right: 0;
	top: 0;
	width: 30px;
}
.sbToggle:hover{
	background: url(/img/select-icons.png) 0 -167px no-repeat;
}
.sbToggleOpen{
	background: url(/img/select-icons.png) 0 -16px no-repeat;
}
.sbToggleOpen:hover{
	background: url(/img/select-icons.png) 0 -66px no-repeat;
}
.sbHolderDisabled{
	background: #767773 url(/img/select_bg_disabled.png) repeat-x;
	border: solid 1px #000000;
}
.sbHolderDisabled .sbHolder{
	
}
.sbHolderDisabled .sbToggle{
	
}
.sbOptions{
	background-color: #212121;
	border: solid 1px #515151;
	list-style: none;
	left: -1px;
	margin: 0;
	padding: 0;
	position: absolute;
	top: 24px;
	width: 300px;
	z-index: 1;
	overflow-y: auto;
	border-radius:4px;
	-moz-border-radius:4px;
	-webkit-border-radius:4px;
}
.sbOptions li{
	padding: 0 7px;
}
.sbOptions a{
	border-bottom: dotted 1px #515151;
	display: block;
	outline: none;
	padding: 7px 0 7px 3px;
}
.sbOptions a:link, .sbOptions a:visited{
	color: #ddd;
	text-decoration: none;
}
.sbOptions a:hover{
	color: #FFF;
	text-decoration:underline;
}
.sbOptions li.last a{
	border-bottom: none;
}
.sbOptions .sbDisabled{
	border-bottom: dotted 1px #515151;
	color: #999;
	display: block;
	padding: 7px 0 7px 3px;
}
.sbOptions .sbGroup{
	border-bottom: dotted 1px #515151;
	color: #EBB52D;
	display: block;
	font-weight: bold;
	padding: 7px 0 7px 3px;
}
.sbOptions .sbSub{
	padding-left: 17px;
}
</style>
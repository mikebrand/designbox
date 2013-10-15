<style type='text/css'>
	div.pagination {
		text-align:center;
		margin-bottom:5px;
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
	<div id = "yourContent">
		<h2>Your Projects <a class = 'action' href = '/projects/add'>+</a></h2>
		<ul></ul>
		<div class='pagination'></div>
	</div><!--yourContent-->
	<div id = "followingContent">
		<h2>Projects you Follow</h2>
		<ul></ul>
		<div class='pagination'></div>
	</div><!-followingContent-->
<div class = "clear">&nbsp</div>
</div><!--container-->
<script type='text/javascript'>
	var data_yourprojects = <?php echo $projects; ?>;
	var data_followprojects = <?php echo $following_projects; ?>;
	var numberperpage = 5;
	var yourpagenumber = 1;
	var followpagenumber = 1;
	
	$(document).ready(function() {
		refreshPagination();
	});
	
	function refreshPagination() {
		var your_page = "";
		var your_total_pages = Math.ceil(data_yourprojects.length/numberperpage);
		if(yourpagenumber > 1) { your_page = "<a href='javascript:your_prev_page();' class='prev'>Previous</a>"; }
		your_page += "Page "+yourpagenumber+" of "+your_total_pages;
		if(yourpagenumber < your_total_pages) { your_page += "<a href='javascript:your_next_page();' class='next'>Next</a>"; }
		$("#yourContent div.pagination").html(your_page);
		
		var follow_page = "";
		var follow_total_pages = Math.ceil(data_followprojects.length/numberperpage);
		if(followpagenumber > 1) { follow_page = "<a href='javascript:follow_prev_page();' class='prev'>Previous</a>"; }
		follow_page += "Page "+followpagenumber+" of "+follow_total_pages;
		if(followpagenumber < follow_total_pages) { follow_page += "<a href='javascript:follow_next_page();' class='next'>Next</a>"; }
		$("#followingContent div.pagination").html(follow_page);
		
		
		refreshProjects();
	}
	
	function your_next_page() {
		yourpagenumber = yourpagenumber+1;
		refreshPagination();
	}
	
	function your_prev_page() {
		yourpagenumber = yourpagenumber-1;
		refreshPagination();
	}
	
	function follow_next_page() {
		followpagenumber = followpagenumber+1;
		refreshPagination();
	}
	
	function follow_prev_page() {
		followpagenumber = followpagenumber-1;
		refreshPagination();
	}
	
	function refreshProjects() {
		$("#yourContent ul").empty();
		$("#followingContent ul").empty();
		loadProjects();
	}
	
	function loadProjects() {
		console.log(data_followprojects.length);
		console.log(data_yourprojects.length);
		var your_startnumber = (yourpagenumber-1)*numberperpage;
		if(your_startnumber < 0) { your_startnumber = 0; }
		var follow_startnumber = (followpagenumber-1)*numberperpage;
		if(follow_startnumber < 0) { follow_startnumber = 0; }
		var your_endnumber = your_startnumber + numberperpage;
		if(your_endnumber > (data_yourprojects.length)) { your_endnumber = (data_yourprojects.length); }
		var follow_endnumber = follow_startnumber + numberperpage;
		if(follow_endnumber > (data_followprojects.length)) { follow_endnumber = (data_followprojects.length); }
		for(var i=your_startnumber; i<your_endnumber; i++) {
			var projectlistitem = "<li>"+formatProject(data_yourprojects[i],false)+"</li>";
			$("#yourContent ul").append($(projectlistitem));
		}
		for(var i=follow_startnumber; i<follow_endnumber; i++) {
			var projectlistitem = "<li>"+formatProject(data_followprojects[i],true)+"</li>";
			$("#followingContent ul").append($(projectlistitem));
		}
	}
	
	function formatProject(data,showby) {
		var imgurl = "/"+data.image_url+"/thumb.index."+data.image_filename;
		var name = data.project_name;
		if(showby) {
			name = data.project_name + " by <a href='/users/view/"+data.user+"'>" + data.user_name + '</a>';
		}
		var html = "<div class='index_image'><a class='projectBG' href='/projects/view/"+data.project_id+"' style='background-image:url(\""+imgurl+"\");'></a><h2>"+name+"</h2></div>";
		return html;
	}
	
</script>
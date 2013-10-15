<style type='text/css'>
	div.pagination {
		text-align:center;
		padding-top:10px;
		clear:both;
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
	<h2><a href='/'>Your Projects</a> <span class = 'unemphasised'>/</span> <?php echo $project_name; ?><a class = 'action' href = '/pages/add'>+</a></h2>
	<div id='pages'></div>
	<div class='pagination'></div>
</div>
<script type='text/javascript'>
	var pagedata = <?php echo $pagedata; ?>;
	var numberperpage = 24;
	var pagenumber = 1;
	
	$(document).ready(function() {
		refreshPagination();
	});
	
	function refreshPagination() {
		var page = "";
		var total_pages = Math.ceil(pagedata.length/numberperpage);
		if(pagenumber > 1) { page = "<a href='javascript:prev_page();' class='prev'>Previous</a>"; }
		page += "Page "+pagenumber+" of "+total_pages;
		if(pagenumber < total_pages) { page += "<a href='javascript:next_page();' class='next'>Next</a>"; }
		$(".container div.pagination").html(page);
		refreshPages();
	}
	
	function next_page() {
		pagenumber = pagenumber+1;
		refreshPagination();
	}
	
	function prev_page() {
		pagenumber = pagenumber-1;
		refreshPagination();
	}
	
	function refreshPages() {
		$("#pages").empty();
		loadPages();
	}
	
	function loadPages() {
		var startnumber = (pagenumber-1)*numberperpage;
		if(startnumber < 0) { startnumber = 0; }
		var endnumber = startnumber + numberperpage;
		if(endnumber > (pagedata.length)) { endnumber = (pagedata.length); }
		console.log(endnumber);
		for(var i=startnumber; i<endnumber; i++) {
			var pageitem = formatPage(pagedata[i]);
			$("#pages").append($(pageitem));
		}
	}
	
	function formatPage(data) {
		var imgurl = "/"+data.image_url+"/thumb.index."+data.image_filename;
		var url = "/pages/share/replace/"+data.page_id_64;
		var html = "<div class='project_image'><a href='"+url+"' style='background-image:url(\""+imgurl+"\");'><h2>"+data.page_name+"</h2></a></div>";
		return html;
	}
	
</script>
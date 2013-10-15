<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=307714979258478";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



function changeColour(){
				//alert($('#mainImage').css("backgroundColor"));
				event.preventDefault();
				if( $('body').css("backgroundColor") == "rgb(0, 0, 0)")
				{
					$("#colourChanger").text("See on Black");
					$('body').css({ backgroundColor: "white"});
				}
				else
				{
					$("#colourChanger").text("See on White");
					$('body').css({ backgroundColor: "black"});
				}
			}
			
function toggleGrid(){
				
				//alert($('body').css("background-image"));
				//event.preventDefault();
				if( $('body').css("background-image") == "url(http://designbox.es/img/grid.png)")
				{
					$("#toggleGrid").text("See Transparency Grid");
					$('body').css({"background-image": "none"})
				}
				else
				{
					$("#toggleGrid").text("Hide Trans parency Grid");
					$('body').css({"background-image": "url('/img/grid.png')"})
				}
			}
			
function toggleBrowserChrome(){
				//alert($('#zoomImage img').css("padding-top"));
				//event.preventDefault();
				
				
				$('#zoomImage img').toggleClass("browserChrome");
				
			}


</script>
<style type='text/css'>
body{
	background-color: rgb(0,0,0);
/* 	background-image: url('/img/grid.png'); */
}
</style>

<?php 

$count = 0;

echo "<div class = 'container clearfix'>";
echo	"<div id = 'zoomActions' class = 'clearfix'>";
	echo "<a onclick='changeColour()' id='colourChanger' href = '#'>See on White</a></p>";
	echo "<a onclick='toggleGrid()' id='toggleGrid' href = '#'>See Transparency Grid</a></p>";
	echo "<a onclick='toggleBrowserChrome()' id='ToggleBrowserChrome' href = '#'>See Browser Chrome</a></p>";
	echo '</div><!--/zoomActions-->';
echo '</div><!--/container-->';
	echo "<div id = 'zoomImage'>";
	echo '<div id="mainImage">';
		echo "<img src = \"/". $main_image['Image']['url'] ."/". $main_image['Image']['filename']."\" />";
	echo '</div><!--/mainImage-->';
	echo '</div><!--/zoomImage-->';



$count +=1;

?>
<script>$('#mainImage img').click(function() {
  				if( $('#mainImage img').css("max-width") == "940px")
  				{
  					$('#mainImage img').css({ maxWidth: "100%" }, 500);
  				}
  				else
  				{
  					$('#mainImage img').css({ maxWidth: "940px" }, 500);
  				}
	  		});
	  				
	  				
			
	  				
	  				
	  				//Comments
	  				$(".commentMenu").click(function(){
	  					
    					if( $('#fbCommentsContainer').css("left") == "0px")
    				{
    					$("#fbCommentsContainer").animate({ "left": "-500px" }, 100);
    				} else {
    					$("#fbCommentsContainer").animate({ "left": "0px" }, 100);	
    				} 
    				});
	  				
	  				
	  				//refresh check
	  				function checkPage(){
	  					$.getJSON('<?php echo $queryURL; ?>',function(response){
	  						if (response == "same"){
  								$("#newAvailable").text("");
  							} else {
  								$("#newAvailable").text("A newer version of this image has been uploaded. Refresh this page to view it");
  							}
	  					});
	  				}
	  				setInterval("checkPage()",5000);
	  				
	  				</script>


<pre>
	
</pre>





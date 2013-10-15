<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=307714979258478";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=307714979258478";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<?php 
//print_r($page);
//print_r($images);
echo "<div class = \"container\">";

			
				echo "<div id = \"newAvailable\"></div>";
				
				echo "<img  id='mainImage' src = \"/". $images['Image']['url'] ."/". $images['Image']['filename']."\" />";
			
				
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
	  				
	  				
			function changeColour(){
				//alert($('#mainImage').css("backgroundColor"));
				event.preventDefault();
				if( $('#mainImage').css("backgroundColor") == "rgb(0, 0, 0)")
				{
					$("#colourChanger").text("See on Black");
					$('#mainImage').css({ backgroundColor: "white"});
				}
				else
				{
					$("#colourChanger").text("See on White");
					$('#mainImage').css({ backgroundColor: "black"});
				}
			}
	  				
	  				
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




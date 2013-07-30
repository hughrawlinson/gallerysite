<?php

$dir = opendir("images");
$list = array();
$images = array();
while($file = readdir($dir)){
	if ($file != '.' and $file != '..'){
		$ctime = filectime($file) . ',' . $file;
		$list[$ctime] = $file;
	}
}

$list = array_reverse($list);

foreach($list as $im){
	$images[] = $im;
}

$imgarrstring = "'".$images[0]."'";
for($n = 1; $n < count($images); $n++){
	$imgarrstring = $imgarrstring . ",'" . $images[$n] . "'";
}

?>
<html>
<head>
	<title>The Places I Take My Laptop</title>
	<style>
		html{
		min-height:100%;
	}

	body{
		margin:0px;
		min-height:100%;
		background-color:#333333;
	}
	#image{
		width:100%;
	}
	#countdisplay{
		position: absolute;
		top: 5px;
		left:5px;
		margin:0px;
		color: white;
		font-family:"Helvetica Neue", Helvetica, Arial,sans-serif;
		font-size:17pt;
		font-weight:800;
		text-shadow: 2px 0 0 black, -2px 0 0 black, 0 2px 0 black, 0 -2px 0 black, 1px 1px black, -1px -1px 0 black, 1px -1px 0 black, -1px 1px 0 black;
	}
	</style>
</head>
<body>
<img id="image" alt="A place I\'ve taken my laptop" src="images/<?php echo $images[0];?>"></img>
<p id="countdisplay"></p>
</body>
<script>
var im = document.getElementById("image");
var p = document.getElementById("countdisplay");
window.onresize = function(event){
	var windowRatio = window.innerWidth/window.innerHeight;
	var imageRatio = im.offsetWidth/window.offsetheight;
	console.log(windowRatio,imageRatio);
	var margintop = (window.innerHeight - im.offsetHeight)/2;
	im.style.marginTop = margintop+"px";
};
var counter = 0;
var images = [<?php echo $imgarrstring;?>];
p.innerHTML = (counter+1)+" / "+ images.length;
im.onclick = function(){
	counter = (counter+1)%images.length;
	this.src = "images/"+images[counter];
	p.innerHTML = (counter+1)+" / "+ images.length;
	window.onresize();
}
window.onresize();
</script>
</html>
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
		opacity:0;
		transition: width 0.5s;
		-webkit-transition: width 0.5s; /* Safari */
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
	var imageRatio = im.offsetWidth/im.offsetHeight;
	console.log(windowRatio,imageRatio);
	im.style.width = "";
	im.style.height = "";
	im.style.marginLeft = "";
	im.style.marginRight = "";
	if(windowRatio<imageRatio){
		im.style.width = "100%";
		var margintop = (window.innerHeight - im.offsetHeight)/2;
		im.style.marginTop = margintop+"px";
	}
	else{
		im.style.height = "100%";
		var marginleft = (window.innerWidth - im.offsetWidth)/2;
		im.style.marginLeft = marginleft+"px";
	}
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
im.onload = function(){
	document.body.opacity = 1;
	window.onresize();
};
window.onresize();
</script>
</html>
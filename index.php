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
	}
	#image{
		height:100%;
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
<script>
var counter = 0;
var images = [<?php echo $imgarrstring;?>];
var im = document.getElementById("image");
var p = document.getElementById("countdisplay");
p.innerHTML = (counter+1)+" / "+ images.length;
im.onclick = function(){
	counter = (counter+1)%images.length;
	this.src = "images/"+images[counter];
	p.innerHTML = (counter+1)+" / "+ images.length;
}
</script>
</body>
</html>
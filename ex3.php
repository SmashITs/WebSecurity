<!DOCTYPE html>
<html>
<head><title>Ex 3: Bypass checks for Path Traversal</title></head>
<body>
<script>
var check = 0;
function solution() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
		if(check == 0){
			var unescaped_text = atob("cGhwOi8vZmlsdGVyL3Zhci93d3cvbXlQYWdlL3Jlc291cmNlPS9ldGMvcGFzc3dk");
			var text_node = document.createTextNode(unescaped_text);
			x.appendChild(text_node);
			check = check + 1;
		}
		x.style.display = "block";  
    } else {
        x.style.display = "none";
    }
} 
</script>
<?php
if(isset($_GET['path'])){
//Begin Hackit:****************************************************************
	define("BASEPATH","/var/www/mypage/");
	if(!empty($_GET['path']) && !is_array($_GET['path'])){
		$path = $_GET['path'];
		if(stristr($path,'..')){
			die("You used '..' -> goodbye");
		}
		if(!stristr($path,BASEPATH)){
			die("Your given Path is not in my page root -> goodbye");
		}
		$out = "";
		$file = fopen($path,"r");
		if($file){
			echo "<hr>Reading File..<br>";
			while(($line = fgets($file)) !== false){
				$out .= $line;
			}
			echo htmlspecialchars($out,ENT_QUOTES,'UTF-8');
			echo "<hr>";
		}
		else{
			die("Can't open file");
		}
	}
//End Hackit****************************************************************** 
}
else{
	$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$actual_link = $actual_link."?path=/var/www/mypage/";
	header("Location: $actual_link");
	die();
}
?>.
<br>
Show solution:<br>
<button onclick="solution()">Help me!</button>
<div id="myDIV" style="display:none">
</div>
</body>
</html>

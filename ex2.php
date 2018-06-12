<!DOCTYPE html>
<html>
<head><title>Ex 2: Bypass addslashes in Javascript context.</title></head>
<body>
<script>
function solution() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
		var unescaped_text = atob("PC9zY3JpcHQ+PHNjcmlwdD5hbGVydCgxMzM3KTwvc2NyaXB0Pg==");
		var text_node = document.createTextNode(unescaped_text);
		x.appendChild(text_node);
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
} 
</script>
<?php
if(isset($_GET['val'])){
	//The only interesting stuff is in the PHP part.
	if(!empty($_GET['val']) && !is_array($_GET['val'])){
		$xp = addslashes($_GET['val']);
		echo "Your input was: ".htmlspecialchars($_GET['val'],ENT_QUOTES,'UTF-8');
		echo '<script>
		function test(){
			alert("'.$xp.'");
		}
		</script>';
	}
}
else{
	$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$actual_link = $actual_link."?val=1";
	header("Location: $actual_link");
	die();
}
?>.
<br>
<button onclick="test()">Click me</button><br></br>
Show solution:<br>
<button onclick="solution()">Help me!</button>
<div id="myDIV" style="display:none">
</div>
</body>
</html>

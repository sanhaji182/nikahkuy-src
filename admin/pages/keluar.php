<?php
	if(!defined("INDEX")) die("---");
	
	session_destroy();
	echo"<meta http-equiv='refresh' content='0; url=index.php'>";
?>
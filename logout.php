<?php
	session_start();
	echo "<script>window.location.assign('index.php')</script>";
	session_destroy();
?> 
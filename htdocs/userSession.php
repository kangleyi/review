<?php
	session_start();
	$isAdmin=isset($_GET['isAdmin'])?$_GET['isAdmin']:"";
	$username=isset($_GET['username'])?$_GET['username']:"";
	$id=isset($_GET['id'])?$_GET['id']:0;
	$nick=isset($_GET['nick'])?$_GET['nick']:"";
	$deleteFlag=isset($_GET['deleteFlag'])?$_GET['deleteFlag']:0;
	if($deleteFlag==1){
		$_SESSION['isAdmin'] = null;
		$_SESSION['username'] = null;
		$_SESSION['nick'] = null;
		$_SESSION['id'] = 0;
		header("location:index.php");
	}else{
		$_SESSION['isAdmin'] = $isAdmin;
		$_SESSION['username'] = $username;
		$_SESSION['nick'] = $nick;
		$_SESSION['id'] = $id;
		header("location:".($isAdmin==1?"main.php":"userMain.php"));
	}
?>
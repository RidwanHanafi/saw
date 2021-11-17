<?php
if (isset($_GET['pesan'])) {
	if ($_GET['pesan']=="logout") {
		session_start();
		if (session_destroy()){
		    header('location:./index.php?pesan=logout', true, 301);
		}
	}

}else{
	session_start();
	if (session_destroy()){
	    header('location:./index.php');
	}
}

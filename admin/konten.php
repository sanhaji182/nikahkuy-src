<?php
	if(!defined("INDEX")) die("---");
	
	if( isset($_GET['tampil']) ) $tampil = $_GET['tampil'];
	else $tampil = "beranda";

	if($tampil == "keluar" )	include("pages/keluar.php");
	elseif($tampil == "beranda" )	include("pages/beranda.php");


	//CH
	elseif($tampil == "ch" )	include("pages/ch/ch.php");
	elseif($tampil == "ch-add" )	include("pages/ch/ch-add.php");
	elseif($tampil == "ch-edit" )	include("pages/ch/ch-edit.php");
	elseif($tampil == "ch-delete" )	include("pages/ch/ch-delete.php");

	//BG
	elseif($tampil == "bg" )	include("pages/bg/bg.php");
	elseif($tampil == "bg-add" )	include("pages/bg/bg-add.php");
	elseif($tampil == "bg-edit" )	include("pages/bg/bg-edit.php");
	elseif($tampil == "bg-delete" )	include("pages/bg/bg-delete.php");

	//MUSIC
	elseif($tampil == "music" )	include("pages/music/music.php");
	elseif($tampil == "music-add" )	include("pages/music/music-add.php");
	//elseif($tampil == "music-edit" )	include("pages/music/music-edit.php");
	elseif($tampil == "music-delete" )	include("pages/music/music-delete.php");

	//DIALOG
	elseif($tampil == "di" )	include("pages/di/di.php");
	elseif($tampil == "di-add" )	include("pages/di/di-add.php");
	elseif($tampil == "di-edit" )	include("pages/di/di-edit.php");
	elseif($tampil == "di-delete" )	include("pages/di/di-delete.php");

	//SCENE
	elseif($tampil == "sc" )	include("pages/sc/sc.php");	
	elseif($tampil == "sc-add" )	include("pages/sc/sc-add.php");
	elseif($tampil == "sc-edit" )	include("pages/sc/sc-edit.php");
	elseif($tampil == "sc-delete" )	include("pages/sc/sc-delete.php");

	//STORY
	elseif($tampil == "st" )	include("pages/st/st.php");
	elseif($tampil == "prevst" )	include("pages/st/prevst.php");	
	elseif($tampil == "st-add" )	include("pages/st/st-add.php");
	elseif($tampil == "st-edit" )	include("pages/st/st-edit.php");
	elseif($tampil == "st-delete" )	include("pages/st/st-delete.php");

	else echo"Konten tidak ada";
?>		
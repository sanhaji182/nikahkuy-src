<?php

if(!defined("INDEX")) die("---");
if(isset($_GET['delete_id']))
{
	// select image from db to delete
	// $stmt_select = $DB_con->prepare('SELECT id FROM `dialog` WHERE id_ch =:uid');
	// $stmt_select->execute(array(':uid'=>$_GET['delete_id']));
	// $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
	// unlink("./assets/characters/".$imgRow['fie_location']);
	
	// it will delete an actual record from db
	$stmt_delete = $DB_con->prepare('DELETE FROM `dialog` WHERE id_dialog =:uid');
	$stmt_delete->bindParam(':uid',$_GET['delete_id']);
	$stmt_delete->execute();
	
	header("Location: ?tampil=di");
}

?>
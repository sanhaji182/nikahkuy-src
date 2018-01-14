<?php
	
	
	if(!defined("INDEX")) die("---");

	error_reporting( ~E_NOTICE );
	
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM dialog WHERE id_dialog =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: ?tampil=di");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$id_ch = $_POST['id_ch'];
		$dialog = $_POST['dialog'];
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE dialog 
									     SET id_dialog=:uidi, 										     
										     dialog=:udi 
								       WHERE id_dialog=:uid');
			$stmt->bindParam(':uidi',$id_ch);			
			$stmt->bindParam(':udi',$dialog);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='?tampil=di';
				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
			}
		
		}
		
						
	}
	
?>
<br>
<div id="page-wrapper">
        
        <div class="container">


	<div class="page-header">
    	<h1 class="h2">Update Dialog. <a class="btn btn-default" href="?tampil=di"> all dialog </a></h1>
    </div>

<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">id_ch.</label></td>
        <td><input class="form-control" type="number" name="id_ch" value="<?php echo $id_ch; ?>" required /></td>
    </tr>    
    <tr>
    	<td><label class="control-label">dialog</label></td>
        <td><input class="form-control" type="text" name="id_ch" value="<?php echo $dialog; ?>" required /></td>
    </tr>    
    
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Update
        </button>
        
        <a class="btn btn-default" href="background.php"> <span class="glyphicon glyphicon-backward"></span> cancel </a>
        
        </td>
    </tr>
    
    </table>
    
</form>

</div>

        </div>
        <!-- /#page-wrapper -->
        <script type="text/javascript">
			function PreviewImage() {
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
			oFReader.onload = function (oFREvent)
			 {
			    document.getElementById("uploadPreview").src = oFREvent.target.result;
			    
			};
			};
		</script>
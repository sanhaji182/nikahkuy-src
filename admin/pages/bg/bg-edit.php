<?php
	
	
	if(!defined("INDEX")) die("---");

	error_reporting( ~E_NOTICE );
	
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT nama,file_location FROM background WHERE id_bg =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: background.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$nama = $_POST['nama'];// user name		
			
		$imgFile = $_FILES['bg_image']['name'];
		$tmp_dir = $_FILES['bg_image']['tmp_name'];
		$imgSize = $_FILES['bg_image']['size'];
					
		if($imgFile)
		{
			$upload_dir = './assets/backgrounds/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$file_location = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['file_location']);
					move_uploaded_file($tmp_dir,$upload_dir.$file_location);
                    $file_location = 'assets/backgrounds/'.$file_location;
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$file_location = $edit_row['file_location']; // old image from database
		}	
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE background 
									     SET nama=:uname, 										     
										     file_location=:upic 
								       WHERE id_bg=:uid');
			$stmt->bindParam(':uname',$nama);			
			$stmt->bindParam(':upic',$file_location);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='?tampil=bg';
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
    	<h1 class="h2">update background. <a class="btn btn-default" href="?tampil=bg"> all background </a></h1>
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
    	<td><label class="control-label">Nama Background.</label></td>
        <td><input class="form-control" type="text" name="nama" value="<?php echo $nama; ?>" required /></td>
    </tr>    
    
    <tr>
    	<td><label class="control-label">Background Img.</label></td>
        <td>
        	<p><img id="uploadPreview" src="./<?php echo $file_location; ?>" height="150" width="150" /></p>
        	<input onchange="PreviewImage();" id="uploadImage" class="input-group" type="file" name="bg_image" accept="image/*" />
        </td>
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
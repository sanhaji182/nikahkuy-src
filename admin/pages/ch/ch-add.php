<?php
	if(!defined("INDEX")) die("---");
	error_reporting( ~E_NOTICE ); // avoid notice
	
	if(isset($_POST['btnsave']))
	{
		$nama = $_POST['nama'];// user name

		$imgFile = $_FILES['ch_image']['name'];
		$tmp_dir = $_FILES['ch_image']['tmp_name'];
		$imgSize = $_FILES['ch_image']['size'];
		
		
		if(empty($nama)){
			$errMSG = "Nama tidak boleh kosong.";
		}
		else if(empty($imgFile)){
			$errMSG = "Tolong pilih file image.";
		}
		else
		{
			$upload_dir = './assets/characters/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$file_location = rand(1000,1000000).".".$imgExt;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$file_location);
					$file_location = 'assets/characters/'.$file_location;
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		}
		
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO `character`(nama,file_location) VALUES(:uname, :upic)');
			$stmt->bindParam(':uname',$nama);			
			$stmt->bindParam(':upic',$file_location);
			
			if($stmt->execute())
			{
				$successMSG = "new record succesfully inserted ...";
				header("refresh:3;?tampil=ch"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "error while inserting....";
			}
		}
	}
?>
<br>
<div id="page-wrapper">
        <div class="container">


        <div class="page-header">
            <h1 class="h2">add new Character. <a class="btn btn-default" href="?tampil=ch"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>
        </div>
        
    
        <?php
        if(isset($errMSG)){
                ?>
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
                </div>
                <?php
        }
        else if(isset($successMSG)){
            ?>
            <div class="alert alert-success">
                  <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
            </div>
            <?php
        }
        ?>   
    
    <form method="post" enctype="multipart/form-data" class="form-horizontal">
            
        <table class="table table-bordered table-responsive">
        
        <tr>
            <td><label class="control-label">Nama Character</label></td>
            <td><input id="preview_gambar" class="form-control" type="text" name="nama" placeholder="Enter nama" value="<?php echo $nama; ?>" required/></td>
        </tr>
        
        
        <tr>
            <td><label class="control-label">Character Image</label></td>
            <td><input onchange="PreviewImage();" id="uploadImage" class="input-group" type="file" name="ch_image" accept="image/*" required />
            <br>
            <div id="img">
            </div>
            
            </td>
            
        </tr>
        
        <tr>
            <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
            <span class="glyphicon glyphicon-save"></span> &nbsp; save
            </button>
            </td>
        </tr>
        
        </table>
        
    </form>
        
        
    
    </div>
        </div>
        <!-- /#page-wrapper -->
        <script type="text/javascript">
			function PreviewImage() {
			document.getElementById('img').innerHTML = '<img src="#" id="uploadPreview" width=20% alt="Preview Gambar" />';
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
			oFReader.onload = function (oFREvent)
			 {
			    document.getElementById("uploadPreview").src = oFREvent.target.result;
			    
			};
			};
		</script>
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
            <h1 class="h2">add new Scene. <a class="btn btn-default" href="?tampil=sc"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>
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
            
        <div class="row">
        	<div class="col-sm-8 form-group">
		      <label for="sel1">Background: </label>
		      <select class="form-control" id="sel1">
		        <option>1</option>
		        <option>2</option>
		        <option>3</option>
		        <option>4</option>
		      </select>
    		</div> 
        </div>

        <div class="row">
        	<div class="col-sm-8 form-group">
		      <label for="sel1">Music: </label>
		      <select class="form-control" id="sel1">
		        <option>1</option>
		        <option>2</option>
		        <option>3</option>
		        <option>4</option>
		      </select>
    		</div> 
        </div>

        <div class="row">
        	<div style="margin-right: 20px" class="col-sm-2 form-group">
		      <label for="sel1">Char Position 1: </label>
		      <select onchange="PreviewImage();" id="uploadImage" class="form-control">
		        <option style="width:100%;background-image:url(./assets/characters/Char1AngrySchool.png);">1</option>
		        <option>2</option>
		        <option>3</option>
		        <option>4</option>
		      </select>
		      <div class="img"></div>
    		</div> 
    		<div style="margin-right: 20px" class="col-sm-2 form-group">
		      <label for="sel1">Char Position 2: </label>
		      <select class="form-control" id="sel1">
		        <option>1</option>
		        <option>2</option>
		        <option>3</option>
		        <option>4</option>
		      </select>
    		</div> 
    		<div style="margin-right: 20px" class="col-sm-2 form-group">
		      <label for="sel1">Char Position 3: </label>
		      <select class="form-control" id="sel1">
		        <option>1</option>
		        <option>2</option>
		        <option>3</option>
		        <option>4</option>
		      </select>
    		</div> 
    		<div style="margin-right: 20px" class="col-sm-2 form-group">
		      <label for="sel1">Char Position 4: </label>
		      <select class="form-control" id="sel1">
		        <option>1</option>
		        <option>2</option>
		        <option>3</option>
		        <option>4</option>
		      </select>
    		</div> 
        </div>

        <div class="row">
        	<button type="submit" name="btnsave" class="btn btn-default">
            <span class="glyphicon glyphicon-save"></span> &nbsp; save
            </button>
        </div>
           
        
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
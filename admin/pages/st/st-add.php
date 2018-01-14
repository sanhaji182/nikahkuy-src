<?php

	if(!defined("INDEX")) die("---");
	
	
	if(isset($_POST['btnsave']))
	{
		$id_scene = $_POST['id_scene'];// user name		
		$id_dialog = $_POST['id_dialog'];// user name		
		$choice1 = $_POST['choice1'];// user name		
		$choice2 = $_POST['choice2'];// user name		
		$choice1_nama = $_POST['choice1_nama'];// user name		
		$choice2_nama = $_POST['choice2_nama'];// user name		

		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO story(id_scene,id_dialog,choice1,choice2,choice1_nama,choice2_nama) VALUES(:uch,:uch2,:uch3,:uch4,:ubg,:ums)');
			$stmt->bindParam(':uch',$id_scene);			
			$stmt->bindParam(':uch2',$id_dialog);			
			$stmt->bindParam(':uch3',$choice1);			
			$stmt->bindParam(':uch4',$choice2);			
			$stmt->bindParam(':ubg',$choice1_nama);			
			$stmt->bindParam(':ums',$choice2_nama);						
			
			if($stmt->execute())
			{
				$successMSG = "new record succesfully inserted ...";
				header("refresh:3;?tampil=st"); // redirects image view page after 5 seconds.
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
            <h1 class="h2">add new Story. <a class="btn btn-default" href="?tampil=st"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>
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

		</tr>
        
        <tr>
            <td><label class="control-label">Id Scene yang di inginkan</label></td>			
            <td><input class="form-control" type="number" name="id_scene" placeholder="id Scene" required /></td>
        </tr>
		<tr>
            <td><label class="control-label">Id Dialog yang di inginkan</label></td>			
            <td><input class="form-control" type="number" name="id_dialog" placeholder="id Dialog" required /></td>
        </tr>
		<tr>
            <td><label class="control-label">Id Scene yang di inginkan ketika pilihan 1 di pilih</label></td>			
            <td><input class="form-control" type="number" name="choice1" placeholder="id Scene" required /></td>
        </tr>
		<tr>
            <td><label class="control-label">Id Scene yang di inginkan ketika pilihan 2 di pilih</label></td>			
            <td><input class="form-control" type="number" name="choice2" placeholder="id Scene" required /></td>
        </tr>
		<tr>
            <td><label class="control-label">Text Pilihan 1 </label></td>			
            <td><input class="form-control" type="text" name="choice1_nama" placeholder="Text Pilihan 1" required /></td>
        </tr>
		<tr>
            <td><label class="control-label">Text Pilihan 2</label></td>			
            <td><input class="form-control" type="text" name="choice2_nama" placeholder="Text Pilihan 2" required /></td>
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
			document.getElementById('img').innerHTML = '<img src="#" id="uploadPreview" width=50% alt="Preview Gambar" />';
			var oFReader = new FileReader();
			oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
			oFReader.onload = function (oFREvent)
			 {
			    document.getElementById("uploadPreview").src = oFREvent.target.result;
			    
			};
			};
		</script>
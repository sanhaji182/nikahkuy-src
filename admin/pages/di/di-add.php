<?php

	if(!defined("INDEX")) die("---");
	
	
	if(isset($_POST['btnsave']))
	{
		$id_ch = $_POST['id_ch'];// user name		
		$dialog = $_POST['dialog'];// user name		

		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO dialog(id_ch,dialog) VALUES(:uch, :udi)');
			$stmt->bindParam(':uch',$id_ch);			
			$stmt->bindParam(':udi',$dialog);
			
			if($stmt->execute())
			{
				$successMSG = "new record succesfully inserted ...";
				header("refresh:3;?tampil=di"); // redirects image view page after 5 seconds.
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
            <h1 class="h2">add new Dialog. <a class="btn btn-default" href="?tampil=di"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>
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
            <td><label class="control-label">id Character</label></td>
			<!-- <select>
  			<option value="volvo">Volvo</option>
  			</select> -->
            <td><input class="form-control" type="number" name="id_ch" placeholder="id Character" required /></td>
        </tr>
		<tr>
            <td><label class="control-label">Dialog</label></td>
            <td><input class="form-control" type="text" name="dialog" placeholder="id Character" required /></td>
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
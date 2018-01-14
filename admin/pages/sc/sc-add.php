<?php

	if(!defined("INDEX")) die("---");
	
	
	if(isset($_POST['btnsave']))
	{
		$id_ch = $_POST['id_ch'];// user name		
		$id_ch2 = $_POST['id_ch2'];// user name		
		$id_ch3 = $_POST['id_ch3'];// user name		
		$id_ch4 = $_POST['id_ch4'];// user name		
		$id_bg = $_POST['id_bg'];// user name		
		$id_music = $_POST['id_music'];// user name		

		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO scene(id_ch,id_ch2,id_ch3,id_ch4,id_bg,id_music) VALUES(:uch,:uch2,:uch3,:uch4,:ubg,:ums)');
			$stmt->bindParam(':uch',$id_ch);			
			$stmt->bindParam(':uch2',$id_ch2);			
			$stmt->bindParam(':uch3',$id_ch3);			
			$stmt->bindParam(':uch4',$id_ch4);			
			$stmt->bindParam(':ubg',$id_bg);			
			$stmt->bindParam(':ums',$id_music);						
			
			if($stmt->execute())
			{
				$successMSG = "new record succesfully inserted ...";
				header("refresh:3;?tampil=sc"); // redirects image view page after 5 seconds.
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
            
        <table class="table table-bordered table-responsive">
		<tr>

		</tr>
        
        <tr>
            <td><label class="control-label">Posisi 1 ( Id Character ), Input 0 Jika tidak ada Character di posisi ini</label></td>			
            <td><input class="form-control" type="number" name="id_ch" placeholder="id Character" required /></td>
        </tr>
		<tr>
            <td><label class="control-label">Posisi 2 ( Id Character ), Input 0 Jika tidak ada Character di posisi ini</label></td>			
            <td><input class="form-control" type="number" name="id_ch2" placeholder="id Character" required /></td>
        </tr>
		<tr>
            <td><label class="control-label">Posisi 3 ( Id Character ), Input 0 Jika tidak ada Character di posisi ini</label></td>			
            <td><input class="form-control" type="number" name="id_ch3" placeholder="id Character" required /></td>
        </tr>
		<tr>
            <td><label class="control-label">Posisi 4 ( Id Character ), Input 0 Jika tidak ada Character di posisi ini</label></td>			
            <td><input class="form-control" type="number" name="id_ch4" placeholder="id Character" required /></td>
        </tr>
		<tr>
            <td><label class="control-label">Id Background </label></td>			
            <td><input class="form-control" type="number" name="id_bg" placeholder="id Background" required /></td>
        </tr>
		<tr>
            <td><label class="control-label">Id Music</label></td>			
            <td><input class="form-control" type="number" name="id_music" placeholder="id Background" required /></td>
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
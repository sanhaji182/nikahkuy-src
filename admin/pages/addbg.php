<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once '../lib/dbconfig.php';
	
	if(isset($_POST['btnsave']))
	{
		$nama = $_POST['nama'];// user name

		$imgFile = $_FILES['bg_image']['name'];
		$tmp_dir = $_FILES['bg_image']['tmp_name'];
		$imgSize = $_FILES['bg_image']['size'];
		
		
		if(empty($nama)){
			$errMSG = "Nama tidak boleh kosong.";
		}
		else if(empty($imgFile)){
			$errMSG = "Tolong pilih file image.";
		}
		else
		{
			$upload_dir = '../assets/backgrounds/'; // upload directory
	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
			// rename uploading image
			$file_location = $'assets/backgrounds/'.rand(1000,1000000).".".$imgExt;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '5MB'
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$file_location);
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
			$stmt = $DB_con->prepare('INSERT INTO background(nama,file_location) VALUES(:uname, :upic)');
			$stmt->bindParam(':uname',$nama);			
			$stmt->bindParam(':upic',$file_location);
			
			if($stmt->execute())
			{
				$successMSG = "new record succesfully inserted ...";
				header("refresh:3;background.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "error while inserting....";
			}
		}
	}
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin-Background</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin</a>
            </div>
            <!-- /.navbar-header -->

            
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>                        
                        <li>
                            <a href="character.php"><i class="fa fa-group fa-fw"></i> Character</a>
                        </li>
                        <li>
                            <a href="background.php"><i class="fa fa-image fa-fw"></i> Background</a>
                        </li>                        
                        <li>
                            <a href="Music.php"><i class="fa fa-music fa-fw"></i> Music</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-film fa-fw"></i> Scene</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-map-signs fa-fw"></i> Story</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
        <div class="container">


        <div class="page-header">
            <h1 class="h2">add new Character. <a class="btn btn-default" href="background.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>
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
            <td><input class="form-control" type="text" name="nama" placeholder="Enter nama" value="<?php echo $nama; ?>" /></td>
        </tr>
        
        
        <tr>
            <td><label class="control-label">Background Image</label></td>
            <td><input class="input-group" type="file" name="bg_image" accept="image/*" /></td>
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

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>

<?php

	require_once '../lib/dbconfig.php';
	
	if(isset($_GET['delete_id']))
	{
		// select image from db to delete
		$stmt_select = $DB_con->prepare('SELECT file_location FROM music WHERE id_music =:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("../assets/audio/".$imgRow['file_location']);
		
		// it will delete an actual record from db
		$stmt_delete = $DB_con->prepare('DELETE FROM music WHERE id_music =:uid');
		$stmt_delete->bindParam(':uid',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: music.php");
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

    <title>Admin-Music</title>

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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Music
                    <a class="btn btn-default pull-right" href="addmusic.php"> <span class="glyphicon glyphicon-plus"></span> &nbsp; add new </a>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">
                            Hover Rows
                        </div> -->
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Music</th>
                                            <th>Action</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
	
	$stmt = $DB_con->prepare('SELECT id_music, nama, file_location FROM music ORDER BY id_music DESC');
	$stmt->execute();
	//var i = 1;
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			?>
                                        <tr>
                                            <td>1</td>
                                            <td><?php echo $nama; ?></td>
                                            <td>
                                            <audio controls>
                                            <source src="../assets/audio/<?php echo $row['file_location']; ?>" type="audio/mpeg">                                           
                                            </audio>                                                                                           
                                            <td>
                                            <span>
				<a class="btn btn-info" href="editmusic.php?edit_id=<?php echo $row['id_music']; ?>" title="click for edit" onclick="return confirm('sure to edit ?')"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
				<a class="btn btn-danger" href="?delete_id=<?php echo $row['id_music']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
				</span>
                                            </td>
                                        </tr>
                                        <?php
		}
	}
	else
	{
		?>
        <div class="col-xs-12">
        <div class="alert alert-warning">
            <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
        </div>
    </div>
        <?php
    }
    ?>                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->               
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
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

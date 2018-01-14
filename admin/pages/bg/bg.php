<?php

    if(!defined("INDEX")) die("---");
	
	if(isset($_GET['delete_id']))
	{
		// select image from db to delete
		$stmt_select = $DB_con->prepare('SELECT file_location FROM background WHERE id_bg =:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("./assets/backgrounds/".$imgRow['file_location']);
		
		// it will delete an actual record from db
		$stmt_delete = $DB_con->prepare('DELETE FROM background WHERE id_bg =:uid');
		$stmt_delete->bindParam(':uid',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: background.php");
	}

?>
<br>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Background
                    <a class="btn btn-default pull-right" href="?tampil=bg-add"> <span class="glyphicon glyphicon-plus"></span> &nbsp; add new </a>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->            
            <div class="row">
                <div class="col-sm-12">
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
                                            <th>Nama Background</th>
                                            <th>Gambar</th>
                                            <th>Action</th>                                             
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
	
	$stmt = $DB_con->prepare('SELECT id_bg, nama, file_location FROM background ORDER BY id_bg DESC');
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
                                            <td><img src="./<?php echo $row['file_location']; ?>" class="img-rounded" width=80% /></td>
                                            <td>
                                            <span>
											<a class="btn btn-info" href="?tampil=bg-edit&edit_id=<?php echo $row['id_bg']; ?>" title="click for edit" onclick="return confirm('sure to edit ?')"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
											<a class="btn btn-danger" href="?tampil=bg-delete&delete_id=<?php echo $row['id_bg']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
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
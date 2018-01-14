<?php
	if(!defined("INDEX")) die("---");
	if(isset($_GET['delete_id']))
	{
		// select image from db to delete
		// $stmt_select = $DB_con->prepare('SELECT id FROM `dialog` WHERE id_ch =:uid');
		// $stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		// $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		// unlink("./assets/characters/".$imgRow['fie_location']);
		
		// it will delete an actual record from db
		$stmt_delete = $DB_con->prepare('DELETE FROM `dialog` WHERE id_dialog =:uid');
		$stmt_delete->bindParam(':uid',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: ?tampil=di");
	}

?>
<br>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dialog
                    <a class="btn btn-default pull-right" href="?tampil=di-add"> <span class="glyphicon glyphicon-plus"></span> &nbsp; add new </a>
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
                                            <!--<th>#</th>-->
                                            <th>Character</th>
                                            <th></th>
                                            <th>Dialog</th>
                                            <th>Action</th>         
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
    
    $stmt = $DB_con->prepare("SELECT * FROM `dialog` ORDER BY id_dialog");
    $stmt->execute();
    //var i = 1;
    if($stmt->rowCount() > 0)
    {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $ch = $DB_con->prepare('SELECT * FROM `character` WHERE id_ch =:uid');
            $ch->execute(array(':uid'=>$row['id_ch']));
            $data_ch=$ch->fetch(PDO::FETCH_ASSOC);            
            ?>
                                        <tr>
                                           <!-- <td>1</td>-->
                                            <td><?php echo $data_ch['nama']; ?></td>
                                            <td><img src="./<?php echo $data_ch['file_location']; ?>" class="img-rounded" width=20% /></td>
                                            <td><textarea disabled name="message" style="width:320px; height:80px;"><?php echo $row['dialog'] ?></textarea></td>
                                            <td>
                                            <span>
                                                <a class="btn btn-info" href="?tampil=di-edit&edit_id=<?php echo $row['id_dialog']; ?>" title="click for edit" onclick="return confirm('sure to edit ?')"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
                                                <a class="btn btn-danger" href="?tampil=di-delete&delete_id=<?php echo $row['id_dialog']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
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

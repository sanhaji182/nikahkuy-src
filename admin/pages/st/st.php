<?php
	if(!defined("INDEX")) die("---");
	if(isset($_GET['delete_id']))
	{
		// select image from db to delete
		$stmt_select = $DB_con->prepare('SELECT file_location FROM `character` WHERE id_ch =:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("./assets/characters/".$imgRow['fie_location']);
		
		// it will delete an actual record from db
		$stmt_delete = $DB_con->prepare('DELETE FROM `character` WHERE id_ch =:uid');
		$stmt_delete->bindParam(':uid',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: ?tampil=ch");
	}

?>
<br>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header" style="text-align:center;">Config Scene
                    <a class="btn btn-default pull-left" href="?tampil=st"> <span class="glyphicon glyphicon-settings"></span> &nbsp; Config Scene </a>
                    <a class="btn btn-default pull-left" href="?tampil=prevst"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Preview Scene </a>
                    <a class="btn btn-default pull-right" href="?tampil=sc-add"> <span class="glyphicon glyphicon-plus"></span> &nbsp; add new </a>
                    </h3>
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
                                            <th>Urutan</th>
                                            <th>id_scene</th>
                                            <th>id_dialog</th>
                                            <th>Pil1_menuju_scene</th>
                                            <th>Pil2_menuju_scene</th>
                                            <th>Text_pil1</th>
                                            <th>Text_pil2</th>
                                            <th>Action</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
    
    $stmt = $DB_con->prepare("SELECT * FROM `story` ORDER BY id_story");
    $stmt->execute();
    //var i = 1;
    if($stmt->rowCount() > 0)
    {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);        
            ?>
                                        <tr>
                                            <td><?php echo $row['id_scene']; ?></td>
                                            <td>
                                                <?php echo $row['id_scene']; ?>
                                            </td>
                                            <td>
                                                 <?php echo $row['id_dialog']; ?>
                                            </td>
                                            <td>                                           
                                           <?php echo $row['choice1']; ?>
                                           </td>
                                           <td>                                           
                                           <?php echo $row['choice2']; ?>
                                           </td>
                                           <td>
                                           <?php echo $row['choice1_nama']; ?>
                                           </td>                                                        
                                           <td>
                                           <?php echo $row['choice2_nama']; ?>
                                           </td>
                                            <td>
                                            <span>
                                                <a class="btn btn-info" href="?tampil=sc-edit&edit_id=<?php echo $row['id_sc']; ?>" title="click for edit" onclick="return confirm('sure to edit ?')"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
                                                <a class="btn btn-danger" href="?tampil=sc-delete&delete_id=<?php echo $row['id_sc']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
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

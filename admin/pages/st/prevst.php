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
                                            <th>No</th>
                                            <th>Background</th>
                                            <th>Nama_Music</th>
                                            <th>Tampil_Character</th>
                                            <th>Ch_Dialog</th>
                                            <th>Dialog</th>
                                            <th>Pilihan1</th>                                            
                                            <th>Pilihan2</th>   
                                            <th>Action</th>                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
    
    $stmt = $DB_con->prepare("SELECT * FROM story INNER JOIN scene on story.id_scene=scene.id_scene ORDER BY id_story ");
    $stmt->execute();
    //var i = 1;
    if($stmt->rowCount() > 0)
    {
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $bg = $DB_con->prepare('SELECT * FROM `background` WHERE id_bg =:uid');
            $bg->execute(array(':uid'=>$row['id_bg']));
            $data_bg=$bg->fetch(PDO::FETCH_ASSOC);

            $music = $DB_con->prepare('SELECT * FROM `music` WHERE id_music =:uid');
            $music->execute(array(':uid'=>$row['id_music']));
            $data_music=$music->fetch(PDO::FETCH_ASSOC);

            $di = $DB_con->prepare('SELECT * FROM dialog inner join `character` on dialog.id_ch=character.id_ch WHERE id_dialog =:uid');
            $di->execute(array(':uid'=>$row['id_dialog']));
            $data_di=$di->fetch(PDO::FETCH_ASSOC);

            $ch1 = $DB_con->prepare('SELECT * FROM `character` WHERE id_ch =:uid');
            $ch1->execute(array(':uid'=>$row['id_ch']));
            $data_ch1=$ch1->fetch(PDO::FETCH_ASSOC);

            $ch2 = $DB_con->prepare('SELECT * FROM `character` WHERE id_ch =:uid');
            $ch2->execute(array(':uid'=>$row['id_ch2']));
            $data_ch2=$ch2->fetch(PDO::FETCH_ASSOC);

            $ch3 = $DB_con->prepare('SELECT * FROM `character` WHERE id_ch =:uid');
            $ch3->execute(array(':uid'=>$row['id_ch3']));
            $data_ch3=$ch3->fetch(PDO::FETCH_ASSOC);

            $ch4 = $DB_con->prepare('SELECT * FROM `character` WHERE id_ch =:uid');
            $ch4->execute(array(':uid'=>$row['id_ch4']));
            $data_ch4=$ch4->fetch(PDO::FETCH_ASSOC);
            ?>
                                        <tr>
                                            <td><?php echo $row['id_story']; ?></td>
                                            <td>
                                                <!-- <img src="./<?php echo $data_bg['file_location']; ?>" class="img-rounded" width=100% /> -->
                                                <!-- <br> -->
                                                <?php echo $data_bg['nama']; ?>
                                            </td>
                                            <td>
                                                <!-- <audio controls>
                                                    <source src="./<?php echo $data_music['file_location']; ?>" type="audio/mpeg">                                 
                                                </audio>
                                                <br> -->
                                                <?php echo $data_music['nama']; ?>
                                            </td>
                                            <td>
                                           <!-- <img src="./<?php echo $data_ch1['file_location']; ?>" class="img-rounded" width=100% alt="Tidak Ada"/>
                                           <br> -->
                                           <?php echo $data_ch1['nama'],", ",$data_ch2['nama'],", ",$data_ch3['nama'],", ",$data_ch4['nama']; ?>
                                           </td>
                                           <td>                                           
                                           <?php echo $data_di['nama']; ?>
                                           </td>
                                           <td>                                         
                                           <textarea disabled  style="width:250px; height:80px;"><?php echo $data_di['dialog'] ?></textarea>
                                           </td>                                                        
                                           <td>                                           
                                           <textarea disabled  style="width:200px; height:80px;"><?php echo $row['choice1_nama']; ?></textarea>
                                           </td>
                                           <td>
                                           <textarea disabled  style="width:200px; height:80px;"><?php echo $row['choice2_nama']; ?></textarea>
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

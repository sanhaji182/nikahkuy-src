<?php 
  if(!defined("INDEX")) die("---");
  $stmt_ch = $DB_con->prepare("SELECT count(*) AS jumlah FROM `character`");
  $stmt_ch->execute();
  $row_ch=$stmt_ch->fetch();

  $stmt_bg = $DB_con->prepare("SELECT count(*) AS jumlah FROM `background`");
  $stmt_bg->execute();
  $row_bg=$stmt_bg->fetch();

  $stmt_music = $DB_con->prepare("SELECT count(*) AS jumlah FROM `music`");
  $stmt_music->execute();
  $row_music=$stmt_music->fetch();

  $stmt_di = $DB_con->prepare("SELECT count(*) AS jumlah FROM `dialog`");
  $stmt_di->execute();
  $row_di=$stmt_di->fetch();

  $stmt_sc = $DB_con->prepare("SELECT count(*) AS jumlah FROM `scene`");
  $stmt_sc->execute();
  $row_sc=$stmt_sc->fetch();

  $stmt_st = $DB_con->prepare("SELECT count(*) AS jumlah FROM `story`");
  $stmt_st->execute();
  $row_st=$stmt_st->fetch();
 ?>
 		<br>
 		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-group fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row_ch['jumlah'] ?></div>
                                    <div>Characters!</div>
                                </div>
                            </div>
                        </div>
                        <a href="?tampil=ch">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-image fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row_bg['jumlah'] ?></div>
                                    <div>Backgrounds!</div>
                                </div>
                            </div>
                        </div>
                        <a href="?tampil=bg">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-music fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row_music['jumlah'] ?></div>
                                    <div>Musics!</div>
                                </div>
                            </div>
                        </div>
                        <a href="?tampil=music">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row_di['jumlah'] ?></div>
                                    <div>Dialogs!</div>
                                </div>
                            </div>
                        </div>
                        <a href="?tampil=di">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red" style="border-color: #00cccc">
                        <div class="panel-heading" style="border-color:#00cccc;background-color:#00cccc">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-film fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row_sc['jumlah'] ?></div>
                                    <div>Scenes!</div>
                                </div>
                            </div>
                        </div>
                        <a href="?tampil=sc" style="color: #00cccc">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red" style="border-color: #ff3399">
                        <div class="panel-heading" style="border-color:#ff3399;background-color:#ff3399">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-map-signs fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $row_st['jumlah'] ?></div>
                                    <div>Stories!</div>
                                </div>
                            </div>
                        </div>
                        <a href="?tampil=st" style="color:#ff3399">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
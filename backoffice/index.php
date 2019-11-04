<?php 
  require_once("../includes/config.php");
  require_once('../includes/dao.php');
  $dao = new DAO();
  $dao->setDb($db);
  $dao->setKey($private_key);
  $dao->setIndexKey($index_key);

  $page = intval($_GET["page"]);
  $start = 0;
  $end = 100;
  if ($page > 1) {
    $start = ($page * $end) - $end;
  }
  $source = filter_var($_GET['source'],FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $q = filter_var($_GET['q'],FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
  $email = filter_var($_GET['email'],FILTER_SANITIZE_EMAIL,FILTER_FLAG_NO_ENCODE_QUOTES);
  $phone = filter_var($_GET['phone'],FILTER_SANITIZE_EMAIL,FILTER_FLAG_NO_ENCODE_QUOTES);
  if ($email."" != "") {
    $email_hash = $dao->getBlindIndex($email);
  }
  if ($phone."" != "") {
    $phone_hash = $dao->getBlindIndex($phone);
  }

  $listItems = $dao->listItems($source, $id, $q, $start, $end, $email_hash, $phone_hash);
  $countItems = $dao->countItems($source, $id, $q, $email_hash, $phone_hash);

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Safe Landings Demo</title>
    <style>
      .moreinfo { border-bottom: 1px dotted #000; text-decoration: none;}
    </style>
  </head>
  <body>
    
    <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h1>Safe Landings - backoffice demo</h1>
      <h5 style="line-height:30px;">This is a demo page built to show how to display data stored with Safe Landings.<br />
      <span style="background:yellow">You mustn't use it in a production environment.</span><br />
      Mouse over emails and phones to read the actual data stored in the database.
      </h5>
      <hr style="margin:20px 0;" />
      
      
      </div>
    </div>

    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Subscribers <?php if ($_GET["source"]."" != "") { echo " ".$_GET["source"];}?>: <?php echo $countItems[0]["c"];?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-lg-4">
                <form name="f1" method="GET">
                <div class="form-group">
                    <label>Search by last name</label>
                    <input class="form-control" type="text" value="<?php echo $q;?>" name="q">
                </div>
                </form>
              </div>
              <div class="col-lg-4">
                <form name="f1" method="GET">
                <div class="form-group">
                    <label>Search by email (full)</label>
                    <input class="form-control" type="text" value="<?php echo $email;?>" name="email">
                </div>
                </form>
              </div>
              <div class="col-lg-4">
                <form name="f1" method="GET">
                <div class="form-group">
                    <label>Search by phone (full)</label>
                    <input class="form-control" type="text" value="<?php echo $phone;?>" name="phone">
                </div>
                </form>
              </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Creation date</th>
                                        <th>Sorgente</th>
                                        <th>Privacy</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                        					if (is_array($listItems)) {
                                    $i = 0;
                        						foreach($listItems as $row) {
                                      $i++;
                                      if ($i % 2 == 0) {$rowClass = "even";} else {$rowClass = "odd";}
                        							?>
                                  <tr class="<?php echo $rowClass;?> gradeX">
                                      <td><?php echo $row['id']?></td>
                                      <td><?php echo $row['first_name'];?></td>
                                      <td><?php echo $row['last_name']?></td>
                                      <td><span class="moreinfo" data-toggle="tooltip" title="string stored in database: <?php echo $row['email'];?>"><?php echo $dao->dec($row['email']);?></span></td>
                                      <td><span class="moreinfo" data-toggle="tooltip" title="string stored in database: <?php echo $row['phone'];?>"><?php echo $dao->dec($row['phone']);?></span></td>
                                      <td><?php echo $row['creation_date']?></td>
                                      <td><?php echo $row['source']?></td>                           
                                      <td><?php echo $row['privacy']?></td>
                                  </tr>
                                <?php }
                                    }
                                ?>
                                </tbody>
                            </table>

                            <div class="paging">
			                    <?php //echo paging($_GET["page"],$start,$end,$countItems[0]["c"]);?>
		                    </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
  </body>
</html>
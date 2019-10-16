<?php 
  require_once('./includes/config.php');
  require_once('./includes/dao.php');

  //anti-bot
  $chk = filter_var($_POST['chk'], FILTER_SANITIZE_STRING); 
  if ($chk."" != "") {
    header("location: /?e=bot");
    exit();
  }
  $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
  $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
  $privacy = filter_var($_POST['privacy'], FILTER_SANITIZE_STRING);
  $source = filter_var($_POST['source'], FILTER_SANITIZE_STRING); 
  if ($source."" == "") {
    $source = "Organic Web";
  }


  // server side validation
  if (trim($first_name)."" == "" || trim($last_name)."" == "" || trim($email)."" == "" || trim($phone)."" == "") {
    header("location: /?e=missing_fields");
    exit();
  }


  $dao = new DAO();
  $dao->setDb($db);
  $dao->setKey($private_key);
  $dao->setIndexKey($index_key);


  // controllo esistenza mail criptata
  $email_hash = $dao->getBlindIndex($email);
  if ($dao->exists_email($email_hash)) {
    header("location: index.php?e=email_exists");
    exit();
  }

  // controllo esistenza phone criptato
  $phone = $dao->getBlindIndex($phone);
  if ($dao->exists_phone($phone)) {
    header("location: index.php?e=phone_exists");
    exit();
  }

	$new_subscriber = $dao->insert($first_name,$last_name,$email,$phone,$privacy,$source,$ip);
  if (!$new_subscriber) {
    header("location: error.php");
    exit();
  }
  else {
    header("location: thankyou.php?id=".$new_subscriber);
    exit();
  }
?>
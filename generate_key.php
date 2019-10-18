<?php 
require_once("./includes/config.php");
// Generating your encryption key
$private_key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
// Generating your blind index key
$index_key = random_bytes(SODIUM_CRYPTO_PWHASH_SALTBYTES);
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
      p {line-height:2rem;}
      .keybox {background: yellow; padding: 4px 4px;}
      pre {border:1px solid #333; background: #ddd; padding: 20px; }
    </style>
  </head>
  <body>
    
    <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h1>Safe Landings - demo</h1>
      <hr style="margin:20px 0;" />
      <p>
       Your private key:<br /><span class="keybox"><?php echo base64_encode($private_key);?></span><br /><br />
       Your blind index key:<br /><span class="keybox"><?php echo base64_encode($index_key);?></span><br />
       <br />
       Save them in a safe place.<br />
       Then, open your config.php file in "/includes" folder and change lines 50 and 51 with these two lines of code:<br />
      <pre>
$private_key = "<?php echo base64_encode($private_key);?>"; // YOUR PRIVATE KEY 
$index_key = "<?php echo base64_encode($index_key);?>"; // YOUR BLIND INDEX KEY 
      </pre>
      Upload config.php file in "/includes" folder and reload the <a href="index.php">homepage</a>.<br /> 

      </p>
      </div>
    </div>
      
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
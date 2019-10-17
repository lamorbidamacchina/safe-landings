<?php require_once("./includes/config.php");?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Safe Landings Demo</title>
  </head>
  <body>
    
    <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h1>Safe Landing - demo</h1>
      <hr style="margin:20px 0;" />
      
      <?php if($_GET["e"]."" != "") { ?>
      <div class="alert alert-warning" role="alert">
        Warning: <?php echo $_GET["e"];?>
      </div>
      <?php  } ?>

        <form method="POST" action="save.php" name="f1">
        <input name="source" value="<?php echo $_GET['source'];?>" type="hidden" />
        <input name="chk" value="" type="hidden" />
          <div class="form-group">
            <label for="nome">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
          </div>
          <div class="form-group">
            <label for="cognome">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Your email..." required>
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Your phone number" required>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="privacy" name="privacy" value="1" required>
            <label class="form-check-label" for="privacy">Privacy</label>
          </div>
          <div class="form-group" style="margin-top:20px;">
            <button type="submit" class="btn btn-primary" >Send</button>
          </div>
        </form>
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
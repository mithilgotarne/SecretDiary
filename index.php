<?php
	
	session_start();

  $message="";

  if(isset($_GET['logout'])){
    session_destroy();
    $message = "You are successfully logged out. Have a nice day!";
    session_start();
  }

	include('conn.php');

  if(isset($_SESSION['id'])){
    header("Location:diary.php");
  }

	if(isset($_POST['submit'])){

    //Email validitation
		if(!$_POST['email']) 
			$error.= "Enter email address. <br />";
		else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			$error.= "Enter a valid email address. <br />";


    //Password Validitation
		if(!$_POST['password'])	
			$error.= "Enter password. <br />";
		else if(strlen($_POST['password'])<6)
			$error.= "Your password must have atleast six characters.";

		if($error!=""){
			//if error found do nothing...
		}
		else if($_POST['submit'] == "Log In!"){

      //try to log in
			include('login.php');

		}

		else if($_POST['submit'] == "Sign Up!") {
      //try to signup
			include('signup.php');

		}

	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Mithil Gotarne">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Secret Diary</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style type="text/css">

  #topContainer{
    
    width: 100%;
    height: 643px;
    background-size: cover;
    background-image: url("images/background.jpg");
    padding: 100px;
  }

  #topRow{
    
    padding: 30px;
    text-align: center;
    background-color: rgba(242, 242, 242,0.7); 
    padding-bottom: 30px; 
  }

  #topRow h1{
    font-size: 300%;
  }

  .bold{
    font-weight: bold;
  }

  .marginTop{
    margin-top: 30px;
  }

  .center{
    text-align: center;
  }


</style>


</head>
<body>

<!--==================================
=            NavgationBar            =
===================================-->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <div class="container">

      <div class="navbar-header">

        <a class="navbar-brand" href="/">Secret Diary</a>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

      </div><!-- /.navbar-header -->

      <div id="navbar" class="collapse navbar-collapse">

        <form class="navbar-form navbar-right" method="post">

          <div class="form-group">

            <input name="email" type="email" class="form-control" placeholder="Email"></input>

          </div><!-- /.form-group -->

          <div class="form-group">

            <input name="password" type="password" class="form-control" placeholder="Password"></input>

          </div><!-- /.form-group -->

          <div class="form-group">

            <input name="submit" type="submit" class="btn btn-success" value="Log In!"></input>

          </div><!-- /.form-group -->

        </form>

      </div><!-- /#navbar.collapse navbar-collapse -->

    </div><!-- /.container-fluid -->

  </nav><!-- /.navbar navbar-default -->


<!--====  End of NavgationBar  ====-->

<!--===================================
=            Top Container            =
====================================-->
  <div class="container contentContainer" id="topContainer">

      <div class="row">
        
        <div class="col-md-6 col-md-offset-3" id="topRow">
          
          <h1 class="marginTop">Secret Diary</h1>

          <p class="lead">Your secret diary, with you wherever you go.</p>
		
		  <?php 
		  	if($error!=""){
		  		echo '<div class="alert alert-danger">'.$error.'</div>';
		  	}
		  	
        else if($message!=""){
          echo '<div class="alert alert-success">'.$message.'</div>';
        }
		  ?>
          
          <p class="bold marginTop">Interested? Sign Up below!</p>

          <form role="form" class="marginTop" method="post">
            
            <div class="form-group form-group-lg">
              
              <input name="email" type="email" class="form-control" placeholder="Your Email"></input>

            </div><!-- /.form-group -->

            <div class="form-group form-group-lg">
              
              <input name="password" type="password" class="form-control" placeholder="Password"></input>

            </div><!-- /.form-group -->
              
            <input name="submit" type="submit" class="btn btn-success btn-lg" value="Sign Up!"></input>


          </form>

        </div><!-- /.col-md-6 col-md-offset-3 -->

      </div><!-- /#topRow.row -->
      
  </div><!-- /.container -->


<!--====  End of Top Container  ====-->

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

  <!--Custom Script to Calculate height of contentContainer-->
  <script type="text/javascript">
    
    //to calculate height of the top Container
    $(".contentContainer").css("min-height", $(window).height());

  </script>
</body>
</html>
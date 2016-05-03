<?php
	session_start();

	include('conn.php');
  //stroes diary enty
	$diary ="";
	$email ="";

  //If session id is assigned then only we can access or update diary entry
	if(isset($_SESSION['id'])){

		$id = $_SESSION['id'];

		$query = "SELECT * FROM users WHERE id = '$id' LIMIT 1";

		if($result = mysqli_query($link,$query)){

			$row = mysqli_fetch_array($result);

			$diary = $row['entry'];
			$email = $row['email'];

		}
		else{
			header("Location:index.php"); //if no user found redirect to main-page
		}
	}
	else{
		header("Location:index.php");//if no session id assigned redirect to main-page
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
    background-size: cover;
    background-image: url("images/background.jpg");
  }

  #topRow{
  	margin-top: 100px;
    text-align: center;
  }

  .center{
    text-align: center;
  }

  .alert{
  	display: none;
  	margin-top: 20px
  }


</style>


</head>
<body>

<!--==================================
=            NavgationBar            =
===================================-->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <div class="container">

      <div class="navbar-header pull-left">

        <a class="navbar-brand" href="/">Secret Diary</a>

        </button>

      </div><!-- /.navbar-header -->

      	<ul class="nav navbar-nav pull-right">
      		<li><a href="index.php?logout=1"><?php echo $email; ?>(Logout)</a></li>
      	</ul>

      </div><!-- /.navbar nav -->

    </div><!-- /.container-fluid -->

  </nav><!-- /.navbar navbar-default -->


<!--====  End of NavgationBar  ====-->

<!--===================================
=            Top Container            =
====================================-->
  <div class="container contentContainer" id="topContainer">

      <div class="row">

        <div class="col-md-10 col-md-offset-1 " id="topRow">
          <!-- echoing $diary if any existing diary entry-->
      		<textarea class="form-control" placeholder="Your Dairy Entry"><?php echo $diary; ?></textarea>

      		<div class="alert alert-success center">Auto-update successful!</div>   

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

  	$(".contentContainer").css("min-height", $(window).height());
    
    $("textarea").css("height", $(window).height()-200);

  //=========Auto updating script====================================

    //setup before functions
    var typingTimer;                //timer identifier
    var doneTypingInterval = 500;  //time in ms, 0.5 second for example
    var $input = $("textarea");

    //on keyup, start the countdown
    $input.on('keyup', function () {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    //on keydown, clear the countdown 
    $input.on('keydown', function () {
      clearTimeout(typingTimer);
    });

    //user is "finished typing," update database using ajax post method
    function doneTyping () {
        $.post("autoupdater.php", // this while will run query to update
          {
            entry : $("textarea").val()
          }, 
          function(data, success){
            if(data == ""){ 

              $(".alert").fadeIn();

              setTimeout(function() {
                    $(".alert").fadeOut();
                  }
                , 5000);
            }
          }
      );
    }

   //=========End Auto updating script==================================== 

  </script>
</body>
</html>
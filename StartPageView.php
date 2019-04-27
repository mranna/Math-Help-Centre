<?php
  if (!isset($_SERVER['HTTPS'])) {
    $url = 'https://' . $_SERVER['HTTP_HOST'] .
           $_SERVER['REQUEST_URI'];  // start with /...
    header("Location: " . $url);  // Redirect - 302
    exit;                         // should be before any output
  }                               // 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Math-Help for Kids</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<script>
	window.addEventListener('load', function() {
            document.getElementById('menu-signin').addEventListener('click', show_signin);
			document.getElementById('menu-join').addEventListener('click', show_join);
			document.getElementById('menu-forgot-password').addEventListener('click', show_forgotpassword);
		});
		function show_signin() {
            document.getElementById('signin').style.display = 'block';
			document.getElementById('join').style.display = 'none';
			document.getElementById('forgot-password').style.display = 'none';
			document.getElementById('unsubscribe').style.display = 'none';
        }
		function show_join() {
            document.getElementById('join').style.display = 'block';
			document.getElementById('signin').style.display = 'none';
			document.getElementById('forgot-password').style.display = 'none';
			document.getElementById('unsubscribe').style.display = 'none';
        }

        function show_forgotpassword() {
            document.getElementById('forgot-password').style.display = 'block';
			document.getElementById('signin').style.display = 'none';
			document.getElementById('join').style.display = 'none';
			document.getElementById('unsubscribe').style.display = 'none';
        }
		// check box 
		$(document).ready(function(){
		$('input:checkbox').click(function() {
        $('input:checkbox').not(this).prop('checked', false);
		});
	});

</script>
<style>
#text1{
	font-weight: 100;
	font-size: 3rem;
}

#text2{
	font-weight: 100;
	font-size: 3rem;

	}


input[type=text], input[type=password] {
 width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
	
}
#signin{
	text-align: center;
}
#join{
	text-align: center;
}
#forget-password{
	text-align: center;
}
#unsubscribe{
	text-align: center;
}



</style>
<body>
	<!--Heading-->
	<div class="container">
		<div class="row">
			<h1 style="text-align: center">LET'S REVISE MATH</h1>
		</div>	
	</div>

	<div id="navbar" class="collapse navbar-collapse">
    	<ul class="nav navbar-nav">
       	 <li class="active"><a id="" onclick="window.location='http://cs.tru.ca/~hanilw9/Week8/StartPageView.php';">Home</a></li>
       	 <li class="active"><a href="#text1">About Us</a></li>
   		</ul>   
   		 <ul class="nav navbar-nav navbar-right">
        	<li class="active"><a id="menu-unsubscribe" data-toggle='modal' data-target="#unsubscribe">Unsubscribe</a></li>
        	<li class="active"><a id="menu-forgot-password" data-toggle='modal' data-target="#forgot-password">ForgotPassword</a></li>
        	<li class="active"><a id="menu-join" data-toggle='modal' data-target="#join">Register</a></li>
        	<li class="active"><a id="menu-signin" data-toggle='modal' data-target="#signin">Login</a></li>
    	</ul>
	</div>

<div class="jumbotron">
  <h1 class="display-4" style="text-align: center;">Welcome to Math Help Centre for Kids</h1>
  <p class="lead" style="text-align: center">
  <img src="back-school-concept.jpg";
  </p>
</div>

<div class="row">
	<div class="col-lg-4">
		<div class="thumbnail">
			<img src="Student_jumping.jpg">
		</div>
	</div>
	<div id= "text1" class="col-lg-8">
		"BacktoSchool connects students in grades 5-9 with afterschool math tutoring. The best part is it’s free 
		and accessible to all BC students enrolled in English language publicly funded schools.
	All tutors are BC certified math teachers and they are here to help support your learner through 
math concepts and problems, from the simple to the complex. Grade 5-9 BC students can register in a few simple 
steps then they can use BacktoSchool Website in class, at home and anywhere in between.
	</div>
</div>
<div class="row">
	<div id= "text2" class="col-lg-4">
		Enjoy a wide range of free math games, interactive learning activities and fun educational resources that will
		engage students while they learn mathematics.
	</div>
	<div class="col-lg-8">
		<div class="thumbnail">
			<img src="children-counting-numbers-one-four_1308-3061.jpg">
		</div>
	</div>
</div>

<div class="modal fade" id='signin' role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<h2 style='text-align:center'>Sign In</h2>
					<br>
					<form id="siginform" method='post' action='Controller.php'>
						<input type='hidden' name='page' value='StartPage'></input>
						<input type='hidden' name='command' value='SignIn'></input>
						
						<input type='checkbox' name='usertype' value='student' checked='checked'> I am a Student
						
						<input type='checkbox' name='usertype' value='teacher'> I am a Teacher<br><br>
						<label class='modal-label'>Username</label> 
						<input type='text' name='username' placeholder='Enter username' required></input>
						<?php if (!empty($error_msg_username)) echo $error_msg_username; ?>
						<br>
						<br>
						<label class='modal-label'>Password</label> 
						<input type='password' name='password' placeholder='Enter password' required></input>
						<?php if (!empty($error_msg_password)) echo $error_msg_password; ?>
						<br>
						<br>
						<button type='submit' value='Submit' class="btn btn-default navbar-btn">Submit</button>
						<button type='reset' value='Reset' class="btn btn-default navbar-btn">Reset</button>
						<input type="button" name="cancel" class="btn btn-default navbar-btn" value="cancel" onClick="window.location='http://cs.tru.ca/~hanilw9/Week8/StartPageView.php';" />
						<br>
						<!--<p id="menu-unsubscribe"> Click here to Unsubscribe</p> -->
						<br>
					</form>
				</div>
			</div>
</div>

     <div class="modal fade" id='join' role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<h2 style='text-align:center'>Join</h2>
					<br>
					<form id = "joinform" method='post' action='Controller.php'>
						<input type='hidden' name='page' value='StartPage'></input>
						<input type='hidden' name='command' value='Join'></input>
						
						<input type='checkbox' name='usertype' value='student' checked='checked'> I am a Student
					
						<input type='checkbox' name='usertype' value='teacher'> I am a Teacher<br><br>
						<label class='modal-label'>Username</label> 
						<input type='text' name='username' placeholder='Enter username' required></input>
						<?php if (!empty($error_msg_username)) echo $error_msg_username; ?>
						<br>
						<label class='modal-label'>Password</label> 
						<input type='password' name='password' placeholder='Enter password' required></input>
						<?php if (!empty($error_msg_password)) echo $error_msg_password; ?>
						<br>
						<label class='modal-label'>Email</label> 
						<input id='emailholder' type='text' name='email' placeholder='Enter email address' required></input>
						<?php if (!empty($error_msg_email)) echo $error_msg_email; ?>
						<br>
						<button type='submit' value='Submit' class="btn btn-default navbar-btn">Submit</button>
						<button type='reset' value='Reset' class="btn btn-default navbar-btn">Reset</button>
						<input type="button" name="cancel" class="btn btn-default navbar-btn" value="cancel" onClick="window.location='http://cs.tru.ca/~hanilw9/Week8/StartPageView.php';" />
						<br>
						<br>
					</form>
				</div>
			</div>
		</div>
						
			<div class="modal fade" id='forgot-password' role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<h2 style='text-align:center'>Forgot Password</h2>
					<br>
					<form method='post' action='Controller.php'>
						<input type='hidden' name='page' value='StartPage'></input>
						<input type='hidden' name='command' value='ForgotPassword'></input>
					
						<input type='radio' name='usertype' value='student' checked='checked'> Student
				
						<input type='radio' name='usertype' value='teacher'> Teacher<br><br>
						<label class='modal-label'>Username:</label> 
						<input type='text' name='username' placeholder='Enter username' required></input>
						<?php if (!empty($error_msg_username)) echo $error_msg_username; ?>
						<br>
						<button type='submit' value='Submit' class="btn btn-default navbar-btn">Submit</button>
						<button type='reset' value='Reset' class="btn btn-default navbar-btn">Reset</button>
						<input type="button" name="cancel" class="btn btn-default navbar-btn" value="cancel" onClick="window.location='http://cs.tru.ca/~hanilw9/Week8/StartPageView.php';" />
						<br>
						<br>
					</form>
				</div>
			</div>
		</div>
		<div class="modal fade" id='unsubscribe' role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<h2 style='text-align:center'>Unsubscribe</h2>
					<br>
					<form method='post' action='Controller.php'>
						<input type='hidden' name='page' value='StartPage'></input>
						<input type='hidden' name='command' value='Unsubscribe'></input>
						&nbsp &nbsp &nbsp &nbsp
						<input type='radio' name='usertype' value='student' checked='checked'> Student
						&nbsp &nbsp
						<input type='radio' name='usertype' value='teacher'> Teacher<br><br>
						<label class='modal-label'>Username:</label> 
						<input type='text' name='username' placeholder='Enter username' required></input>
						<?php if (!empty($error_msg_username)) echo $error_msg_username; ?>
						<br>
						<label class='modal-label'>Password:</label> 
						<input type='password' name='password' placeholder='Enter password' required></input>
						<?php if (!empty($error_msg_password)) echo $error_msg_password; ?>
						<br>
						<br>
						<button type='submit' value='Submit' class="btn btn-default navbar-btn">Submit</button>
						<button type='reset' value='Reset' class="btn btn-default navbar-btn">Reset</button>
						<input type="button" name="cancel" class="btn btn-default navbar-btn" value="cancel" onClick="window.location='http://cs.tru.ca/~hanilw9/Week8/StartPageView.php';" />
						<br>
						<br>
					</form>
				</div>
			</div>
		</div>				
		

</body>
</html>>
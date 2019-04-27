<!DOCTYPE html>

<?php session_start(); ?>

<html>
<head>
    <title>Multiple Choice Done</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
    </style>
    
    <script>
        window.addEventListener('load', function() {
			document.getElementById('menu-multiple-choice').addEventListener('click', show_multiplechoice);
		});
		function show_multiplechoice() {
            document.getElementById('multiple-choice').style.display = 'block';
        }
		function show_grade() {
			document.getElementById('multiple-choice').style.display = 'none';
        }
    </script>
</head>

<body style="background-image:url(stud-back.jpg) ;background-repeat:no-repeat;   background-size: cover;">
    <div class='container'>
        <!-- Header -->
        <div class='row'>
            <div class='bg-primary'>
               <!-- <h1 style='text-align:center; padding-top: 10px;'>Result</h1> -->
            </div>
        </div>
        
        <div id='multiple-choice' class='col-md-10' style='display: block'>
			<form method='post' action='Controller.php'>
				<input type='hidden' name='page' value='MainPage'></input>
				<input type='hidden' name='command' value='MultipleChoice'></input>
				
				<!--  Add components here -->

			<header>
				<div class="container" style='border-bottom: 3px #f4f4f4 solid;'>
					<h1 style='text-align:center; color:white;'>Result</h1>
				</div>
			</header>
			<main style='padding-bottom:20px;'>
				<div class="container" style='width:60%; color:white;'>
					<h2> You're done!</h2>
						<p>Congrats! You have complete the test</p>
						<p>Final Score: 
						<?php echo $_SESSION['score']; 
						session_unset();
						session_destroy();?>
						</p>
						
						<a href="StudentMainPageView.php" 
						class="start" 
						style="display:inline-block; 
						color:#666; 
						background:#f4f4f4; 
						border:1px dotted #ccc; 
						padding:6px 13px;">To home page</a>
						
				</div>
			</main>
			<footer>
				<div class="container" style='border-top: 3px #f4f4f4 solid;'></div>
			</footer>
			</form>
		</div>

    </div>
</body>
</html>

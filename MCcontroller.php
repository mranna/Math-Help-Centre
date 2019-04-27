<!DOCTYPE html>

<?php include 'database.php'; ?>
<?php session_start(); ?>
<?php
	$conn = mysqli_connect('localhost', 'hanil', 'hanil', 'C354_hanil');
	//Set question number_format
	$number = (int) $_GET['n'];
	
	
	//select question from MCQTABLE
	
	$query = "SELECT * FROM MCQTable WHERE QuestionNo = $number";
	
	//Get result
	$result = mysqli_query($conn, $query);
	$question = mysqli_fetch_assoc($result);
	
	// calculate total
	$query1 = "SELECT * FROM MCQTable";
	$results = mysqli_query($conn, $query1);
	$total = mysqli_num_rows($results);
	
	/*
	*	Options from Table
	*/
	$query2 = "SELECT * FROM MCQOptions WHERE QuestionNo = $number";
	//Get results
	$choices = mysqli_query($conn, $query2);
	
?>


<html>
<head>
    <title>Quiz</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
	#text1{
		color: white;
	}
    </style>
    
    <script>
        window.addEventListener('load', function() {
			document.getElementById('menu-multiple-choice').addEventListener('click', show_multiplechoice);
		});
		function show_multiplechoice() {
            document.getElementById('multiple-choice').style.display = 'block';
        }
        //Time out for each question
        var remainingtime = 60;
        var questionTimer = setInterval(function(){
        	document.getElementById('countdown').innerHTML =remainingtime +" seconds remaining";
        	remainingtime -=1;
        	if (remainingtime <=0) {
        		clearInterval(questionTimer);
        		$('#clickbutton').click();
        	}
        },1000);
    </script>
</head>

<body style="background-image:url(stud-back.jpg) ;background-repeat:no-repeat;   background-size: cover;">
    <div class='container'>
        <!-- Header -->
		<div class="jumbotron">
		 <h1 style='text-align:center; padding-top: 10px;'>Math Help Online </h1>
       <h2 style='text-align:center; padding-top: 10px;'>Multiple Choice Quiz</h2>
        <hr>
		</div>
		 <div id="contentscolumn" class="container">
        <div class='row'>
            <div class='col-md-12 bg-info'>
                
            </div>
        </div>
		<div class='row'>
            <div class='col-md-12 bg-info'>
                <ul class="nav nav-pills nav-stacked">
                    <li><a id='signout'>Exit Quiz</a></li>
                </ul>
            </div>
		</div>	
		</div>	
	</div>
        
        <div class="container">
        	<div id="countdown" style="color: white"></div>	
        </div>
 <!--Multiple Choice *(To process)*************************************************************************************************************************************************** -->
        <div id='multiple-choice' class='col-md-10' style='display: block'>
			<br>
			<form method='post' action='process.php'>
				<input type='hidden' name='page' value='MainPage'>
				<input type='hidden' name='command' value='MultipleChoice'>
				
				<!--  Add components here -->
			
			<main style='padding-bottom:20px;'>
				<div id="text1" class="container" style='width:50%;'>
					<div  class="current" style="
					padding: 10px;
					
					border: #ccc dotted 1px
					margin: 20px 0 10px 0;">Question <?php echo $question['QuestionNo']; ?> of <?php echo $total; ?></div>
					<p class="question"> 
						<?php echo $question['Questioninput'] ?>
					</p>
					
					<form method="post" action="process.php">
	<!-- 	CHOICE -> radio button - while loops for option  -->
						<ul class="choices">
							<?php while($row = mysqli_fetch_assoc($choices)):  ?>
								<li style="list-style: none;"><input name="choice" type="radio" value="<?php echo $row['QuestionId'] ?>" /><?php echo $row['text']?></li>
							<?php endwhile ?>
						</ul>

						
						<input id='clickbutton' type="submit" class="btn btn-primary" value="submit"/>
						<input type="hidden" class="btn btn-primary" name="number" value="<?php echo $number; ?>" />
					</form>
				</div>
			</main>
			</form>	
			
		</div>
<!--*********************************************************************************************************************************************************************************************** -->		
		<form id='form-signout' method='post' action='Controller.php' style='display:none'>
            <input type='hidden' name='page' value='MainPage'>
            <input type='hidden' name='command' value='SignOut'>
        </form>
        <script>
            // When the 'SignOut' button is clicked
            document.getElementById('signout').addEventListener('click', function() {
                document.getElementById('form-signout').submit();
            });
        </script>
    </body>

</html>

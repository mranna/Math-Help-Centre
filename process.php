<?php include 'database.php'; ?>
<?php session_start(); ?>
<?php
	$conn = mysqli_connect('localhost', 'hanil', 'hanil', 'C354_hanil');
	//Check to see if score is set_error_handler
	if(!isset($_SESSION['score'])){
		$_SESSION['score']=0;
	}
	
	if($_POST){
		$number = $_POST['number'];
		$selected_choice = $_POST['choice'];	
		$next = $number+1;
		
		/*Get total */
		$query1 = "SELECT * FROM MCQTable";
		$results = mysqli_query($conn, $query1);
		$total = mysqli_num_rows($results);

		$username = $_SESSION['username'];
		
		
		/*Get correct choice */
		$query2 = "SELECT * FROM MCQOptions WHERE QuestionNo = $number AND TrueChoice = 1";
		/*Get result*/
		$result = mysqli_query($conn, $query2);
		$row = mysqli_fetch_assoc($result);
		
		/*Set correct choice*/
		$correct_choice = $row['QuestionId'];
		
		//Compare
		if($correct_choice == $selected_choice){
				$_SESSION['score']++;
		}
		
		if($number == $total){
			header("Location: final.php");
			exit();
		}else{
			header("Location: MCcontroller.php?n=".$next);
		
		}

	}
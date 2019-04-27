<?php include 'database.php'; ?>
<?php
	$conn = mysqli_connect('localhost', 'hanil', 'hanil', 'C354_hanil');

	if(isset($_POST['model-submit'])){
		$questionnumber  = $_POST['questionnumber'];
		$questioninput = $_POST['questioninput'];
		$key_value = $_POST['key_value'];

		$options = array();
		$options[1] = $_POST['optionA'];
		$options[2] = $_POST['optionB'];
		$options[3] = $_POST['optionC'];
		$options[4] = $_POST['optionD'];

		// Inserting MCQ into TABLE MCQTable
		$query = "INSERT into MCQTable (QuestionNo,Questioninput)values ('$questionnumber','$questioninput')";
		$insert_row = mysqli_query($conn, $query);
		if ($insert_row) {
			foreach ($options as $option => $value) {
				if ($value !='') {
					if ($key_value == $option) {
						// Set to Truechoice to 1
						$TrueChoice = 1;
				}
				else{
					$TrueChoice = 0;
				}
				// Inserting Options into MCQOptions 
				$query = "INSERT into MCQOptions(QuestionNo,TrueChoice, text) values ('$questionnumber','$TrueChoice','$value')";
				$insert_row = mysqli_query($conn,$query);

				if ($insert_row) {
					# code...
					continue;
				}else{
					# code...

				}
			}
		}
		$msg = "Question has been added";
	}
}

$query2 = "SELECT * from MCQTable";
$questions = mysqli_query($conn,$query2);
$total = mysqli_num_rows($questions);
$qn = $total+1;

?>

<html>
<head>
	<title>TeacherMainPage</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>	
    	
		#content{
			position-align:center;
    	}
		
</style>
<script>
	window.addEventListener('load',function(){
		document.getElementById('create-quiz').addEventListener('click',showcreatequiz);
		document.getElementById('delete-questions').addEventListener('click',deletequestion);
	});
	function showcreatequiz(){
		document.getElementById('createquiz').style.display ='block';
		document.getElementById('deletequestion').style.display='none';
	}
	function deletequestion(){
		document.getElementById('deletequestion').style.display='block';
		document.getElementById('createquiz').style.display='none';
	


	}
	 
</script>
<body style="background-image:url(young-teacher.jpg) ;background-repeat:no-repeat;   background-size: cover;">
<div class="container">
		<div class="row">
			<h1 style="text-align: center"></h1>
		</div>	
	</div>
	<div class="container">
		<div class="jumbotron">
		 <h1 style='text-align:center'>Math Help Online </h1>
        <!-- Welcome ...! --> <!-- the username should be echoed from the php tag. -->
        <h2 style='text-align:center'>Welcome </h2>
        <hr>
		</div>
        <div id="contentscolumn" class="container">
		<div class="row">
			<div class="col-md-12 bg-info">
				<ul class="nav nav-pills nav-stacked">
					<li><a id="displaystudents" data-toggle='modal' data-target ='#display_students'>Display Students</a></li>
					<li><a id="add-grades" data-toggle='modal' data-target ='#addgrades'>Add grades</a></li>	
					<li><a id="create-quiz" data-toggle='modal' data-target ='#createquiz'>Create a Quiz</a></li>
					<li><a id="delete-questions" data-toggle='modal' data-target ='#deletequestion'>Delete question </a></li>
					<li><a id="menu-review"data-toggle='modal' data-target ='#viewquestions'>View Questions</a></li>				
					<li><a id="review-students" data-toggle='modal' data-target ='#checkstudentmessage'>Check Messages from Students</a></li>
				

					<li><a id="signout">Sign out</a></li>
    			</ul>
			</div>
		</div>
		<div class="row">
				<div class='col-md-12 bg-success' >
                <div id='content'>
                </div>
			</div>
	
			</div>
			</div>
</div>


<!-- Create a Quiz and Add Question ***********************************************************************************************-->             
<div class="modal fade" id="createquiz" role = "dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="TeacherMainPage.php">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"></button>
					<h2> Add a question to the Quiz</h2>
				</div>
				<div class="modal-body">
					<br>
					<p>
					<label style="display:inline-block;width: 180px;">
						Question Number: 
					</label>
					<input type="Number" name="questionnumber" value="<?php echo $qn; ?>"/>
					</p>
					<p>
						<label style="display:inline-block;width: 180px;">
						Enter the Question.: </label>
						<input type="text" name="questioninput"/>
					</p>
					<p>
						<label style="display:inline-block;width: 180px;">
						Enter the Option A.: </label>
						<input type="text" name="optionA"/>
					</p>
					<p>
						<label style="display:inline-block;width: 180px;">
						Enter the Option B.: </label>
						<input type="text" name="optionB"/>
					</p>
					<p>
						<label style="display:inline-block;width: 180px;">
						Enter the Option C.: </label>
						<input type="text" name="optionC"/>
					</p>
					<p>
						<label style="display:inline-block;width: 180px;">
						Enter the Option D.: </label>
						<input type="text" name="optionD"/>
					</p>
					<p>
						<label style="display:inline-block;width: 180px;">
						Select the right option(#): </label>
						<input type="text" name="key_value"/>
					</p>
				</div>
					<div class="modal-footer">
						<button type="cancel" class="btn btn-primary" data-dismiss='modal'>Cancel</button>
						<button name="model-submit" class="btn btn-primary" type ='submit'value="Submit">Submit</button>
					</div>

			</form>
		</div>
	</div>
</div>

	<!-- Deleting Questions *********************************************************************************************************************************-->

<div class="modal fade" id="deletequestion" role = "dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="TeacherMainPage.php">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"></button>
					<h2> Total Questions</h2>
				</div>
				<div class="modal-body">
					<br>
					<p>
					<label style="display:inline-block;width: 180px;">
						Question Number: 
					</label>
					<input id="delquestionno" type="Number" name="questionnumber" placeholder="Enter Question No to be deleted" style="width: 300px;" />
					</p>
					<!-- <p>
						<label style="display:inline-block;width: 180px;">
						Enter the Question: </label>
						<input type="text" name="questioninput"/>
					</p> -->
				</div>
					<div class="modal-footer">
						<button type="cancel" class="btn btn-primary" data-dismiss='modal' >Cancel</button>
						<button id='model-dsubmit' type="button" class="btn btn-primary">Submit</button> 
					</div>

			</form>
		</div>
	</div>
</div>	
<script>
	$('#model-dsubmit').click(function()
	{
		$('#deletequestion').modal('hide');

		var url ="Controller.php";
		var query = { page:"TeacherMainPage", command:"DeleteQuestion",
		delquestion_no: $('#delquestionno').val()};

		$.post(url,query, function(data){
			$('#content').html(data);

		});
						
           
	});

</script>

<!-- Enter Grades and Feedback with Student id ******************************************************************************************************************************-->
<div class="modal fade" id="addgrades" role = "dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id='form-grade-students'>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"></button>
					<h2> Click the button to display all students</h2>
					
				</div>
				<div class="modal-body">
					<br>
					<p>
					<label style="display:inline-block;width: 180px;">
						UserId: 
					</label>
					<input id ="gradestudentid" type="Number" name="user_id"/>
					</p>
					<p>
						<label style="display:inline-block;width: 180px;">
						Enter the Grade: </label>
						<input id ="studentmark"type="Number" name="marks"/>
					</p>
					<p>
					<label style="display: inline-block; width: 180px;" for='input-post-question'>Feedback to the learner: </label>
                    <input id='input-post-question' class='form-control' type='text' autofocus required>
					</p>
				</div>
				<div class="modal-footer">
						<button type="cancel" class="btn btn-primary" data-dismiss='modal' >Cancel</button>
						<button id='grade-student' type="button" class="btn btn-primary">Submit</button> 
					</div>
				
			</form>
		</div>
	</div>

</div>
<!-- Post Grades with Student id ******************************************************************************************************************************-->

<div class="modal fade" id="addgrades" role = "dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id='form-grade-students'>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"></button>
					<h2> Click the button to display all students</h2>
					
				</div>
				<div class="modal-body">
					<br>
					<p>
					<label style="display:inline-block;width: 180px;">
						UserId: 
					</label>
					<input id ="gradestudentid" type="Number" name="user_id"/>
					</p>
					<p>
						<label style="display:inline-block;width: 180px;">
						Enter the Grade: </label>
						<input id ="studentmark"type="Number" name="marks"/>
					</p>
					<p>
					<label style="display: inline-block; width: 180px;" for='input-post-question'>Feedback to the learner: </label>
                    <input id='input-post-question' class='form-control' type='text' autofocus required>
					</p>
				</div>
				<div class="modal-footer">
						<button type="cancel" class="btn btn-primary" data-dismiss='modal' >Cancel</button>
						<button id='grade-student' type="button" class="btn btn-primary">Submit</button> 
					</div>
				
			</form>
		</div>
	</div>

</div>
<script>
	$('#grade-student').click(function()
	{
		$('#addgrades').modal('hide');

		var url ="Controller.php";
		var query = { page:"TeacherMainPage", command:"PostGrade",
		user_id: $('#gradestudentid').val() , marks: $('#studentmark').val() ,Comments: $('#input-post-question').val()};

		$.post(url,query, function(data){
			$('#content').html(data);

		});
						
           
	});

</script>
<!-- ******************************************************************************************************************************************************-->
<div class="modal fade" id="checkstudentmessage" role = "dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id='form-question-students'>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"></button>
					<h2> Messages From Students</h2>
				</div>
				<div class="modal-footer">
					<button id='checkmessages' type="button" class="btn btn-primary">Search Messages</button> 
				</div>
				
			</form>
		</div>
	</div>

</div>	
<script>
	$('#checkmessages').click(function()
	{
		$('#checkstudentmessage').modal('hide');

		var url ="Controller.php";
		var query = { page:"TeacherMainPage", command:"CheckMessages"};

		$.post(url,query,function(data){
						var obj = JSON.parse(data);
                        var t = '<table class="table table-condensed">';
                        t += '<tr>';
                        for(var a in obj[0]){
                            t += '<th>' + a + "</th>";
                        }
                        t += '</tr>';
                        //content
                        for(var i =0; i< obj.length; i++){
                            t += '<tr>';
                            for( p in obj[i]){
                               t +='<td>' + obj[i][p] + '</td>';
                            }
                            t  += '</tr>';
                        }
                        t += '</table>';
                        $('#content').html(t);

		});
	});

</script>


<!-- View All Students on the page*****************************************************************************************************************************-->
<div class="modal fade" id="display_students" role = "dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id='form-list-students'>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"></button>
					<h2> Current Enrollment</h2>
				</div>
				<div class="modal-body">
					 <label for='input-student-id'>Insert Student ID:</label>
                     <input id='input-student-id' class='form-control' type='Number' autofocus required>
				</div>
				<div class="modal-footer">
					<button id='submit-a-student' type="button" class="btn btn-primary">Search a Student</button> 
					<button id='submit-list-students' type="button" class="btn btn-primary">List all Students</button> 
				</div>
				
			</form>
		</div>
	</div>

</div>	
<script>
	$('#submit-a-student').click(function()
	{
		$('#display_students').modal('hide');

		var url ="Controller.php";
		var query = { page:"TeacherMainPage", command:"ListAStudent" ,Studentid: $('#input-student-id').val()};

		$.post(url,query,function(data){
						var obj = JSON.parse(data);
                        var t = '<table class="table table-condensed">';
                        t += '<tr>';
                        for(var a in obj[0]){
                            t += '<th>' + a + "</th>";
                        }
                        t += '</tr>';
                        //content
                        for(var i =0; i< obj.length; i++){
                            t += '<tr>';
                            for( p in obj[i]){
                               t +='<td>' + obj[i][p] + '</td>';
                            }
                            t  += '</tr>';
                        }
                        t += '</table>';
                        $('#content').html(t);

		});
	});

</script>
<script>
	$('#submit-list-students').click(function()
	{
		$('#display_students').modal('hide');

		var url ="Controller.php";
		var query = { page:"TeacherMainPage", command:"ListUsers"};

		$.post(url,query,function(data){
						var obj = JSON.parse(data);
                        var t = '<table class="table table-condensed">';
                        t += '<tr>';
                        for(var a in obj[0]){
                            t += '<th>' + a + "</th>";
                        }
                        t += '</tr>';
                        //content
                        for(var i =0; i< obj.length; i++){
                            t += '<tr>';
                            for( p in obj[i]){
                               t +='<td>' + obj[i][p] + '</td>';
                            }
                            t  += '</tr>';
                        }
                        t += '</table>';
                        $('#content').html(t);

		});
	});

</script>



<!-- View all/the selected question on page*****************************************************************************************************************-->
<div class="modal fade" id="viewquestions" role = "dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id='form-list-questions'>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"></button>
					<h2> View a Question</h2>
					  <div class='modal-body'>  <!-- modal body -->
                            <label for='input-list-questions'>Insert Question Number:</label>
                            <input id='input-list-questions' class='form-control' type='Number' autofocus required>
                        </div>
					<button id='submit-list-questions' type="button" class="btn btn-primary">Search a question</button> 
					<button id='submit-all-questions' type="button" class="btn btn-primary">List all Questions</button>
				</div>
				
			</form>
		</div>
	</div>

</div>	
<script>
 // SELECT A QUESTION	*******************************************************************************************************************************************
$('#submit-list-questions').click(function() 
			{
				$('#viewquestions').modal('hide');
                var url = "Controller.php";  // controller
                var query = { page:"TeacherMainPage", command:"ListQuestions",
                                QuestionNo: $('#input-list-questions').val()};  // read the search term from the input element

                $.post(url,
                    query,
                    function(data) {
                        // Need to display it in a table in <div id='content'>
                        var obj = JSON.parse(data);
                        var t = '<table class="table table-condensed">';
                        t += '<tr>';
                        for(var a in obj[0]){
                            t += '<th>' + a + "</th>";
                        }
                        t += '</tr>';
                        //content
                        for(var i =0; i< obj.length; i++){
                            t += '<tr>';
                            for( p in obj[i]){
                               t +='<td>' + obj[i][p] + '</td>';
                            }
                            t  += '</tr>';
                        }
                        t += '</table>';
                        $('#content').html(t);
                });
            });

</script>
<!-- LIST ALL QUESTIONS ******************************************************************************************************************************************* -->
<script>
$('#submit-all-questions').click(function() 
			{
				$('#viewquestions').modal('hide');
                var url = "Controller.php";  // controller
                var query = { page:"TeacherMainPage", command:"Listallquestion"};  // read the search term from the input element

                $.post(url,
                    query,
                    function(data) {
                        // Need to display it in a table in <div id='content'>
                        var obj = JSON.parse(data);
                        var t = '<table class="table table-condensed">';
                        t += '<tr>';
                        for(var a in obj[0]){
                            t += '<th>' + a + "</th>";
                        }
                        t += '</tr>';
                        //content
                        for(var i =0; i< obj.length; i++){
                            t += '<tr>';
                            for( p in obj[i]){
                               t +='<td>' + obj[i][p] + '</td>';
                            }
                            t  += '</tr>';
                        }
                        t += '</table>';
                        $('#content').html(t);
                });
            });

</script>
<!-- Post Question/ Remarks *******************************************************************************************************************************************-->
<!--

<div class="modal fade" id="postquestion" role = "dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id='form-post-question'>

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Post a Question</h4>

				</div>
				
				<div class="modal-body">
					<br>
					<p>
					<label for='input-post-question'>Question:</label>
                    <input id='input-post-question' class='form-control' type='text' autofocus required>
					</p>
				</div>
					<div class='modal-footer'>  <!-- modal footer 
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button id='submit-post-question' type="button" class="btn btn-primary">Submit</button>  <!-- not data-dismiss='modal' 
                        </div>


			</form>
		</div>
	</div>

</div>	

<script>
	$('#submit-post-question').click(function() 
            {
                $('#postquestion').modal('hide');
                
                // Send then'PostQuestion' command using jQuery AJAX
                
                var url = 'Controller.php';  // controller
                var query = { page:"TeacherMainPage", command:"PostQuestion",
                                Comments: $('#input-post-question').val()};  // read the question from the input element

                $.post(url,
                    query,
                    function(data) {
                        $('#content').html(data);  // Need to display it in <div id='content'>
                });
            });


</script>
***********************************************************************************************************************************************-->


		<form id="form-signout" method="post" action="Controller.php">
			<input type="hidden" name="page" value="TeacherMainPage">
			<input type="hidden" name="command" value="SignOut">
		</form>
		<script>
			document.getElementById('signout').addEventListener('click', function(){
				document.getElementById('form-signout').submit();
			});
		</script> 




</body>

</html>
	
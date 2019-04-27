<?php include 'database.php'; ?>

<?php
	$conn = mysqli_connect('localhost','hanil','hanil','C354_hanil');
	$query = "select * from MCQTable";
	$result = mysqli_query($conn, $query);
	$total = mysqli_num_rows($result);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Main Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>	
    
    	#content{
			position-align:center;
    	}
    </style>
    <script>
    	window.addEventListener('load', function(){
    		document.getElementById('student-start-quiz').addEventListener('click',show_starttest);
    		document.getElementById('Start-test').addEventListener('click',show_test);
    	})
    	function show_starttest(){
    		document.getElementById('Start-test').style.display='block';
    		// document.getElementById('multiple-choice').style.display='none';
    		// document.getElementById('grade').style.display ='none';
    	}
    	function show_test(){
    		document.getElementById('multiple-choice').style.display='block';
    		document.getElementById('Start-test').style.display ='none';
    	}


    </script>
</head>
<body style="background-image:url(stud-back.jpg) ;background-repeat:no-repeat;   background-size: cover;">
<div class="container">
		<div class="row">
			<h1 style="text-align: center"></h1>
		</div>	
	</div>
	<div class="container">
		<div class="jumbotron">
		 <h1 style='text-align:center'>Math Help Online </h1>
        <h2 style='text-align:center'>Welcome</h2>
        <hr>
		</div>
        <div id="contentscolumn" class="container">
		<div class="row">
			<div class="col-md-12 bg-info">
				<ul class="nav nav-pills nav-stacked">
					<li><a id="details-instructor" data-toggle='modal' data-target ='#teacherdetails'>Check Instructor Directory </a></li>
					<li><a id="message-instructor" data-toggle='modal' data-target ='#postquestion'>Message Instructor </a></li>
					<li><a id="student-start-quiz">Take a Quiz</a></li>
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

<!-- Start Quiz ****************************************************************************************************************************************************-->	
	<div id ='Start-test' class="col-md-12" style ='display:none;'>
		<main style='padding-bottom:20px;'>
			<div class="container" style='width:80%;'>
				<h2 style='text-align:center; color:white;'>Multiple Choice Quiz</h2>
				<h2 style="color: white; text-align: center;">Attention Students there is a 1min Timer for each question. Failure to attempt the question will automatically result in Zero.</h2>
					<ul>
						<li style='color:white; text-align:center; font-size: 25spx;'> Number of questions: <?php echo $total ?></li>
					</ul>
					<a href="MCcontroller.php?n=1" class="start" style="display:inline-block;text-align:center;color:#666; 
						background:#f4f4f4; border:1px  #ccc; padding:6px 13px; ">Start Quiz</a>
			</div>
			</main>
			</div>

<!--Post Question to Teacher (Teacher id and Comments )**************************************************************************************************************** -->			
<div class="modal fade" id="postquestion" role = "dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id='form-grade-students'>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"></button>
					<h2> Have a question? Ask Kiddo</h2>
					
				</div>
				<div class="modal-body">
					<br>
					<p>
					<label style="display:inline-block;width: 180px;">
						Enter teacher name: 
					</label>
					<input id ="teacherid" type="text" name="username"/>
					</p>
					<p>
					<label style="display: inline-block; width: 180px;" for='input-post-question'>Enter the Message here: </label>
                    <input id='input-student-question' class='form-control' type='text' autofocus required>
					</p>
				</div>
				<div class="modal-footer">
						<button type="cancel" class="btn btn-primary" data-dismiss='modal' >Cancel</button>
						<button id='message-student' type="button" class="btn btn-primary">Submit</button> 
					</div>
				
			</form>
		</div>
	</div>
</div>

<script>
	$('#message-student').click(function()
	{
		$('#postquestion').modal('hide');

		var url ="Controller.php";
		var query = { page:"MainPage", command:"MessageTeacher",
		user_name: $('#teacherid').val() ,Comments: $('#input-student-question').val()};

		$.post(url,query, function(data){
			$('#content').html(data);

		});
						
           
	});

</script>
<!-- **********************************************************************************************************************************************************************************-->			
<div class="modal fade" id="teacherdetails" role = "dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id='form-search-teacher'>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"></button>
					<h2> Search for a teacher</h2>
					
				</div>
				<div class="modal-body">
					<br>
					<p>
					<label style="display:inline-block;width: 180px;">
						Enter teacher name: 
					</label>
					<input id ="teachername" type="text" name="username"/>
					</p>
				</div>
				<div class="modal-footer">
						<button id='search-all-teacher' type="button" class="btn btn-primary">Search All</button> 
						<button id='search-teacher' type="button" class="btn btn-primary">Search</button> 
					</div>
				
			</form>
		</div>
	</div>
</div>
<script>
	$('#search-teacher').click(function()
	{
		$('#teacherdetails').modal('hide');

		var url ="Controller.php";
		var query = { page:"MainPage", command:"SearchTeacher",
		user_name: $('#teachername').val()};

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
	$('#search-all-teacher').click(function()
	{
		$('#teacherdetails').modal('hide');

		var url ="Controller.php";
		var query = { page:"MainPage", command:"SearchAllTeacher"};

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

		<form id="form-signout" method="post" action="Controller.php">
			<input type="hidden" name="page" value="MainPage"/>
			<input type="hidden" name="command" value="SignOut"/>
		</form>
		<script>
			document.getElementById('signout').addEventListener('click', function(){
				document.getElementById('form-signout').submit();
			});
		</script> 
			
	


</body>
</html>
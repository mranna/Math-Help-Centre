<?php
$conn = mysqli_connect('localhost','hanil','hanil','C354_hanil');

function insert_new_students($username,$password,$email){
	global $conn;

	if (does_exist_student($username))
		return false;
	else{
		$hash_password = sha1($password);
		$sql = "insert into Members values (NULL, 1,'$username','$hash_password','$email','$password')";
		$result = mysqli_query($conn, $sql);
		return $result;
	}
}

function insert_new_teacher($username,$password,$email){
	global $conn;

	if (does_exist_teacher($username))
		return false;
	else{
		$hash_password = sha1($password);
		$sql = "insert into Members values (NULL, 0,'$username','$hash_password','$email','$password')";
		$result = mysqli_query($conn, $sql);
		return $result;
	}
}
function is_valid_student ($username, $password){
	global $conn;
	$hash_password = sha1($password);
	$sql = "select * from Members where (Username = '$username' and Password = '$hash_password' and UserType =1)";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result)>0) 
		return true;
	else
		return false;
}

function is_valid_teacher ($username, $password){
	global $conn;
	$hash_password = sha1($password);
	$sql = "select * from Members where (Username = '$username' and Password = '$hash_password'and UserType =0)";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result)>0) 
		return true;
	else
		return false;
}

function does_exist_student ($username)
{
	global $conn;
	$sql = "select * from Members where (Username = '$username')";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result)>0) 
		return true;
	else
		return false;
}

function does_exist_teacher ($username)
{
	global $conn;
	$sql = "select * from Members where (Username = '$username')";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result)>0) 
		return true;
	else
		return false;
}
function list_questions($questionNo)
{
    global $conn;
       
       
        $sql = "select *  from MCQTable where (QuestionNo = '$questionNo')";
        $result = mysqli_query($conn, $sql);
        $data = array();  // empty array
        $i = 0;
        while($row = mysqli_fetch_assoc($result))  // fetch a row
            $data[$i++] = $row;  // include the row into the array
        echo json_encode($data);
      
		}
function list_all_questions()
{
	global $conn;
	 $sql = "select *  from MCQTable";
        $result = mysqli_query($conn, $sql);
         $data = array();  // empty array
        $i = 0;
        while($row = mysqli_fetch_assoc($result))  // fetch a row
            $data[$i++] = $row;  // include the row into the array
        echo json_encode($data);
}
function list_a_student($u){

	global $conn;
	$sql = "select UserID,Username,Email from Members where UserID ='$u' AND UserType = 1";
	$result = mysqli_query($conn, $sql);
	 $data = array();  // empty array
        $i = 0;
        while($row = mysqli_fetch_assoc($result))  // fetch a row
            $data[$i++] = $row;  // include the row into the array
        echo json_encode($data);

}

function list_users()
{
    global $conn;
       
        $sql = "select UserID,Username,Email  from Members where (UserType = 1)";
        $result = mysqli_query($conn, $sql);
        $data = array();  // empty array
        $i = 0;
        while($row = mysqli_fetch_assoc($result))  // fetch a row
            $data[$i++] = $row;  // include the row into the array
        echo json_encode($data);
      
		}
function get_password_student($username)
{
    global $conn;
    
	
    $sql = ("select Repass from Members where (Username = '$username' AND UserType =1)");
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Repass'];
    }
    else
        return -1;
}

function get_password_teacher($username)
{
    global $conn;
    
    $sql = "select Repass from Members where (Username = '$username' AND UserType = 0)";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['Repass'];
    }
    else
        return -1;
}

function delete_student($username, $password){
	global $conn;
	$hash_password = sha1($password);
	$sql = "DELETE FROM Members WHERE (Username = '$username' and Password = '$hash_password')";
	$result = mysqli_query($conn, $sql);

}

function delete_teacher($username, $password){
	global $conn;
	$hash_password = sha1($password);
	$sql = "DELETE FROM Members WHERE (Username = '$username' and Password = '$hash_password')";
	$result = mysqli_query($conn, $sql);

}
function delete_question($questionnumber){
	global $conn;
	$sql = "DELETE  FROM MCQTable where (QuestionNo ='$questionnumber')";
	$result = mysqli_query($conn, $sql);
	$sql = "DELETE  FROM MCQOptions where (QuestionNo ='$questionnumber')";
	$result = mysqli_query($conn, $sql);

}
function post_question($u, $q)  // question, username
{

	global $conn;
 	$sql = "SELECT * from Members where (Username = '$u')";
 	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $uid = $row['UserID'];  // The column that include user ids 
    }
    else {
        echo "Posting a comment failed!";
        return;
    }

	$sql = "INSERT INTO Grades (gradeid, UserID, marks, Comments) VALUES (null,'$uid',null,'$q',NULL)";
	mysqli_query($conn, $sql);
    return true;

}

function post_grade($u, $m, $c)
{
	global $conn;
	$sql = "SELECT * FROM Members where (UserID = '$u')";
	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $uid = $row['UserID'];  // The column that include user ids 
        
    }
    else {
        echo "Posting a grade failed!";
        return;
    }

    //echo "Before inserting";
	$sql = "INSERT INTO Grades VALUES (NULL,'$uid','$m','$c',NULL)";
	$result = mysqli_query($conn, $sql);
	//echo "After inserting";
	return true;

}

function list_grade($u){
	
	global $conn;
	$sql = "SELECT * FROM Members where (Username = '$u')";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)>0)
	{
		$row = mysqli_fetch_assoc($result);
		$uid = $row['UserID'];
	}
	else{
		echo "Posting a comment failed!";
		return;
	}
	$sql = "SELECT marks FROM Grades WHERE (UserID = '$uid')";
	mysqli_query($conn,$sql);
	return true;
}

function chat_professor($c,$teacher,$student){
	global $conn;
	$sql = "SELECT * FROM Members where (Username = '$student')";
	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $uid = $row['UserID'];  // The column that include user ids 
        
    }
    else{
		echo "Posting a Message failed!";
		return;
	}
    $sql = "INSERT into Grades VALUES (NULL,'$uid',NULL,'$c','$teacher')";
    mysqli_query($conn,$sql);
	return true;

}
function checkMessage($teacher){

	global $conn;

	$sql = "SELECT g.UserID,m.Username, g.Comments FROM Grades g JOIN Members m ON m.Username =g.Username AND g.Username ='$teacher'";
	$result =mysqli_query($conn,$sql);
	 $data = array();  // empty array
        $i = 0;
        while($row = mysqli_fetch_assoc($result))  // fetch a row
            $data[$i++] = $row;  // include the row into the array
        echo json_encode($data);
}
function search_teacher($teacher){

	global $conn;
       
       	$sql = "select Username,Email from Members where Username ='$teacher' AND UserType = 0";
        $result = mysqli_query($conn, $sql);
        $data = array();  // empty array
        $i = 0;
        while($row = mysqli_fetch_assoc($result))  // fetch a row
            $data[$i++] = $row;  // include the row into the array
        echo json_encode($data);
	
}
function search_all_teacher(){

	global $conn;
       
       	$sql = "select Username,Email from Members where UserType = 0";
        $result = mysqli_query($conn, $sql);
        $data = array();  // empty array
        $i = 0;
        while($row = mysqli_fetch_assoc($result))  // fetch a row
            $data[$i++] = $row;  // include the row into the array
        echo json_encode($data);
	
}
?>
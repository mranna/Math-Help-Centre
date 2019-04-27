<?php
if (empty($_POST['page'])){
	$display_type = 'no-signin';

	include('StartPageView.php');
	exit();
}

require('model.php');

if($_POST['page']=='StartPage')
{
	$command = $_POST['command'];
	switch ($command) {
		case 'SignIn':  // With username and password
            $checkboxVal = $_POST['usertype'];
            if ($checkboxVal == 'student')
            {
//                if (there is an error in username and password of student) {
                if (!is_valid_student($_POST['username'], $_POST['password'])) {
                     $error_msg_username = '* Wrong username, or';
                     $error_msg_password = '* Wrong password'; // Set an error message into a variable.
                                                             // This variable will used in the form in 'view_startpage.php'.
                     $display_type = 'signin';  // It will display the start page with the SignIn box.
                                                // This variable will be used in 'view_startpage.php'.
                     include('StartPageView.php');
                 }
                 else {
                     // Set a cookie for the welcome message in StartPage
                     setcookie('username', $_POST['username'], time() + 3600);
        
                     // Set a session variable for the username
                     session_start();
                     $_SESSION['signedin'] = 'YES';
                     $_SESSION['username'] = $_POST['username'];
					include ('StudentMainPageView.php');
                 }
            } else if ($checkboxVal == 'teacher')
            {
//                if (there is an error in username and password of teacher) {
                 if (!is_valid_teacher($_POST['username'], $_POST['password'])) {
                     $error_msg_username = '* Wrong username, or';
                     $error_msg_password = '* Wrong password'; // Set an error message into a variable.
                                                             // This variable will used in the form in 'view_startpage.php'.
                     $display_type = 'signin';  // It will display the start page with the SignIn box.
                                                // This variable will be used in 'view_startpage.php'.
                     include('StartPageView.php');
                 }
                 else {
                     // Set a cookie for the welcome message in StartPage
                     setcookie('username', $_POST['username'], time() + 3600);
    
                     // Set a session variable for the username
                     session_start();
                     $_SESSION['signedin'] = 'YES';
                     $_SESSION['username'] = $_POST['username'];
					 $test = $_POST['username'];
					include ('TeacherMainPage.php');
                 }
            }
            exit();
		case 'Join':  // With username, password, email, some other information
			$checkboxVal = $_POST['usertype'];
			if ($checkboxVal == 'student'){
			 if (does_exist_student($_POST['username'])) {
                 $error_msg_username = '* The user exists.';
                 $display_type = 'join';
                 include('StartPageView.php');
             } else {
                 if (insert_new_students($_POST['username'], $_POST['password'], $_POST['email'])) {
                     $display_type = 'signin';
                     include('StartPageView.php');
                 } else {
                     $error_msg_username = '* Insertion error';
                     $display_type = 'join';
                    include('StartPageView.php');
                 }
             }
            } else if ($checkboxVal == 'teacher'){
				if (does_exist_teacher($_POST['username'])) {
                 $error_msg_username = '* The user exists.';
                 $display_type = 'join';
                 include('StartPageView.php');
             } else {
                 if (insert_new_teacher($_POST['username'], $_POST['password'], $_POST['email'])) {
                     $display_type = 'signin';
                     include('StartPageView.php');
                 } else {
                     $error_msg_username = '* Insertion error';
                     $display_type = 'join';
                    include('StartPageView.php');
                 }
             }
			}
			exit();
		case 'ForgotPassword':
            $checkboxVal = $_POST['usertype'];
            if ($checkboxVal == 'student'){
                if (does_exist_student($_POST['username'])) {
                    $r = get_password_student($_POST['username']);
                    $str = json_encode($r);
                    echo "Your password is  ". $str;
                } else {
                    echo "Username does not exist";
                    
                }
            } else if ($checkboxVal== 'teacher'){
                if (does_exist_teacher($_POST['username'])) {
                    $s = get_password_teacher($_POST['username']);
                    $str = json_encode($s);
                    echo "Your password is  ". $str;
                } else {
                    echo "Username does not exist";
                }
            }
            exit();
            case 'Unsubscribe':
            $checkboxVal = $_POST['usertype'];
            if ($checkboxVal == 'student'){
                delete_student($_POST['username'], $_POST['password']);
                if (does_exist_student($_POST['username'])) {
                    echo "Student not unsubscribed!! Please Try Again";
                }else{
                    echo "Student unsubscribed!!";
                }
            } else if ($checkboxVal == 'teacher'){
                delete_teacher($_POST['username'], $_POST['password']);
                if (does_exist_teacher($_POST['username'])) {
                    echo "Teacher not unsubscribed!! Please Try Again";
                }else{
                    echo "Teacher unsubscribed!!";
                }
            }
            exit();
		
			
	}
}
else if ($_POST['page'] == 'TeacherMainPage')
{
	session_start();
	
	if (!isset($_SESSION['signedin'])||$_SESSION['signedin']!='YES') {
		echo 'Session is broken <br>';
		exit();
	}
	
	$username = $_SESSION['username'];
	
	$command = $_POST ['command'];
	switch ($command) {
		case 'SignOut':
			# code...
			session_unset();
			session_destroy();
			$display_type='no-signin';
			include('StartPageView.php');
			break;
			
		case 'ListQuestions':
            $result = list_questions($_POST['QuestionNo']);
              // in model.php
            break;
        case 'Listallquestion':
            $result = list_all_questions();
            # code...
            break;
        case 'ListAStudent':
            $result = list_a_student($_POST['Studentid']);
            # code...
            break;
		//case 'PostQuestion':
           // $result = post_question($username,$_POST['Comments']);  // in model.php
            //echo $result;
        //    break;
        case 'ListUsers':
        	
            $result = list_users();
            break;
        case 'PostGrade':
            $result = post_grade($_POST['user_id'],$_POST['marks'],$_POST['Comments']);
            //echo $result;
            break;
        case 'DeleteQuestion':
            $result = delete_question($_POST['delquestion_no']);
            # code...
            break;
        case 'CheckMessages':
            $result = checkMessage($_SESSION['username']);
            break;
	
		default:
			echo 'Unknown command - '. $command . '<br>';
			
	}
}
else if ($_POST['page'] == 'MainPage')
{
	session_start();
	if (!isset($_SESSION['signedin'])||$_SESSION['signedin']!='YES') {
                    include('StartPageView.php');

		echo 'Session is broken <br>';
		exit();
	}
	$username = $_SESSION['username'];
	$command = $_POST ['command'];
	switch ($command) {
		  case 'SignOut':
            # code...
            session_unset();
            session_destroy();

            $display_type='no-signin';
            include('StartPageView.php');
            break;
		
		case 'MessageTeacher':
            $result = chat_professor($_POST['Comments'],$_POST['user_name'],$_SESSION['username']);
            break;
			
	    case 'SearchTeacher':
            $result = search_teacher($_POST['user_name']);
            break;
        case 'SearchAllTeacher':
            $result = search_all_teacher();
            # code...
            break;
		default:
			echo 'Unknown command - '. $command . '<br>';
			
	}
	
}

else{
	
}
?>
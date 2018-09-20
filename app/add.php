<?php
require 'config.php';
function validate_date($date_string){
	if ($time = strtotime($date_string))
		return $time;
	else{
		return false;
}
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if((!empty($_POST['task_name'])) and (!empty($_POST['due_date']))){
  //  $due_date = $_POST['due_date'];
  //  $due_date = validate_date($due_date);
    if ($due_date = validate_date($_POST['due_date'])){

     $description = $_POST['task_name'];
    $due_date = date('Y-m-d H:i:s',$due_date);
    $connection->query("INSERT INTO tasks (description, due_date, user_id) VALUES ('".$description."','".$due_date."', '".$_SESSION['user_id']."')");
   }
   else {
     $errors['not_valid_date']='يجب ادخال التاريخ بصورة صحيحة';
     $_SESSION['errors'] = $errors;
   }
}
else {
  if(empty($_POST['name'])){
  $errors['required_name'] = "يجب أن تقوم بكتابة وصف للمهمة";
}
if(empty($_POST['due_date'])){
  $errors['required_Date'] = "يجب أن تقوم تعيين آخر مهلة لإنجاز المهمة";
}
$_SESSION['errors'] = $errors;

}
header('Location: ../index.php');


}
 ?>

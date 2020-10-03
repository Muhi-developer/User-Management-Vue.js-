<?php
$conn = new mysqli("localhost","root","","muhi");
if($conn->connect_error){
    die("connection failed ".$conn->connect_error);
}

$result = array('error'=>false);
$action = '';

if(isset($_GET['action'])){
    $action = $_GET['action'];
}

if($action == 'read'){
    $sql = $conn->query("SELECT * FROM users");
    $users = array();
    while($row = $sql->fetch_assoc()){
        array_push($users,$row);
    }
    $result['users'] = $users;
}

if($action == 'create'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $sql = $conn->query("INSERT INTO users (Name, Email, Phone) VALUES ('$name','$email','$phone')");
    
    if($sql){
        $result['message'] = "User added Successfully..!";
    }
    else{
        $result['error'] = true;
        $result['message'] = "Failed to Add User..:(";
    }
}


if($action == 'update'){
    $id = $_POST['id'];
    $name = $_POST['name'];
   $email = $_POST['email'];
   $phone = $_POST['phone'];
   
   $sql = $conn->query("UPDATE users SET Name='$name',Email='$email',Phone='$phone' WHERE id='$id'");
   
   if($sql){
       $result['message'] = "User Updated Successfully..!";
   }
   else{
       $result['error'] = true;
       $result['message'] = "Failed to Update User..:(";
   }
}


if($action == 'delete'){
    $id = $_POST['id'];
   
   $sql = $conn->query("DELETE FROM users WHERE id='$id'");
   
   if($sql){
       $result['message'] = "User Deleted Successfully..!";
   }
   else{
       $result['error'] = true;
       $result['message'] = "Failed to Delete User..:(";
   }
}
$conn->close();
echo json_encode($result);
?>
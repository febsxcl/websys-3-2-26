<?php
include 'config.php';

// sql query select all
$result = mysqli_query($db, "SELECT * FROM deym");

// Login Button
if(isset($_POST['Login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = mysqli_query($db, "SELECT * FROM deym WHERE Username='$username' AND Password='$password'");
    $row = mysqli_fetch_array($sql);

    if(is_array($row)){   
        setcookie('Username', $row["Username"], time()+(86400*30)); // 30 days
        header("Location: index.php");
    } else {
        echo "Invalid Username and Password";
    }
}

// Register Button
if(isset($_POST['Register'])){
    header("Location: register.php");
}

// Cancel Registration
if(isset($_POST['Cancel'])){
    header("Location: login.php");
}

// Submit Button (Register new user)
if(isset($_POST['Submit'])){
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        echo 'Please input Username and Password';
    } else {
        $sql = "INSERT INTO deym (Username, Name, Password) VALUES ('$username', '$name', '$password')";
        mysqli_query($db, $sql);
        header("Location: index.php");
    }   
}

// Logout 
if(isset($_POST['Logout'])){
    setcookie('Username', '', time()-3600); // expire cookie
    header("Location: login.php");
}

// Update
if(isset($_POST['update'])){
    $ID = $_POST['ID'];
    $username = $_POST['username'];
    $name = $_POST['name'];

    $query = "UPDATE deym SET Username='$username', Name='$name' WHERE ID='$ID'";
    mysqli_query($db, $query);
    header('Location: index.php'); 
}

// Cancel-edit
if(isset($_POST['cancel-edit'])){
    header('Location: index.php');
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM deym WHERE ID=$id";
    mysqli_query($db, $query);
    header("Location: index.php");
}

?>
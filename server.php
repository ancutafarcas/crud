<?php
    session_start();
    
    //initialize variablies
    $name="";
    $address="";
    $id=0;
    $edit_state = false;

    //connect to database
    $db = mysqli_connect('remotemysql.com', 'mro3iqr4Up', 'R4CYCBu7F1', 'mro3iqr4Up');

    //if save button is clicked
    if(isset($_POST['save'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];

        $query="INSERT INTO crud (name, address) VALUES ('$name', '$address')";
        mysqli_query($db, $query);
        $_SESSION['msg'] = "Address saved";
        header('location: index.php'); //redirect to index page after inserting
    }


    //update records 
    if(isset($_POST['update'])) {
        $name = mysqli_real_escape_string($_POST['name']);
        $address =  mysqli_real_escape_string($_POST['address']);
        $id =  mysqli_real_escape_string($_POST['id']);

        mysqli_query($db, "UPDATE crud SET name='$name', address='$address' WHERE id='$id' ");
        $_SESSION['msg'] = "Address updated";
        header('location: index.php');
    }

    //delete records

    if(isset($_GET['del'])){
            $id = $_GET['del'];
            mysqli_query($db,"DELETE FROM crud WHERE id=$id");
            $_SESSION['msg'] = "Address deleted";
            header('location: index.php');

    }
    //retrieve records
    $results = mysqli_query($db, "SELECT * FROM crud")

?>
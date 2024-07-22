<?php
    include('localsetting.php');
    session_start();

    if(isset($_POST['save']))
    {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $course = $_POST['course'];

        $addQuery = "INSERT INTO sample (fullname, email, phone, course) VALUES(:fullname, :email, :phone, :course)";
        $queryResult = $conn->prepare($addQuery);

        $data = [
            ':fullname' => $fullname,
            ':email' => $email,
            ':phone' => $phone,
            ':course' => $course,
        ];
        $query_execute = $queryResult->execute($data);

        if ($query_execute) {
            $_SESSION['message']= "Inserted Data Successfully!";
            header('Location:index.php');
            exit(0); 
        } else {
            $_SESSION['message']= "Inserted Data Failed!";
            header('Location:index.php');
            exit(0);
        }
        
    }

    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $course = $_POST['course'];

        try 
        {
            $updateQuery = "UPDATE sample SET fullname = :fullname, email = :email, phone = :phone, course = :course WHERE id = :id LIMIT 1";
            $statement = $conn->prepare($updateQuery);

            $data = [
                ':fullname' => $fullname,
                ':email' => $email,
                ':phone' => $phone,
                ':course' => $course,
                ':id' => $id
            ];

            $query_execute = $statement->execute($data);
            
            if ($query_execute) {
                $_SESSION['message']= "Updated Data Successfully!";
                header('Location:index.php');
                exit(0); 
            } else {
                $_SESSION['message']= "Update Data Failed!";
                header('Location:index.php');
                exit(0);
            }
            
        } 
        catch (PDOException $e) 
        {
            echo $e->getMessage();
        }
    }

    if(isset($_POST['delete'])){

        $id = $_POST['delete'];

        try 
        {
            $deleteQuery = "DELETE FROM sample WHERE id = :id";
            $statement = $conn->prepare($deleteQuery);

            $data = [
                ':id' => $id
            ];

            $query_execute = $statement->execute($data);

            if ($query_execute) {
                $_SESSION['message']= "Delete Data Successfully!";
                header('Location:index.php');
                exit(0); 
            } else {
                $_SESSION['message']= "Delete Data Failed!";
                header('Location:index.php');
                exit(0);
            }

        } 
        catch (PDOException $e) 
        {
            echo $e->$getMessage();
        }
    }
?>
<?php
    include('localsetting.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT PAGE</title>
</head>
<body>
    <div>
        <h1>SAMPLE EDIT PHP PDO CRUD</h1>
        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $editQuery = "SELECT * FROM sample WHERE id=:id";
                $editResult = $conn->prepare($editQuery);

                $data = [
                    ':id' => $id
                ];
                $editResult->execute($data);

                $result = $editResult->fetch(PDO::FETCH_OBJ); //PDO::FETCH_ASSOC
            }
        ?>
        <form action="code.php" method="POST">
            <input type="hidden" name="id" value="<?= $result->id; ?>">
            <div>
                <input type="text" name="fullname" value="<?= $result->fullname?>">
            </div>
            <div>
                <input type="email" name="email" value="<?= $result->email?>">
            </div>
            <div>
                <input type="number" name="phone" value="<?= $result->phone?>">
            </div>
            <div>
                <input type="text" name="course" value="<?= $result->course?>">
            </div>
            <div>
                <button type="submit" name="update">UPDATE</button>
            </div>
        </form>
    </div>
</body>
</html>
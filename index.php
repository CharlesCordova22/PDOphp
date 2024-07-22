<?php 
    session_start();
    include('localsetting.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP PDO CRUD</title>
</head>
<body>
    <div>
        <h1>SAMPLE PHP PDO CRUD</h1>
        <?php if(isset($_SESSION['message'])) : ?>
            <h5><?=$_SESSION['message']; ?></h5>
        <?php unset($_SESSION['message']); endif; ?>
        <form action="code.php" method="POST">
            <div>
                <input type="text" name="fullname" placeholder="FULL NAME">
            </div>
            <div>
                <input type="email" name="email" placeholder="EMAIL">
            </div>
            <div>
                <input type="number" name="phone" placeholder="PHONE NUMBER">
            </div>
            <div>
                <input type="text" name="course" placeholder="COURSE">
            </div>
            <div>
                <button type="submit" name="save">SAVE STUDENT</button>
            </div>
        </form>
    </div><br>
    <div>
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>FULLNAME</td>
                    <td>EMAIL</td>
                    <td>PHONE</td>
                    <td>COURSE</td>
                    <td>ACTIONS</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $getQuery = "SELECT * FROM sample";
                    $queryResult = $conn->prepare($getQuery);
                    $queryResult->execute();
                    
                    $queryResult->setFetchMode(PDO::FETCH_OBJ); //PDO:FETCH_ASSOC
                    $result = $queryResult->fetchAll();
                    if ($result)
                    {
                        foreach($result as $row)
                        {
                            ?>
                                <tr>
                                    <td><?= $row->id;?></td>
                                    <td><?= $row->fullname;?></td>
                                    <td><?= $row->email;?></td>
                                    <td><?= $row->phone;?></td>
                                    <td><?= $row->course;?></td>
                                    <td>
                                        <form action="edit.php?id=<?= $row->id; ?>" method="POST">
                                            <button type="submit">EDIT</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="code.php" method="POST">
                                            <button type="submit" name="delete" value="<?= $row->id;?>">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                        }
                    } 
                    else 
                    {
                        ?>
                            <tr>
                                <td colspan="5">
                                    No Record Found!
                                </td>
                            </tr>
                        <?php
                    }   
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
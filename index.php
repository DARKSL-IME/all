<?php

require_once('process.php');
require_once('./config.php');
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>

    <title>Student Data</title>

</head>

<body>
    <br />
    <div class="container">
        <h1>CRUD Application</h1>
        <?php
        if (isset($_SESSION['message'])): ?>

            <div style="display:flex; top:30px;" class="alert alert-<?= $_SESSION['msg_type'] ?> fade show" role="alert">

                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['msg_type']);

                ?>


                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="container">

            <div style="margin-bottom:5em;">

                <table id="tbl" class="table table-hover dt-responsive" style=" width: 100%;">
                    <thead class="thead-dark">

                        <tr>
                            <th>Student Name</th>
                            <th>Age</th>
                            <th>Email</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM student_details";
                        $result = $database->query($sql);

                        if ($result->num_rows > 0) {
                            
                            while ($row = $result->fetch_assoc()) {
                                ?>

                                <tr>
                                    <td>
                                        <?php echo $row['Sname']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['age']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['email']; ?>
                                    </td>

                                    <td>
                                        <a href="index.php?edit=<?php echo $row['Sid']; ?>"><button
                                                class="btn btn-success">Edit</button></a>

                                        <a href="process.php?delete=<?php echo $row['Sid'] ?>" class="btn btn-danger btn-xl"
                                            style="display: inline !important;">Delete</a>
                                    </td>
                                </tr>
                            </tbody>

                            <?php
                            }
                        } else {
                            echo "0 results";
                        }
                        $database->close();
                        ?>


                </table>


            </div>


            <!--update and add -->
            <div>
                <div>


                    <?php
                    if ($update == true):
                        ?>
                        <h4>Edit Student</h4>

                    <?php else: ?>
                        <h4>Add Student</h4>

                    <?php endif; ?>

                </div>
                <div>
                    <div class="container" style="margin-top: 40px;">
                        <form action="process.php" method="POST">
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="hidden" id="Sid" name="Sid" value="<?php echo $Sid; ?>">

                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="Sname" class="col-sm-2 col-form-label">Student Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="Sname" name="Sname"
                                        placeholder="Enter the Name" style="width: 300px;"
                                        value="<?php echo $Sname; ?>" Required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="age" class="col-sm-2 col-form-label">Age</label>
                                <div class="col-sm-10">

                                    <input type="number" class="form-control" id="age" name="age"
                                        placeholder="Enter the Age" style="width: 300px;" value="<?php echo $age; ?>" Required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">

                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter the Email" style="width: 300px;"
                                        value="<?php echo $email; ?>" Required>
                                </div>
                            </div>


                    </div>
                    <div>
                        <?php
                        if ($update == true):
                            ?>
                            <button type="submit" class="btn btn-primary" name="update">Edit</button>
                            
 
                        <?php else: ?>
                            <button type="submit" class="btn btn-primary" name="save">Save</button>

                        <?php endif; ?>

                    </div>

                    </form>

                </div>

            </div>
        </div>




</body>

</html>

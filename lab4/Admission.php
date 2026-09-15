<?php

include("db.php");
$result = $con->query("SELECT * FROM `admission_table` ORDER BY id DESC");
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $full_name = trim( $_POST['full_name']);
    $father_name  = trim($_POST['father_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $program = trim($_POST['program']);
    if (!$email || !$full_name || !$phone || !$program || !$father_name){
        header("location:admission.php?error=true");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("location:admission.php?email_error=true");
    }
    $statement = $con->prepare("INSERT INTO `admission_table`( `full_name`, `father_name`, `email`, `phone`, `program`) VALUES (?,?,?,?,?)");
    $statement->bind_param("sssss",$full_name,$father_name,$email,$phone,$program);
    if($statement->execute()){
        $statement->close();
        header("location:admission.php?success=true");
    }else{
        header("location:admission.php?db_error=true");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-4.6.2-dist\css\bootstrap.min.css">

</head>
<body>

    
<div class="container mt-4" style="
    width:500px;
">


<?php

if(isset($_GET['success'])){



?>
    <div class="alert alert-success">
        Admission Succussfull
    </div>

    <?php }?>
    <?php
    if(isset($_GET['error'])){
    ?>
        <div class="alert alert-danger">
            All Fields Required
        </div>
    <?php
    }
    ?>
    
    <?php
    if(isset($_GET['db_error'])){
    ?>
        <div class="alert alert-danger">
            Something Wrong during Admission
        </div>
    <?php
    }
    ?>

   
    <?php
    if(isset($_GET['email_error'])){
    ?>
        <div class="alert alert-danger">
            Email is not Valid
        </div>
    <?php
    }
    

    ?>
    <form action="admission.php" class="form d-flex flex-column" method="POST" >

        <label for="name_inp" class="form-label">Full Name:</label>
        <input type="text" name="full_name" class="form-control" id="name_inp" required>
        <label for="fname_inp" class="form-label">Father's Name:</label>
         <input type="text" name="father_name" class="form-control" id="fname_inp" required>
         <label for="fname_inp" class="form-label">Email:</label>
          <input type="email" name="email" class="form-control" id="email_inp" required>
          <label for="fname_inp" class="form-label">Phone:</label>
           <input type="text" name="phone" class="form-control" id="phone_inp" required>
           <label for="fname_inp" class="form-label">Program:</label>
           <select name="program" class="form-control" id="program_inp" required>

           <option value="Information System">Information System</option>
           <option value="Software Enginerring">Software Enginerring</option>
           <option value="Computer Science">Computer Science</option>
           </select>
           <button type="submit" class="btn btn-primary mt-3 ">Register</button>
           
    </form>
    

</div>
<div class="container mt-4">
    <table class="table table-bordered">
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Full Name</th>
            <th class="text-center">Father Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Phone</th>
            <th class="text-center">Program</th>
        </tr>


        <?php


        while($row = $result->fetch_assoc()){

        
        ?>
            <tr>
                <td><?php echo htmlspecialchars($row["id"]) ; ?></td>
                <td><?php echo htmlspecialchars($row["full_name"]); ?></td>
                <td><?php echo htmlspecialchars($row["father_name"]); ?></td>
                <td><?php echo htmlspecialchars($row["email"]); ?></td>
                <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                <td><?php echo htmlspecialchars($row["program"]); ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
<script src="\bootstrap-4.6.2-dist\js\bootstrap.min.js"></script>
</body>
</html>

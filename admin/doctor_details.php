<?php
    session_start();
    if(!isset($_SESSION["username"]))
    {
        header("Login.php");
    }
    $cn=new mysqli("localhost","root","","medical_db");
        if(!$cn)
        {
            die("Database is unable to reach...");
        }
        
    if(isset($_REQUEST["submit"]))
    {
        
        $Name=$_REQUEST["t1"];
        $Qualification=$_REQUEST["t2"];
        $Specialization=$_REQUEST["t3"];
        $Experience=$_REQUEST["t4"];
        $Fees=$_REQUEST["t5"];
        $Img=$_REQUEST["t6"];

        $targetDir="upload/";
        $fileTmpPath = $_FILES["photo"]["tmp_name"];
        $fileName = basename($_FILES["photo"]["name"]);
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $newFileName = uniqid("img_", true) . "." . $fileType;
        $targetFilePath = $targetDir . $newFileName;

        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (in_array($fileType, $allowedTypes)) 
        {
            if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            
            
            $q="insert into doctor_detalis(Name,Qualification,Specialization,Experience,Fees,Img) values('$Name','$Qualification',$Specialization','$Experience','$Fees','$Img')";
            //echo $q;
            $cn->query($q);
            
            //echo "Image uploaded successfully!";
        } else {
            echo "Error uploading image.";
        }
    } 
    else {
        echo "Only JPG, JPEG, PNG & GIF files are allowed.";
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* General Page Style */
body {
    font-family: Arial, sans-serif;
    background: #f4f7fb;
    margin: 0;
    padding: 0;
    color: #333;
}

/* Heading */
h1 {
    color: #2c3e50;
    margin-bottom: 15px;
}

/* Form */
form {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    display: inline-block;
    text-align: left;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

form input[type="text"],
form input[type="file"],
form select {
    width: 100%;
    padding: 10px;
    margin: 6px 0 15px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    font-size: 14px;
    transition: 0.3s;
}

form input[type="text"]:focus {
    border-color: #3498db;
    box-shadow: 0 0 5px rgba(52,152,219,0.4);
}

form input[type="submit"], 
form button {
    background: #3498db;
    color: white;
    padding: 10px 18px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

form input[type="submit"]:hover, 
form button:hover {
    background: #2980b9;
}

/* Table */
table {
    margin-top: 25px;
    width: 90%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

table th, table td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

table th {
    background: #3498db;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.8px;
}

table tr:nth-child(even) {
    background: #f9f9f9;
}

table tr:hover {
    background: #f1f7ff;
}

/* Image */
table img {
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}

/* Action Buttons */
table button {
    background: #2ecc71;
    margin: 2px;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
}

table form[action*="delete"] button {
    background: #e74c3c;
}

table form[action*="update"] button {
    background: #f39c12;
}

table button:hover {
    opacity: 0.9;
}

    </style>
</head>
<body>
    <center>
        <h1>Doctor Details <?php  $_SESSION['username']; ?></h1><hr>
        <form action="doctor_details.php" method="post" enctype="multipart/form-data">
            <select name="cid" >
                <?php
                    $res=$cn->query("select * from doctor_detalis");
                    while($row=$res->fetch_assoc())
                    {
                        ?>
                            <option value='<?php echo "$row[id]" ?>'><?php echo "$row[doctor_detalis]"; ?></option>                   
                        <?php
                    }
                ?>
            </select> <br><br>
            Enter Name : <input type="text" name="t1"> <br><br>
            Enter Qualification  : <input type="text" name="t2"> <br><br>
            Enter Specialization : <input type="text" name="t3"> <br><br>
            Enter Experience : <input type="text" name="t4"> <br><br>
            Enter Fees : <input type="text" name="t5"> <br><br>
            Enter Img :<input type="text" style="width: 300px;height: 40px;" name="t5"> <br><br>
            <input type="submit" value="submit" name="submit">
        </form>

        <hr>
        <h1>Doctor Details</h1><br>
        <table border=2>
            <thead>
                <td>Id</td>
                <td>Name</td>
                <td>Qualification</td>
                <td>Specialization</td>
                <td>Experience</td>
                <td>Fees</td>
                <td>Img</td>
            </thead>
            <tbody>
                <?php
                    $res=$cn->query("select * from doctor_details");
                    while($row=$res->fetch_assoc())
                    {
                        ?>
                            <tr>
                                <td><?php echo "$row[Id]"; ?></td>
                                <td><?php echo "$row[Name]"; ?></td>
                                <td><?php echo "$row[Qualification]"; ?></td>
                                <td><?php echo "$row[Specialization]"; ?></td>
                                <td><?php echo "$row[Experience]"; ?></td>
                                <td><?php echo "$row[Fees]"; ?></td>
                                <td> <img src='<?php echo "$row[img]";?>' height=100px width=100px alt=""> </td>
                                <td><?php echo "$row[is_active]"; ?></td>
                                <td><form action="update.php?id=<?php echo $row['id']; ?>"method="post"><input type="hidden"value=<?php $row['id'];?>><button>update</button></form></td>
                                <td><form action="delete.php?id=<?php echo $row['id'];?>"method="post"><input type="hidden"value=<?php $row['id'];?>><button>delete</button></form></td>
                            </tr>  

                        <?php
                    }
                ?>
            </tbody>
        </table>
    </center>
</body>

</html>
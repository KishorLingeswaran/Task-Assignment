<?php  
$con = mysqli_connect("localhost", "root", "", "user");
if (!$con) {
    die("connection error");
}

if (isset($_POST['ADD'])) {

    $Name = $_POST['Name'];
    if ( $Name !== '') {
        $sql = "INSERT INTO category(CategoryName) VALUES ('$Name')";
        $con->query($sql);
    } else {
        echo '<script type="text/javascript">alert(" CategoryId Must")</script>';
    }
}

if (isset($_POST['UPDATE'])) {
    $ID = $_POST['ID'];
    $Name = $_POST['Name'];
    if ($ID !== '' && $Name !== '') {
        $sql = "UPDATE category SET CategoryName='$Name' WHERE CategoryId='$ID'";
        $con->query($sql);
    } else {
        echo '<script type="text/javascript">alert("Enter CategoryId and CategoryId Must")</script>';
    }
}

if (isset($_GET['delete'])) {
    $ID = $_GET['delete'];
    $sql = "DELETE FROM category WHERE CategoryId='$ID'";
    if ($con->query($sql) === TRUE) {
        echo '<script type="text/javascript">alert("Category deleted successfully"); window.location.href="category.php";</script>';
    } else {
        echo '<script type="text/javascript">alert("Error deleting category");</script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME</title>
    <style type="text/css">
        body {
            margin-left: 400px;
        }
        td, th {
            width: 150px;
            height: 50px;
            text-align: center;
            border: 1px solid black;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        }
      
        form {
            display: flex;
            margin-left: 62%;
        }
        #update{
            display: flex;
            margin-left: 30%;
        }
        h6 {
            margin-left: 10px;
            color: black;
            font-size: 16px;
            font-family: 'poppins';
            text-align: center;
        }
        input {
            margin-bottom: 10px;
            margin-left: 5px;
            margin-top: 30px;
            height: 20px;
            width: 100px;
            border: 2px solid black;
            border-radius: 10px;
            font-family: 'poppins';
        }   
        
        .edit {
            font-size: 20px;
            color: red;
        }
        .change {
            display: flex;
        }
        .delete {
            color: red;
            font-size: 20px;
            text-decoration: none !important;
        }
        #cancel{
            margin-left: 20px;
            margin-top: 30px;
            width: 70px;
            height: 25px;
            background-color: red;
            border: 1px red;
            font-size: 16px;
            border-radius: 5px;
            color: white;
           
            font-weight: bolder;
            cursor: pointer;
        }
        button {
            margin-left: 20px;
            margin-top: 30px;
            width: 70px;
            height: 25px;
            background-color: green;
            border: 1px solid green;
            font-size: 16px;
            border-radius: 5px;
            color: white;
            font-family: "Times New Roman";
            font-weight: bolder;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php include "side_menu.php"; ?>
<div class="main-content">
<?php
if (isset($_GET['edit'])) {
    $ID = $_GET['edit'];
    $sql = "SELECT * FROM category WHERE CategoryId='$ID'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <form action="category.php" method="post" id="update">
        <h6>Category ID:</h6>
            <input type="text" name="ID" value="<?php echo $row['CategoryId']; ?>" readonly>
            <h6>Category Name:</h6>
            <input type="text" name="Name" value="<?php echo $row['CategoryName']; ?>" required>
            <button type="submit" name="UPDATE">Update</button>
            <button type="submit" name="Cancel" id='cancel' onclick="location.href='category.php'">Cancel</button>
        </form>
<?php
    }
}
else{
?>
<form action="category.php" method="post">       
    
    <h6>Category Name:</h6>
    <input type="text" name="Name" placeholder="Category Name" class="box" required>
    <button type="submit" name="ADD" id='add'>ADD</button>
</form>
<?php 
}
?>
<table>
    <tr>
        <th>CategoryId</th>
        <th>CategoryName</th>
        <th>Actions</th>
    </tr>
    
    <?php 
    $view = "SELECT * FROM category ORDER BY CategoryId ASC"; 
    $result = $con->query($view); 
    if ($result !== false && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
            <tr>
                <td><?php echo $row['CategoryId']; ?></td>
                <td><?php echo $row['CategoryName']; ?></td>
                <td>
                    
                    <div class="change">
                        <p class="edit"><a href="category.php?edit=<?php echo $row['CategoryId']; ?>" style="color: blue;">Edit</a></p>
                        <p class="delete"><a href="#" onclick="deleteCategory('<?php echo $row['CategoryId']; ?>')" style="color: red;">Delete</a></p>
                    </div>
                    
                </td>
            </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='3'>No categories found</td></tr>";
    }
    ?>
    
</table>

<script type="text/javascript">
    function deleteCategory(categoryId) {
        if (confirm('Are you sure you want to delete this category?')) {
            location.href = 'category.php?delete=' + categoryId;
        }
    }
</script>


</div>
</body>
</html>

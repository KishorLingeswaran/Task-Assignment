<?php  
$con = mysqli_connect("localhost", "root", "", "user");
if (!$con) {
    die("Connection error");
}

if (isset($_POST['ADD'])) {
    $Name = $_POST['Name'];
    $price = $_POST['Price'];
    $category = $_POST['category'];
    if ($price !== '' && $Name !== '' && $category !== '') {
        $sql = "INSERT INTO product(productName, productPrice, categoryName) VALUES ('$Name', '$price', '$category')";
        $con->query($sql);
    } else {
        echo '<script type="text/javascript">alert("Enter productId and productId Must")</script>';
    }
}

if (isset($_POST['UPDATE'])) {
    $ID = $_POST['ID'];
    $Name = $_POST['Name'];
    $price = $_POST['Price'];
    $category = $_POST['category'];
    if ($price !== '' && $Name !== '' && $category !== '') {
        $sql = "UPDATE product SET productName='$Name', productPrice='$price', CategoryName='$category' WHERE productId='$ID'";
        $con->query($sql);
    } else {
        echo '<script type="text/javascript">alert("Enter productId and productId Must")</script>';
    }
}

if (isset($_GET['delete'])) {
    $ID = $_GET['delete'];
    $sql = "DELETE FROM product WHERE productId='$ID'";
    if ($con->query($sql) === TRUE) {
        echo '<script type="text/javascript">alert("product deleted successfully"); window.location.href="product.php";</script>';
    } else {
        echo '<script type="text/javascript">alert("Error deleting product");</script>';
    }
}

$filterQuery = "";
if (isset($_POST['filter'])) {
    $filter = $_POST['filter'];
    $filterQuery = "WHERE CategoryName = '$filter'";
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
            margin-left: 32%;
        }
        #update {
            display: flex;
            margin-left: 20%;
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
        #cancel {
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
        select { 
            margin-left: 20px;
            margin-top: 30px;
            width: 90px;
            height: 25px;
        }
        #select {
            Border: none;
            margin-top: -20px;
        }
    </style>
</head>
<body>
<?php include "side_menu.php"; ?>
<div class="main-content">
<?php
if (isset($_GET['edit'])) {
    $ID = $_GET['edit'];
    $sql = "SELECT * FROM product WHERE productId='$ID'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <form action="product.php" method="post" id="update">   
            <h6>Product ID:</h6>
            <input type="text" name="ID" value="<?php echo $row['productId']; ?>" readonly>    
            <h6>product Name:</h6>
            <input type="text" name="Name" value="<?php echo $row['productName']; ?>" class="box" required>
            <h6>product Price:</h6>
            <input type="number" name="Price" value="<?php echo $row['productPrice']; ?>" class="Price" required>
            <select name="category" required>
                <option value=""><?php echo $row['CategoryName']; ?></option>
                <?php 
                $view = "SELECT CategoryName FROM category"; 
                $result = $con->query($view); 
                if ($result !== false && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['CategoryName']}'>{$row['CategoryName']}</option>";
                    }
                }
                ?>
            </select>
            <button type="submit" name="UPDATE">update</button>
        </form>
<?php
    }
} else {
?>
    <form action="product.php" method="post">       
        <h6>product Name:</h6>
        <input type="text" name="Name" placeholder="product Name" required>
        <h6>product Price:</h6>
        <input type="number" name="Price" placeholder="product Price"  required>
        <select name="category" required>
            <option value="" disabled selected>Select Category</option>
            <?php 
            $view = "SELECT CategoryName FROM category"; 
            $result = $con->query($view); 
            if ($result !== false && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['CategoryName']}'>{$row['CategoryName']}</option>";
                }
            }
            ?>
        </select>
        <button type="submit" name="ADD" id='add'>ADD</button>
    </form>
<?php 
}
?>
    <table>
        <tr>
            <th>productName</th>
            <th>productPrice</th>
            <th>CategoryName</th>
            <th>Actions</th>
            <th id='select'>
                <form action="product.php" method="post" required>
                    <select name="filter">
                        <option value=""></option>
                        <?php 
                        $view = "SELECT CategoryName FROM category"; 
                        $result = $con->query($view); 
                        if ($result !== false && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['CategoryName']}'>{$row['CategoryName']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <button type="submit" name="filterButton">Filter</button>
                </form>
            </th>
        </tr>
        <?php 
        $view = "SELECT * FROM product $filterQuery ORDER BY productId ASC"; 
        $result = $con->query($view); 
        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $row['productName']; ?></td>
                    <td><?php echo $row['productPrice']; ?></td>
                    <td><?php echo $row['CategoryName']; ?></td>
                    <td>
                        <div class="change">
                            <p class="edit"><a href="product.php?edit=<?php echo $row['productId']; ?>" style="color: blue;">Edit</a></p>
                            <p class="delete"><a href="#" onclick="deleteproduct('<?php echo $row['productId']; ?>')" style="color: red;">Delete</a></p>
                        </div>
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='4'>No Products found</td></tr>";
        }
        ?>
    </table>

    <script type="text/javascript">
        function deleteproduct(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                location.href = 'product.php?delete=' + productId;
            }
        }
    </script>
</div>

</body>
</html>

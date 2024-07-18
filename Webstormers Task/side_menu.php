<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HOME</title>
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		.side-menu {
			width: 250px;
			height: 100vh;
			background: black;
			position: fixed;
			top: 0;
			left: 0;
			color: white;
			overflow-y: auto; 
			transition: transform 0.3s ease;
		}
		.side-menu h1 {
			margin-left: 30px;
			padding: 8px;
		}
		.side-menu h2 {
			margin: 0;
			padding: 0;
		}
		 a {
			display: block;
			margin-left: 10px;
			padding: 8px 8px 8px 32px;
			text-decoration: none;
			cursor: pointer;
			color: whitesmoke;
			transition: background 0.3s;
		}
		.side-menu a:hover {
			background: grey;
		}
		.main-content {
			margin-left: 300px;
			padding: 20px;
			transition: margin-left 0.3s ease;
		}
	
		
		
	</style>
</head>
<body>



<div class="side-menu" id="sideMenu">
	<h1>ADMIN</h1>
	<h2><a href="Dashboard.php">Dash Board</a></h2>
	<h2><a href="category.php">Category</a></h2>
	<h2><a href="product.php">Product</a></h2>
	<h2><a href="settings.php">Settings</a></h2>
</div>



</body>
</html>

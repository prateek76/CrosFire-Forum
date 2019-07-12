<?php

include_once 'resources/init.php';

if ( isset($_POST['name'])) {
	$name = trim($_POST['name']);

	if ( empty($name)) {
		$error = 'Empty Bro!!';
	} else if (category_exists('','name',$name,$conn)) {
		$error = 'That already exists!!';
	} else if (strlen($name) > 24) {
		$error = 'category names character limit exceeds!!';
	}

	if (! isset($error)) {
		add_category($name,$conn);

		header('location: add_post.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatiable" content="IE-edge,chrome=1">

	<title>Add a Category</title>
</head>
<body>
	<h1>Add a Category</h1>
	<?php

	if (isset($error)) {
		echo "<p>$error</p>";
	}

	?>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>
		<br>
		<div>
			<input type="submit" value="Add Category">
		</div>
	</form>
</body>
</html>
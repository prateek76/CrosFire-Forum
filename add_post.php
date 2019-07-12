<?php

include_once("resources/init.php");

if(isset($_POST['submit'])){
if (isset($_POST['title'], $_POST['contents'], $_POST['category'])) {
	$errors = array();	//array for errors

	$title = trim($_POST['title']);
	$contents = trim($_POST['contents']);

	if (empty($title)) {
		$errors[] = 'Title field empty'; 
	} else if (strlen($title) > 255) {
		$errors[] = "Character limit excceds";
	}
	if (empty($contents)) {
		$errors[] = 'Content field empty';
	}
	if ( ! category_exists('','id',$_POST['category'],$conn)) {
		$errors[] = "Category does not Exist";
	}
	if( empty($errors)) {
		add_post($title,$contents,$_POST['category'],$conn);
		$id = mysqli_insert_id($conn);//this function takes the value last put in primary field
		header("location: index.php?id=$id");
		die();
	}
	
}

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatiable" content="IE-edge,chrome=1">
	<style type="text/css">
		label{ display: block; }
	</style>
	<title>Add a post</title>
</head>
<body>
	<h1>Add a post</h1>
	<!--show errors-->
	<?php
		if (isset($errors) && !empty($errors)) {
			echo '<ul><li>', implode('</li><li>', $errors),'</li></ul>';
		}
	?>

	<form action="" method="post">
		<div>
			<label form="title">Title</label>
			<input type="text" name="title" value="">
		</div>
		<div>
			<label for="contents">Contents</label>
			<textarea name="contents" rows="15" cols="50"><?php if(isset($_POST['contents'])) echo $_POST['contents'];?></textarea>
		</div>
		<div>
			<label for="category">Category</label>
			<select name="category">
				<?php
					foreach (get_categories($conn) as $category) {
				?><option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
				<?php
					}
				?>
			</select>
		</div>
		<div>
			<input type="submit" name="submit" value="Add Post">
		</div>
	</form>
</body>
</html>
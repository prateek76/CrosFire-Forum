<?php

include_once("resources/init.php");

//getting data related to post to edit it

$post = get_posts($_GET['id'],'',$conn);

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
		edit_post($_GET['id'],$title,$contents,$_POST['category'],$conn);
		header("Location: index.php?id={$post[0]['post_id']}");
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
	<title>Edit a post</title>
</head>
<body>
	<h1>Edit a post</h1>
	<!--show errors-->
	<?php
		if (isset($errors) && !empty($errors)) {
			echo '<ul><li>', implode('</li><li>', $errors),'</li></ul>';
		}
		//print_r($post[0]) ;
	?>

	<form action="" method="post">
		<div>
			<label form="title">Title</label>
			<input type="text" name="title" value="<?php echo $post[0]['title'];?>">
		</div>
		<div>
			<label for="contents">Contents</label>
			<textarea name="contents" rows="15" cols="50"><?php echo $post[0]['contents'];?></textarea>
		</div>
		<div>
			<label for="category">Category</label>
			<select name="category">
				<?php
					foreach (get_categories($conn) as $category) {
						$selected = ($category['name'] == $post[0]['name']) ? ' selected' : '';
				?><option value="<?php echo $category['id']; ?>"<?php echo $selected; ?>><?php echo $category['name'];?></option>
				<?php
					}
				?>
			</select>
		</div>
		<div>
			<input type="submit" name="submit" value="Edit Post">
		</div>
	</form>
</body>
</html>
<?php
	include_once('resources/init.php');

	//$posts = (isset($_GET['id'])) ? get_posts($_GET['id'],'',$conn) : get_posts('','',$conn);
	//$posts = get_posts('','',$conn);
	$posts = get_posts(((isset($_GET['id'])) ? $_GET['id'] : null),'',$conn);//agar kisi specific pe click kie ho to usko show karega wanrna pura
	//https://uigradients.com/#Ohhappiness
	//https://designshack.net/articles/css/10-great-google-font-combinations-you-can-copy/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatiable" content="IE-edge,chrome=1">
	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style_index.css">
	
	<title>Home</title>
</head>
<body>
	<nav>
		<ul class="main-bar">
			<li><a href="index.php">Index</a></li>
			<li><a href="add_post.php">New post</a></li>
			<li><a href="add_category.php">New category</a></li>
			<li><a href="category_list.php">Category Available</a></li>
		</ul>
	</nav>
	<h1>CrosFire Forum</h1>

	<?php 
		//if we delete category and post remains then we assign something to its category property
	foreach ($posts as $post) {
		/*if (! category_exists('','name',$post['name'],$conn)) {
			$post['name'] = 'Uncategorised';
		}*///not working!!
		?>

		<h2><a href="index.php?id=<?php echo $post['post_id']; ?>"><?php echo $post['title']; ?></a></h2>
		<p>Posted on <?php echo date('d-m-Y h:i:s' , strtotime($post['date_posted'])); ?>
			in <a href="category.php?id=<?php echo $post['category_id']; ?>"><?php echo $post['name']; ?></a>
		</p>
		<div> <?php echo nl2br($post['contents']);/*nl2br inserts line break before each line*/ ?></div>
		<menu>
			<ul class="main-tool">
				<li style="font-size: 24px"><a href="delete_post.php?id=<?php echo $post['post_id']; ?>">✗ delete</a></li>
				<li style="font-size: 24px"><a href="edit_post.php?id=<?php echo $post['post_id']; ?>">✎ edit</a></li>
			</ul>
		</menu>

		<?php
	}
	?>
	
</body>
</html>
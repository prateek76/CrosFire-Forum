<?php
	include_once('resources/init.php');

	$posts = get_posts('',$_GET['id'],$conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatiable" content="IE-edge,chrome=1">

	<style type="text/css">
		body{
			font-size: 18px;
		}
		ul{
			list-style: none;
		}	
		li{
			display: inline;
			margin-right: 20px;
		}
		a{
			text-decoration: none;
			color: gray;	
		}
		h2 a,ul.main-bar a{
			text-decoration: none;
			color: #000;	
			transition: all ease-in-out 200ms;
		}
		ul.main-bar a:hover{
			text-decoration: underline;
			color: gray;	
		}
		ul.main-tool li a:hover{
			color: black;
		}
		div{
			background-color: #f3f3f3;
			padding: 10px;
			width: 1000px;
		}
		h2{
			background-color: #FCBF8D;
			padding: 10px;
			width: 1000px;
		}
		p{
			width: 1000px;
			background-color: #FFCE43;
			color: #000;
			padding: 20px;
			padding-right: 2px;
			border-radius: 10px;
		}
		p a:hover{
			color: #000;
			text-decoration: underline;
		}
	</style>


	<title>categories</title>
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
		if (! category_exists('','name',$post['name'],$conn)) {
			$post['name'] = 'Uncategorised';
		}
		?>

		<h2><a href="index.php?id=<?php echo $post['post_id']; ?>"><?php echo $post['title']; ?></a></h2>
		<p>Posted on <?php echo date('d-m-Y h:i:s' , strtotime($post['date_posted'])); ?>
			in <a href="category.php?id=<?php echo $post['category_id']; ?>"><?php echo $post['name']; ?></a>
		</p>
		<div> <?php echo nl2br($post['contents']); ?></div>
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
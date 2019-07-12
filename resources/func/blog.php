<?php

include_once 'resources/init.php';

function add_post($title, $contents, $category,$conn){
	$title 	  = mysqli_real_escape_string($conn,$title);
	$contents = mysqli_real_escape_string($conn,$contents);
	$category = (int) $category;

	mysqli_query($conn,"INSERT INTO posts (cat_id,title,contents,date_posted) VALUES ('$category','$title','$contents',NOW());");
}

function edit_post($id ,$title, $contents, $category,$conn){
	$id 	  = (int) $id;
	$title 	  = mysqli_real_escape_string($conn,$title);
	$contents = mysqli_real_escape_string($conn,$contents);
	$category = (int) $category;

	mysqli_query($conn,"UPDATE `posts` SET
		`cat_id`	= {$category},
		`title`		= '{$title}',
		`contents`	= '{$contents}'
		WHERE `id` = {$id} ");

}

function add_category($name,$conn){

	$name = mysqli_real_escape_string($conn,$name);
	mysqli_query($conn,"INSERT INTO categories (name) VALUES ('$name');");
}

function delete($table, $id,$conn){
	$table = mysqli_real_escape_string($conn,$table);
	$id = (int) $id;
	//use if else if removing category then assign uncategorised to it
	mysqli_query($conn,"DELETE FROM $table WHERE id =  $id");
}

function get_posts($id = null, $cat_id = null,$conn){
	$posts = array();

	$query = "SELECT posts.id AS post_id, categories.id AS category_id , title , contents , date_posted , categories.name 
			  FROM posts 
			  INNER JOIN categories ON categories.id = posts.cat_id";//joining two tables and searching

			  //check for category id
			  if (isset($cat_id) and $cat_id > 0) {
			  	$cat_id = (int) $cat_id;
			  	$query .= " WHERE cat_id = $cat_id";
			  }

			  //check for post id
			  else if (isset($id)) {
			  	$id = (int) $id;
			  	$query .= " WHERE posts.id = $id";//no space was giving error
			  }
			  $query .= " ORDER BY posts.id DESC";//no space was giving error
			  //echo $query;

			  $query = mysqli_query($conn,$query);
			  while ($row = mysqli_fetch_assoc($query)) {
			  	$posts[] = $row;
			  }

			  return $posts;

}

function get_categories($conn,$id = null){
	$categories = array();

	$query = mysqli_query($conn,"SELECT id , name FROM categories");

	while ($row = mysqli_fetch_assoc($query)) {
		$categories[] = $row;
	}
	return $categories;
}

function category_exists($name,$field,$value,$conn){
	//we are taking row also as variable we have to pass row name while calling function
	$field = mysqli_real_escape_string($conn,$field);
	$value = mysqli_real_escape_string($conn,$value);
	$query = mysqli_query($conn,"SELECT * FROM categories WHERE $field = '$value' ");

	$resultCheck = mysqli_num_rows($query);
	if($resultCheck>0){
		return true;
	} else {
		return false;
	}
}
<?php
/* -- Before inserting the data, create the table in SQLite
sqlite> CREATE TABLE posts (
   ...> id INTERGER  PRIMARY KEY,
   ...> date TEXT,    
   ...> title TEXT NOT NULL,
   ...> content TEXT
   ...> );*/
 
require_once "functions/config.php"; 
// If the form is submitted 
if(isset($_POST['submit'])){
	$stmt = $pdo->prepare("INSERT INTO posts (title, date, content) VALUES (:title, :date, :content)");
	// Get editor content 
	$stmt->execute([
		"title" => $_POST['title'],
		"date" => $_POST['date'],
		"content" => $_POST['content']
	]);
	// Redirect to previous page
	header("Location:manage.php");
} 

 
?>

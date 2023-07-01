<?php

require "User.php";
require "Category.php";
require "Blog.php";
$mysqli = require "../database.php";

// Add blogs ant authors
$blogs_result = $mysqli->query("SELECT * FROM blogs");
$blogs = [];
while ($row = $blogs_result->fetch_object()) {
    $res = $mysqli->query("SELECT * FROM users WHERE id=$row->author_id LIMIT 1");
    $user = $res->fetch_object();
    $blogs[] = new Blog(
        $row->id,
        $row->title,
        $row->content,
        new User($user->id, $user->firstname, $user->lastname, $user->email)
    );
}

// Add categories to blogs
$blogs_categories_result = $mysqli->query("SELECT * FROM blog_category");
while ($row = $blogs_categories_result->fetch_object()) {
    $blog_id = $row->blog_id;
    $blog = array_values(array_filter($blogs, function ($obj) use ($blog_id) {
        return $obj->id === $blog_id;
    }))[0];
    $res = $mysqli->query("SELECT * FROM categories WHERE id=$row->category_id LIMIT 1");
    $category = $res->fetch_object();
    array_push($blog->categories, new Category($category->id, $category->title));
}

// Display array of blogs
foreach ($blogs as $blog) {
    echo "Blog ID: " . $blog->id . ", title: " . $blog->title . ", content: " . $blog->content . "<br>";
    echo "Author ID: " . $blog->author->id . ", author: " . $blog->author->first_name . " " . $blog->author->last_name . ", email: " . $blog->author->email . "<br>";
    echo "Categories: ";
    foreach ($blog->categories as $category) {
        echo $category->title . " ";
    }
    echo "<br><br>";
}
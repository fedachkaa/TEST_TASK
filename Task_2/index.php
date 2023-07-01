<?php

$mysqli = require "../database.php";

// Blogs table 
$sql_create_blog_table = "CREATE TABLE blogs(
    id int NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    content text NOT NULL,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    author_id int,
    deleted boolean DEFAULT FALSE,
    PRIMARY KEY (id)
) ENGINE=InnoDB";

// Categories table
$sql_create_category_table = "CREATE TABLE categories(
    id int NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    deleted boolean DEFAULT FALSE,
    PRIMARY KEY (id)
) ENGINE=InnoDB";

// Users table
$sql_create_users_table = "CREATE TABLE users(
    id int NOT NULL AUTO_INCREMENT,
    firstname varchar(255) NOT NULL,
    lastname varchar(255) NOT NULL,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    deleted boolean DEFAULT FALSE,
    PRIMARY KEY (id)
) ENGINE=InnoDB";


$mysqli->query($sql_create_blog_table);
$mysqli->query($sql_create_category_table);
$mysqli->query($sql_create_users_table);


// Blogs and categories many to many relationship
$sql_blog_category = "CREATE TABLE blog_category(
    blog_id int,
    category_id int,
    PRIMARY KEY (blog_id, category_id),
    FOREIGN KEY (blog_id) REFERENCES blogs(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
) ENGINE=InnoDB";

// Blogs and users one to many relationship
$sql_user_blog = "ALTER TABLE blogs
    ADD FOREIGN KEY (author_id) REFERENCES users(id)
";

$mysqli->query($sql_blog_category);
$mysqli->query($sql_user_blog);
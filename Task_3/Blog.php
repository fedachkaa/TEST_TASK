<?php
class Blog
{
    public $id;
    public $title;
    public $content;
    public $categories;
    public $author;
    public function __construct($id, $title, $content, $author)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->categories = [];
    }
}
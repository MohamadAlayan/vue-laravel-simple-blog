<?php

namespace App\Models\ViewModels\Post;

class AddNewPostViewModel
{
    public $title;
    public $body;
    public $image;

    /**
     * @param $title
     * @param $body
     * @param $image
     */
    public function __construct($title, $body, $image)
    {
        $this->title = $title;
        $this->body = $body;
        $this->image = $image;
    }
}

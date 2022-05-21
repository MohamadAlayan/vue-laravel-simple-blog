<?php

namespace App\Models\ViewModels\Post;

class EditPostViewModel
{
    public $id;
    public $title;
    public $body;
    public $image;

    /**
     * @param $id
     * @param $title
     * @param $body
     * @param $image
     */
    public function __construct($id, $title, $body, $image)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->image = $image;
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use  HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'author_id',
        'title',
        'body',
        'image_url',
        'thumb_url'
    ];



    public function user()
    {
        return $this->belongsTo(User::class,'author_id');
    }




}

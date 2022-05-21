<?php

namespace App\Services;

use App\Exceptions\UnhandledException;
use App\Models\Post;
use App\Models\ViewModels\Post\AddNewPostViewModel;
use App\Models\ViewModels\Post\EditPostViewModel;
use App\Utils\UploadFileUtils;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PostServices
{
    public static function getAllPosts()
    {
        $posts = Post::orderBy('created_at', 'desc')
            ->with('user')
            ->paginate(5);
        return $posts;
    }


    /**
     * @throws UnhandledException
     */
    public static function addNewPost(AddNewPostViewModel $post, int $author_id): Post
    {
        try {
            $image = null;
            if ($post->image) {
                $fullImage = $post->image;
                $location = public_path() . "/posts-images";
                $image = (object)UploadFileUtils::uploadImage($fullImage, $location, null, null, '300x300');
            }

            return Post::create(
                [
                    'author_id' => $author_id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'image_url' => ($image && $image->name) ? env('APP_URL') . "/posts-images/" . $image->name : null,
                    'thumb_url' => ($image && $image->name) ? env('APP_URL') . "/posts-images/" . $image->thumb_name : null,
                ]);

        } catch (\Exception $e) {
            throw new UnhandledException();
        }

    }

    /**
     * @throws UnhandledException
     */
    public static function editNewPost(EditPostViewModel $post): Post
    {
        try {
            $image = null;
            if ($post->image) {
                $fullImage = $post->image;
                $location = public_path() . "/posts-images";
                $image = (object)UploadFileUtils::uploadImage($fullImage, $location, null, null, '300x300');
            }
            DB::beginTransaction();
            $p = self::getPostById($post->id);
            $p->title = $post->title;
            $p->body = $post->body;
            $p->image_url = ($image && $image->name) ? env('APP_URL') . "/public/posts-images/" . $image->name : null;
            $p->thumb_url = ($image && $image->name) ? env('APP_URL') . "/public/posts-images/" . $image->thumb_name : null;
            $p->save();
            DB::commit();
            return $p;
        } catch (Exception $error) {
            DB::rollback();
            throw new UnhandledException();
        }
    }


    public static function getPostAuthorId(int $post_id): ?int
    {
        if (empty($post_id) || !is_numeric($post_id)) {
            return null;
        }

        $post = Post::where('id', '=', $post_id)->first();
        if (!empty($post)) {
            return $post->author_id;
        }
        return null;
    }


    public static
    function getPostById($id): ?Post
    {
        if (empty($id) || !is_numeric($id)) {
            return null;
        }

        $post = Post::where('id', '=', $id)->first();
        if (!empty($post)) {
            return $post;
        }
        return null;
    }

    public static
    function getUserPostsById(int $id)
    {
        if (empty($id) || !is_numeric($id)) {
            return null;
        }

        $posts = Post::orderBy('created_at', 'desc')
            ->where('author_id', '=', $id)
            ->with('user')
            ->paginate(5);
        if (!empty($posts)) {
            return $posts;
        }
        return null;
    }

    public static
    function deletePostById(int $id): bool
    {
        if (empty($id) || !is_numeric($id)) {
            return false;
        }

        $post = Post::where('id', '=', $id)->first();
        $post->delete();

        if ($post->delete()) {
            return true;
        }
        return false;
    }


}

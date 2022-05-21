<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthorizedException;
use App\Exceptions\UnhandledException;
use App\Models\ViewModels\Post\AddNewPostViewModel;
use App\Models\ViewModels\Post\EditPostViewModel;
use App\Services\PostServices;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{

    public function getAllPosts(): JsonResponse
    {
        $posts = PostServices::getAllPosts();
        return $this->successResponse($posts, "Get all posts success");
    }

    public function getPost($id): JsonResponse
    {
        $post = PostServices::getPostById($id);
        return $this->successResponse($post, "Get post success");
    }

    public function getUserPosts($id): JsonResponse
    {
        $posts = PostServices::getUserPostsById($id);
        return $this->successResponse($posts, "Get user post success");
    }

    /**
     * @throws UnhandledException
     */
    public function readAddNewPostViewModel(Request $request): AddNewPostViewModel
    {
        try {
            $data = $this->getRequestData($request);
            $title = isset($data->title) ? trim($data->title) : null;
            $body = isset($data->body) ? trim($data->body) : null;
            $image = $request->file('post_image') ?: null;

            return new AddNewPostViewModel($title, $body, $image);
        } catch (Exception $e) {
            throw new UnhandledException();
        }
    }

    /**
     * @throws UnhandledException
     */
    public function addNewPost(Request $request): JsonResponse
    {
        try {
            $post = $this->readAddNewPostViewModel($request);

            $validator = Validator::make((array)$post, [
                    'title' => ['required', 'string', 'between:5,250'],
                    'body' => ['required', 'string', 'between:10,1200'],
                    'image' => ['nullable', 'sometimes', 'max:2048', 'mimes:jpg,jpeg,png,webp,gif'],
                ]
            );
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $new_post = PostServices::addNewPost($post, Auth::id());

            if ($new_post) {
                return $this->successResponse($new_post, "success");
            }
            throw new UnhandledException();
        } catch (Exception $e) {
            throw new UnhandledException();
        }
    }


    /**
     * @throws UnhandledException
     */
    public function readEditPostViewModel(Request $request): EditPostViewModel
    {
        try {
            $data = $this->getRequestData($request);
            $id = isset($data->id) ? $data->id : null;
            $title = isset($data->title) ? trim($data->title) : null;
            $body = isset($data->body) ? trim($data->body) : null;
            $image = $request->file('post_image') ?: null;

            return new EditPostViewModel($id, $title, $body, $image);
        } catch (Exception $e) {
            throw new UnhandledException();
        }
    }

    /**
     * @throws UnhandledException|ValidationException|UnauthorizedException
     */
    public function editPost(Request $request): JsonResponse
    {
        $post = $this->readEditPostViewModel($request);
        $validator = Validator::make((array)$post, [
                'id' => ['required', 'integer'],
                'title' => ['required', 'string', 'between:5,250'],
                'body' => ['required', 'string', 'between:10,1200'],
                'image' => ['nullable', 'sometimes', 'max:2048', 'mimes:jpg,jpeg,png,webp,gif'],
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        if (PostServices::getPostAuthorId($post->id) == Auth::id()) {

            $new_post = PostServices::editNewPost($post);

            return $this->successResponse($new_post, "Edit post success");

        }
        throw new UnauthorizedException();


    }

    public function deletePost($id): JsonResponse
    {
        if (PostServices::getPostAuthorId($id) == Auth::id()) {
            PostServices::deletePostById($id);
            return $this->successResponse(null, "Delete post success");
        }
        throw new UnauthorizedException();

    }
}

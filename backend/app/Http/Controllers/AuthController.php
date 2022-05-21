<?php

namespace App\Http\Controllers;

use App\Exceptions\UnhandledException;
use App\Models\ViewModels\Auth\LogInViewModel;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @throws UnhandledException
     */
    public function readLogInViewModel(Request $request): LogInViewModel
    {
        try {
            $data = $this->getRequestData($request);
            $email = isset($data->email) ? trim($data->email) : null;
            $password = isset($data->password) ? $data->password : null;

            return new LogInViewModel($email, $password);
        } catch (Exception $e) {
            throw new UnhandledException();
        }
    }

    /**
     * @throws ValidationException
     * @throws UnhandledException
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $this->readLogInViewModel($request);

        $validator = Validator::make((array)$credentials, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data = AuthService::login((array)$credentials);

        if ($data) {
            //return user and token on success login attempt
            return $this->successResponse($data, "Login success");
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials',
            ], 403);
        }
    }

    /**
     * @throws UnhandledException
     */
    public function logout(): JsonResponse
    {
        if (Auth::check()) {
            // It deletes all tokens of this user
            // Auth()->user()->tokens()->delete();

            // It deletes the token that was used to authenticate the current request
            Auth()->user()->currentAccessToken()->delete();
            return $this->successResponse(null, "Logout success");
        }

        throw new UnhandledException();
    }
}

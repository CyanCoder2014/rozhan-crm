<?php

namespace App\Http\Controllers\API\Client\v1;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    use ThrottlesLogins;

    protected $maxAttempts = 3;

    protected $decayMinutes = 1;

    public function login(Request $request)
    {
        // get email and password from request
        $credentials = $request->all(['email', 'password']);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // try to auth and get the token using api authentication
        if (!$token = auth('api')->attempt($credentials)) {
            $this->incrementLoginAttempts($request);
            // if the credentials are wrong we send an unauthorized error in json format
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $this->clearLoginAttempts($request);

        return response()->json([
            'token'   => $token,
            'type'    => 'bearer',
            'expires' => auth('api')->factory()->getTTL() * 60 * 300, // time to expiration
        ]);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        return response()->json([
            'status'  => false,
            'message' => Lang::get('auth.throttle', ['seconds' => $seconds]),
        ], 429);
    }
}

<?php

namespace App\Http\Controllers\API\SuperAdmin\v1;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Auth\ResetPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    use ThrottlesLogins;

    protected $maxAttempts = 3;

    protected $decayMinutes = 1;

    public function login(Request $request)
    {
        $credentials = $request->all(['email', 'password']);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // try to auth and get the token using api authentication
        if (!$token = auth('admin-api')->attempt($credentials)) {
            $this->incrementLoginAttempts($request);
            // if the credentials are wrong we send an unauthorized error in json format
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $this->clearLoginAttempts($request);

        return response()->json([
            'token'   => $token,
            'type'    => 'bearer',
            'expires' => auth('admin-api')->factory()->getTTL() * 60 * 300
        ]);
    }

    public function resetPassword(ResetPassword $request)
    {
        $admin = Admin::find(auth('admin-api')->id());

        if (Hash::check($request->get('old_password'), $admin->password)) {
            $admin->password = Hash::make($request->get('password'));

            $admin->save();

            event(new PasswordReset($admin));

            auth('admin-api')->invalidate();

            return response()->json([
                'message' => 'Successfully password changed'
            ]);
        }

        return response()->json(['error' => 'Old password is not correct.'], 400);
    }

    public function logout()
    {
        auth('admin-api')->logout();

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

<?php

namespace App\Http\Middleware;

use App\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class ActiveCooperationAccount
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth('api')->user();

        if ($user && !$this->cooperationAccountIsActive($user)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }

    protected function cooperationAccountIsActive(User $user): bool
    {
        $cooperationAccount = $user->cooperationAccount()->first();

        $status = (bool)$cooperationAccount->status;

        $now = Carbon::now();

        $expired_at = Carbon::parse($cooperationAccount->expired_at) ;

        return $status && $now->lessThanOrEqualTo($expired_at);
    }
}

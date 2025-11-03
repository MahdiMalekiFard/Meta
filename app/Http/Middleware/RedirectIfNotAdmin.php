<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request     $request
     * @param Closure     $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $roles = [RoleEnum::ADMIN->value];
        if (auth()->check()) {
            return $next($request);
//            foreach (auth()->user()->getRoleNames() as $roleName) {
//                if (in_array($roleName, $roles)) {
//                    if (!auth()->user()->block) {
//                        return $next($request);
//                    } else {
//                        auth()->logout();
//                        return redirect(route('auth.login-view',['locale'=>app()->getLocale()]))->with(
//                            'success',
//                            'در حال حاضر امکان استفاده از پنل مدیریت میسر نمی باشد. لطفا برای بررسی این مشکل با بخش پشتیبانی تماس بگیرید.'
//                        );
//                    }
//                }
//            }
        }
        return redirect(route('auth.login-view',['locale'=>app()->getLocale()]));
    }
}

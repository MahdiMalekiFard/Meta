<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\RegisterAction;
use App\Actions\Auth\VerifyCodeAction;
use App\Http\Controllers\Auth\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyCodeRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseWebController
{
    public function loginView()
    {
        if (auth()->user()) {
            return redirect(route('home.index'));
        }
        
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        
        return view('auth.login');
    }
    
    public function login(LoginRequest $request): ?RedirectResponse
    {
        try {
            $user = LoginAction::run($request->validated());
            auth()->login($user, true);
            return redirect()->intended(route('admin.index'));
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return redirect()->back()->withToastError($exception->getMessage());
        }
        
    }
    
    public function registerView()
    {
        if (auth()->user()) {
            return redirect(route('home.index'));
        }
        
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        
        return view('auth.register');
    }
    
    public function register(RegisterRequest $request, UserRepositoryInterface $userRepository)
    {
        return RegisterAction::run($request->validated());
    }
    
    public function forgotPasswordView()
    {
        return view('auth.forgot-password');
    }
    
    public function forgotPassword(ForgetPasswordRequest $request): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('home.index');
    }
    
    public function verifyCodeView()
    {
        return view('auth.verify-email');
    }
    
    public function verifyCode(VerifyCodeRequest $request)
    {
        return VerifyCodeAction::run($request->validated());
    }
    
    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('home.index');
    }
}

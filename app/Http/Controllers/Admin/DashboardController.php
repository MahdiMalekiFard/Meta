<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use Illuminate\Http\Request;

class DashboardController extends BaseWebController
{
    public function index(Request $request)
    {
        if (!auth()->user()->hasRole(RoleEnum::ADMIN->value)) {
            return redirect()->route('admin.profile.edit', ['profile' => auth()->user()->profile->id]);
        }
        return view('admin.pages.dashboard');
    }
}

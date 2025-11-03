<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Profile\UpdateProfileAction;
use App\Http\Requests\UpdateBannerRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ProfileController extends BaseWebController
{
    
    private User $user;
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ($id = request()?->route()?->parameter('id')) {
                $this->user = User::find($id);
            } else {
                $this->user = Auth::user();
            }
            return $next($request);
        });
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Profile $profile
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Profile $profile)
    {
        return view('admin.pages.profile.edit', compact('profile'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfileRequest $request
     * @param Profile              $profile
     *
     * @return mixed
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        UpdateProfileAction::run($profile, $request->validated());
        return redirect(route('admin.profile.edit',$profile->id))->withToastSuccess(trans('general.update_success', ['model' => trans('profile.model')]));
    }
    
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;

class ProfileController extends Controller
{
public function add()
{
    return view('admin.profile.create');
}
public function create(Request $request)
{
            $this->validate($request, Profile::$rules);

            $profile = new Profile;
            $form = $request->all();
            
            // フォームから送信されてきた_tokenを削除する
            unset($form['_token']);
    
            // データベースに保存する
            $profile->fill($form);
            $profile->save();

    return redirect('admin/profile/create');
}
public function edit(Request $request)
{
    $profile = Profile::find($request->id);
    if (empty($profile)) {
        abort(404);
    }
    return view('admin.profile.edit', ['profile_form' => $profile]);  
}

public function update(Request $request)
{
    $this->validate($request, Profile::$rules);
    $profile = Profile::find($request->id);
    $profile_form = $request->all();
    unset($profile_form['_token']);

    $profile->fill($profile_form)->save();

    return redirect('admin/profile/edit');
}
}

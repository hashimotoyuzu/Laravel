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
    
            if (isset($form['image'])) {
                $path = $request->file('image')->store('public/image');
                $profile->image_path = basename($path);
            } else {
                $profile->image_path = null;
            }
    
            // フォームから送信されてきた_tokenを削除する
            unset($form['_token']);
            // フォームから送信されてきたimageを削除する
            unset($form['image']);
    
            // データベースに保存する
            $profile->fill($form);
            $profile->save();
    return redirect('admin/profile/create');
}
public function edit()
{
    return view('admin.profile.edit');
}
public function update()
{
    return redirect('admin/profile/edit');
}
}

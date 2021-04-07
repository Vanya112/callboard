<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminService
{

    public function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:30',
            'description' => 'required|max:1000',
            'phone_number' => 'required|regex:/[0-9]{11,16}/',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);
        return $validator;
    }

    public function fillAnnouncement(Request $request, $announcement)
    {
        $announcement->title = strip_tags(trim($request->input('title')));
        $announcement->description = strip_tags(trim($request->input('description')));
        $announcement->phone_number = strip_tags(trim($request->input('phone_number')));
        $announcement->image_name = strip_tags(trim($request->file('image')->getClientOriginalName()));
        $announcement->user_name = Auth::user()->name;
    }

}

<?php


namespace App\Services;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentService
{

    public function validate(Request $request)
    {
        $input = array_map('trim', $request->all());
        $validator = Validator::make($input, [
            'text' => 'required|min:1|max:1000',
        ]);
        return $validator;
    }

    public function fillComment(Request $request, $comment, $announcement_id)
    {
        $comment->announcement_id = $announcement_id;
        $comment->user_name = (!Auth::user()) ? 'Guest' : Auth::user()->name;
        $comment->text = strip_tags(trim($request->input('text')));
    }

}

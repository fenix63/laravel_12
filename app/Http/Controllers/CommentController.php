<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
	public static function create(Request $request)
	{
		$result = Comment::addCommment($request);
		return response()->json(['result' => $result]);
    }

	public static function getPostComments(int $postId)
	{
		$data = Comment::where('post_id', $postId)->get();
		return response()->json(['result' => $data]);
	}
}

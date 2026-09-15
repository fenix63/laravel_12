<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public static function addUser(Request $request)
	{
		$recordId = User::add($request);
		return response()->json(['result' => $recordId]);
    }

	public static function getAllUsers()
	{
		$allUsers = User::getAllUsers();
		$allUsersArray = response()->json(['result' => $allUsers])->getData(assoc: true);
		//return response()->json(['result' => $allPostsArray['result']]);
		return $allUsersArray;
	}
}

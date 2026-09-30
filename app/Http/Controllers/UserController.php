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

	public static function getAllUsers(array $select = [])
	{
		$allUsers = User::getAllUsers($select);
		$allUsersArray = response()->json(['result' => $allUsers])->getData(assoc: true);
		return $allUsersArray;
	}

	public static function getUserByFilter(array $filter, array $select)
	{
		return User::getUserByFilter($filter, $select);
	}
}

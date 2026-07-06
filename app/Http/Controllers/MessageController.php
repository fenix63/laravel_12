<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
	public static function dbgLog($data, string $suffix = '_1')
	{
		if (
			!empty($suffix)
			&&
			preg_match('![^-0-9a-zA-Z_]+!', $suffix)
		) {
			$suffix = '';
		}

		$fileName = 'dbg-' . date('Ymd') . $suffix . '.txt';

		//$r = fopen("C:\\OSPanel\\home\\laravel12\\public\\app\\Http\\Controllers\\".$fileName, 'a');
		$r = fopen("/var/www/laravel/logs/" . $fileName, 'a');
		fwrite($r, PHP_EOL);
		fwrite($r, date('Y-m-d H:i:s') . PHP_EOL);
		fwrite($r, print_r($data, 1));
		//ob_start(); var_export($data); fwrite($r, ob_get_clean());
		fwrite($r, PHP_EOL);
		fclose($r);
	}

	public static function addMessage(Request $request)
	{

		$recordId = Message::add(
			$request->input('name'),
			$request->input('email'),
			$request->input('subject'),
			$request->input('text')
		);


		return response()->json(['result' => $recordId]);
	}

	public static function updateMessage(Request $request)
	{

		$recordId = $request->input('recordid');
		$fields = $request->input('fields');

		$updatedRecordId = Message::updateRecord($recordId, $fields);

		return response()->json(['result' => $updatedRecordId]);
	}

	public static function findRecords(Request $request)
	{
		$recordsList = Message::getRecords($request->input(), ['id', 'name','email']);
		return response()->json(['result' => $recordsList]);
	}

	public static function getAllRecords()
	{
		$recordsList = Message::getAllRecords(['id', 'name','email']);
		return response()->json(['result' => $recordsList]);
	}

	public static function deleterecord(Request $request)
	{
		$recordId = $request->input('recordid');
		$result = Message::deleteRecord($recordId);
		return response()->json(['result' => $result]);
	}
}

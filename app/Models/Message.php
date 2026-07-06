<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\MessageController;


class Message extends Model
{
	public $timestamps = false;

	public static function getRecords(array $input, array $select)
	{
		$key = key($input);
		$value = $input[$key];
		$value = explode(",",$value);


		$users = self::whereIn('id', $value)->get($select);

		MessageController::dbgLog($users,'_users_');

		return $users;
	}

	public static function getAllRecords(array $select)
	{
		$users = self::All($select);
		return $users;
	}

	public static function add(string $name, string $email, string $subject, string $text)
	{
		$obj = new self();
		$obj->name = $name;
		$obj->email = $email;
		$obj->subject = $subject;
		$obj->text = $text;
		$obj->save();

		MessageController::dbgLog($obj->getAttribute('id'),'_add_users_');

		return $obj->getAttribute('id');
	}

	public static function updateRecord(int $recordId, array $fieldData)
	{
		$obj = new self();
		$record = $obj->find($recordId);

		//MessageController::dbgLog($record,'record');

		$fieldName = key($fieldData);
		$fieldValue = $fieldData[$fieldName];


		$record->$fieldName = $fieldValue;
		$updatedRecord = $record->save();

		return $record->getAttribute('id');
	}

	public static function deleteRecord(int $recordId)
	{
		$result = self::destroy($recordId);
		MessageController::dbgLog($result,'delete_result_');


		return $result;
	}
}

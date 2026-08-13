<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Mockery\Exception;
use Illuminate\Database\QueryException;

class Comment extends Model
{
	const TABLE_NAME = 'comments';
	public static function addCommment(Request $request)
	{
		$columns = Schema::getColumnListing(self::TABLE_NAME);
		$keyToDelete = ['id','created_at','updated_at'];

		foreach ($keyToDelete as $key) {
			$index = array_search($key, $columns);
			if ($index !== false) {
				unset($columns[$index]);
			}
		}

		$items = $request->input('items');
		$dataToAdd = [];
		foreach($items as $item){
			foreach ($columns as $column) {
				if (array_key_exists($column, $item))
					$itemToAdd[$column] = $item[$column];
			}
			$dataToAdd[] = $itemToAdd;
		}

		try {
			$result = self::insert($dataToAdd);
		}catch(QueryException $e){
			$result = $e->errorInfo[1].': '.$e->errorInfo[2] ?? null;
		}

		return $result;
    }

	public static function getPostComments(int $postId)
	{

	}
}

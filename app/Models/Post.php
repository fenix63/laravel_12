<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class Post extends Model
{


	public static function addPost(Request $request)
	{
		$columns = Schema::getColumnListing('posts');
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
				$itemToAdd[$column] = $item[$column];
			}
			$dataToAdd[] = $itemToAdd;
		}

		Post::insert($dataToAdd);
	}
}

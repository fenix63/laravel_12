<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Post extends Model
{

	const TABLE_NAME = 'posts';
	public static function addPost(Request $request):int
	{
		$allData = $request->all();

		$columns = Schema::getColumnListing('posts');
		$keyToDelete = ['id','created_at','updated_at'];

		foreach ($keyToDelete as $key) {
			$index = array_search($key, $columns);
			if ($index !== false) {
				unset($columns[$index]);
			}
		}

		$dataToAdd = [];
		$fields = $request->input();
		foreach ($fields as $column => $fieldValue){
			$dataToAdd[$column] = $fieldValue;
		}

		$recordId = Post::insertGetId($dataToAdd);

		return $recordId;
	}

	public static function addPostFromForm(array $data)
	{
		$recordId = Post::insertGetId($data);
		return $recordId;
	}
	public static function addPosts(Request $request)
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

	public static function getPostById(int $postId)
	{
		$postData = self::find($postId);
		return response()->json(['result' => $postData]);
	}

	public static function getPostItem(Request $request)
	{
		$postid = $request->query('postid');
		$postData = self::find($postid);

		return response()->json(['result' => $postData]);
	}

	public static function getAllPosts(Request $request): Collection
	{
		// Получаем все посты
		return self::all();
	}

	public static function deletePostById(int $postId): bool
	{
		$postItem = self::find($postId);
		if($postItem)
			$result = $postItem->delete($postId);

		if($result)
			return true;

		return false;
	}

	public static function updatePost(Request $request): bool
	{
		$postId = $request->input('postId');
		$postItem = self::find($postId);
		if ($postItem) {
			$postData = $request->input('postData');
			if (!empty($postData)) {
				$newData = [];
				foreach ($postData as $column => $value) {
					$newData[$column] = $value;
				}
			}
		}

		//Вариант через queryBuilder
		if (isset($newData)) {
			$affected = DB::table(self::TABLE_NAME)
				->where('id', $postId)
				->update($newData);

			if ($affected > 0)
				return true;
		}

		return false;
	}
}

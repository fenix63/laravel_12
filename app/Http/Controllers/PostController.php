<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

	public function showPostItem(int $id)
	{
		$postData = Post::getPostById($id);
		$postData = $postData->getData(assoc: true);

		return view('postitem',['postdata' => $postData]);
	}

	public function showAdminPage()
	{
		return view('admin');
	}

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
		Post::addPost($request);
		return response()->json(['result' => 'success']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $allPosts = Post::getAllPosts($request);
		$allPostsArray = response()->json(['result' => $allPosts])->getData(assoc: true);
		//return response()->json(['result' => $allPostsArray['result']]);
    	return $allPostsArray;
	}

	public function getPostById(int $postId)
	{
		$data = Post::getPostById($postId);
	}

	public function getPost(Request $request)
	{
		$postData = Post::getPostItem($request);
		return $postData;
	}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

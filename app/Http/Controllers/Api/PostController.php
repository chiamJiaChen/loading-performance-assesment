<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\PostResource;
use Cache;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $userDepartmentId = $request->user()->department_id;
        $userDepartmentLevel = $request->user()->department_level;

        $currentPage = request()->get('page', 1);

        $posts =  PostResource::collection(Post::where('access_level','<=', $userDepartmentLevel )->wherehas('group', function($query) use($userDepartmentId){
            $query->wherehas('department', function($query2) use($userDepartmentId){
                $query2->where('id',$userDepartmentId);
            });
        })->orderBy('id','desc')->get())->response();

        // return $this->sendResponse(PostResource::collection($posts), 'Posts Listing');
        $data = $posts;
    

        return $data;

    }

    public function page(Request $request)
    {
        $userId =  $request->user()->id;
        $userDepartmentId = $request->user()->department_id;
        $userDepartmentLevel = $request->user()->department_level;

        $currentPage = request()->get('page', 1);

        if (Cache::has('posts-'.   $currentPage . '-'. $userId)) {

            $data = Cache::get('posts-'. $currentPage . '-'. $userId) ;
        } else {

            $posts =  PostResource::collection(Post::where('access_level','<=', $userDepartmentLevel )->wherehas('group', function($query) use($userDepartmentId){
                $query->wherehas('department', function($query2) use($userDepartmentId){
                    $query2->where('id',$userDepartmentId);
                });
            })->orderBy('id','desc')->paginate(15, ['*'], 'page', $currentPage))->response();
            
            Cache::put('posts-'. $currentPage .'-'. $userId, $posts, 30); 

            $data = $posts;
        
        }
      
        return $data;

    }


    public function noPage(Request $request)
    {
        $userDepartmentId = $request->user()->department_id;
        $userDepartmentLevel = $request->user()->department_level;


        $posts =  PostResource::collection(Post::where('access_level','<=', $userDepartmentLevel )->wherehas('group', function($query) use($userDepartmentId){
            $query->wherehas('department', function($query2) use($userDepartmentId){
                $query2->where('id',$userDepartmentId);
            });
        })->orderBy('id','desc')->paginate())->response();
        

        $data = $posts;
        
          
        return $data;

    }


    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}

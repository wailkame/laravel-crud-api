<?php

namespace App\Http\Controllers\Api;


use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function index(){

        $sortField = request('sort_field', 'created_at');
        if(!in_array($sortField , ['title', 'post_text', 'created_at'])){
            $sortField = 'created_at';
        }

        $sortDirection = request('sort_direction', 'desc');
        if(!in_array($sortDirection, ['asc', 'desc'])){
            $sortDirection = 'desc';
        }
        $filled = array_filter(request()->only([
            'title', 'post_text', 'created_at'
        ]));

        $posts = Post::when(count($filled) > 0 , function($query) use ($filled){
            foreach($filled as $column => $value){
                $query->where($column, 'LIKE', '%' . $value . '%');
            }
        })->when(request('search', '') != '', function($query){
            $query->where(function($q){
                $q->where('title', 'LIKE', '%' . request('search') . '%')
                ->orWhere('post_text','LIKE', '%' . request('search') . '%')
                ->orWhere('created_at','LIKE', '%' . request('search') . '%');
            });
        })->when(request('category_id', '') != '', function($query){
            $query->where('category_id', request('category_id'));
        })->when(request('user_id', '') != '', function($query){
            $query->where('user_id', request('user_id'));
        })->orderBy($sortField, $sortDirection)->paginate(3);
        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request){

        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); /// Writing to a log, for example
        }

        $post = Post::create($request->validated());
        return new PostResource($post);
    }

    public function show(Post $post){
       
        return new PostResource($post);

    }

    public function update(Post $post , StorePostRequest $request){
        if(Auth::user()->id === $post->user_id){
            $post->update($request->validated());
            return new PostResource($post);
        }else{
           return "something went wrong";
        }
        
    }

    public function destroy(Post $post){
        //dd($post);
        if(Auth::user()->id === $post->user_id){
            $post->delete();
            return response()->noContent();
        }else{
           return "something went wrong";
        }
        
    }
}

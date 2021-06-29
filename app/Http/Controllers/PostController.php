<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mockery\Expectation;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return send_response(true,'',$posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255|unique:posts',
                'content' => 'required',
            ]);

            if ($validator->fails()) 
                return send_response(false,'validation error!',$validator->errors());

                
            $post = new Post;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->image = $request->image;
            if($post->save())
                return send_response(true,'post successfully created',$post);

        } catch (Expectation $e) {
            report($e);
    
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        if($post)
            return send_response(true,'',$post);
        else
            return send_response(false,'No Data Found!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => [
                    'required',
                    'max:255',
                    Rule::unique('posts')->ignore($id),
                ],
                'content' => 'required',
            ]);

            if ($validator->fails()) 
                return send_response(false,'validation error!',$validator->errors());

            $post = Post::find($id);
            $post->title = $request->title;
            $post->content = $request->content;
            $post->image = $request->image;
            if($post->update())
                return send_response(true,'post successfully updated',$post);

        } catch (Post $e) {
            report($e);
    
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $post = Post::find($id);
            if($post){
                $post->delete();
            }
            return send_response(true,'post successfully deleted.');
        }catch(Exception $e){
            return send_response(false,'Something went wrong!');
        }
    }
}

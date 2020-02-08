<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class AjaxController extends Controller
{
    public function index(){
        $post=Post::all();
        return view('welcome')->with('items',$post);
    }
    public function create(request $request){
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
        ]);
        $post=new Post();
        $post->title=$request->title;
        $post->body=$request->body;
        $post->save();
        return response()->json(['success'=>'Data is successfully added']);

    }

    public function delete(request $request){
        $id=$request->id;
        $post=Post::where('id',$id);
        $post->delete();
        return response()->json(['success'=>'Data is successfully deleted']);
    }
}

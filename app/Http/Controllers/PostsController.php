<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->has('select'))
        {
            if(request()->has('select') === 2)
            {
                $posts=DB::table('posts')
                ->whereRaw('MOD(id,2) = 0')
                ->paginate(2)->appends('select',request('select'));
                $count = Post::count();
                $select = "you select even ID";
                return view('myPosts.index',compact('posts','count'));
            }
            else
            {
                $posts=DB::table('posts')
                ->whereRaw('MOD(id,2) != 0')
                ->paginate(2)->appends('select',request('select'));
                $count = Post::count();
                $select = "you select even ID";
                return view('myPosts.index',compact('posts','count'));
            }
        }
        else
        {
            $posts = Post::orderBy('id')->paginate(2);
            $count = Post::count();
            return view('myPosts.index',compact('posts','count'));
        }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('myPosts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'title' =>  'required|max:200',
            'body' => 'required|max:500'
        ]);

        $post = new Post() ;
        $post->title =  $request->title ;
        $post->body =  $request->body ;

        $post->save();

        return redirect('/posts')->with('status', 'Post was created !');
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
        return view('myPosts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('myPosts.edit', compact('post'));
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
        $request->validate([
            'title' =>  'required|max:200',
            'body' => 'required|max:500'
        ]);

        $post = Post::find($id) ;
        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        return redirect('/posts')->with('status', 'Post was updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = POST::find($id) ;
        $post->delete();
        return redirect('/posts')->with('status', 'Post was deleted !');
    }
}

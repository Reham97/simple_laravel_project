<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;
class PostsController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->has('select'))
        {
            if(request('select') == "2")
            {
                $user= auth()->user();
                $posts=$user->posts()
                ->whereRaw('MOD(id,2) = 0')
                ->paginate(2)->appends('select',request('select'));
                $count = Post::count();
                $select = "you select even ID";
                return view('myPosts.index',compact('posts','count'));
            }
            else
            {
                $user= auth()->user();
                $posts=$user->posts()
                ->whereRaw('MOD(id,2) <> 0')
                ->paginate(2)->appends('select',request('select'));
                $count = Post::count();
                $select = "you select even ID";
                return view('myPosts.index',compact('posts','count'));
            }
        }
        else
        {
            $user= auth()->user();
            $posts=$user->posts()->paginate(2);
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
            'body' => 'required|max:500',
            'image' => 'image|mimes:jpeg,bmp,pnd|max:1999'
           ]);

        $post = new Post() ;
        $post->title =  $request->title ;
        $post->body =  $request->body ;
        $post->user_id = auth()->user()->id;

        if($request->hasFile('postImage'))
        {
            $file = $request->file('postImage');
            $ext = $file->getClientOriginalExtension();
            $filename = 'cover_image'.'_'.time().'.'.$ext;
            $file->storeAs('public/coverImage',$filename);
        }
        else
        {            
            $filename = ("default.png");
        }

        $post->image = $filename;
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
        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error','you are not authorized');
        }
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
        if(auth()->user()->id !== $post->user_id)
        {
            return redirect('/posts')->with('error','you are not authorized');
        }
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
            'body' => 'required|max:500',
            'image' => 'image|mimes:jpeg,bmp,pnd|max:1999'
        ]);

        $post = Post::find($id) ;
        $post->title = $request->title;
        $post->body = $request->body;


        if($request->hasFile('postImage'))
        {
            $file = $request->file('postImage');
            $ext = $file->getClientOriginalExtension();
            $filename = 'cover_image'.'_'.time().'.'.$ext;
            $file->storeAs('public/coverImage',$filename);
            $post->image = $filename;
        }
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

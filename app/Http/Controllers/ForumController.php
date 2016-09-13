<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Post;
use App\Reply;
use Session;
use Auth;

class ForumController extends Controller
{
    public function __construct()
  {
    $this->middleware('auth', ['except'=> 'getpost']);
  }  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('pages.question')->with('categories', $categories);
    }

     public function getpost($slug)
    {
        
        $post = Post::where('slug', '=', $slug)->first();
        return view('pages.reply')->with('post', $post);
    }

    public function calendar()
    {
        return view('calendar');
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
        $this->validate($request,[
                'title'=> 'required|max:150|min:3',
                'category'=> 'required',
                'body'=> 'required|min:5|max:2000'
            ]);
        $post = new Post();

        $post->user_id = Auth::user()->id;
        $post->category_id = $request->category;
        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();
        notify()->flash('<h3>Post saved sussccesfully</h3>', 'success', ['timer'=> 2000]);
        
        return redirect()->route('home');
    }

    public function storeReply(Request $request)
    {

        $this->validate($request, [
                'body'=> 'required|min:10|max:2000'

            ]);

        $post = Post::where('slug', '=', $request->slug)->first();

        if($post)
        {

        $reply = new Reply();
        $reply->user_id = Auth::user()->id;
        $reply->post_id = $post->id;
        $reply->body = $request->body;
        $reply->save();
        notify()->flash('<h3>Reply was created sussccesfully</h3>', 'success', ['timer'=> 2000]);
        return redirect()->back();

        }
        
        return redirect()->route('/');
        

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $post = Post::findOrFail($request->post_id);
       
        if(Auth::user()->id == $post->user_id)
        {
            $post->delete();
            notify()->flash('<h3>Post was removed sussccesfully</h3>', 'success', ['timer'=> 2000]);
        }
        
        return redirect()->back();
    }
    public function destroyreply(Request $request)
    {
        $reply = Reply::findOrFail($request->reply_id);

         if(Auth::user()->id == $reply->user_id)
        {
            $reply->delete();
            notify()->flash('<h3>The reply was removed sussccesfully</h3>', 'success', ['timer'=> 2000]);
        }
        
        return redirect()->back();
    }
}

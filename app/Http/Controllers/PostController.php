<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $posts = Post::latest()->paginate(5);

        //render view with posts
        return view('posts.index', compact('posts'));
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {

        $input = $request->input;
        $input = explode(' ', $input);

        $validatedData = $request->validate([
            'input' => 'required'
        ]);

        $name = $input[0];
        $age = $input[1];
        $city = $input[2];

        DB::table('posts')->insert([
            'name' => $name,
            'age' => $age,
            'city' => $city
        ]);

        return redirect()->route('posts.index');
    }
}

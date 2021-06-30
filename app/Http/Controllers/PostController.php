<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Repository\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        $this->postRepository->create($request->all());
        return redirect()->route('posts.index');
    }
}

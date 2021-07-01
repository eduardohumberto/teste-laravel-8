<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Repository\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();

        if ($request->image->isValid()) {
            $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();

            $data['image'] = $request->image->storeAs('posts', $nameFile);
        }

        $this->postRepository->create($data);
        return redirect()->route('posts.index')
            ->with('message', 'Post criado com sucesso');
    }

    public function show($id)
    {
        $post = $this->postRepository->find($id);
        if (!$post) {
            return redirect()->route('posts.index');
        }

        return view('admin.posts.show', compact('post'));
    }

    public function destroy($id)
    {
        $post = $this->postRepository->find($id);
        if (!$post) {
            return redirect()->route('posts.index');
        }

        if (Storage::exists($post->image))
            Storage::delete($post->image);

        $this->postRepository->delete($post);

        return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso');
    }

    public function edit($id)
    {
        try {
            $post = $this->postRepository->find($id);
        } catch (\Exception $e) {
            return redirect()->route('posts.index');
        }

        return view('admin.posts.edit', compact('post'));
    }

    public function update(StoreUpdatePost $request, $id)
    {
        $data = $request->all();
        $post = $this->postRepository->find($id);

        if ($request->image && $request->image->isValid()) {
            if (Storage::exists($post->image))
                Storage::delete($post->image);

            $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();

            $data['image'] = $request->image->storeAs('posts', $nameFile);
        }

        $this->postRepository->update($id, $data);
        return redirect()->route('posts.index')->with('message', 'Post atualizado com sucesso');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $posts = $this->postRepository->search([
            'search' => $request->search
        ]);

        return view('admin.posts.index', compact('posts', 'filters'));
    }
}

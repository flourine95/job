<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\PostsImport;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = Post::query();
        $this->table = (new Post())->getTable();
        View::share('title', ucfirst($this->table));
    }

    public function index()
    {
        return view('admin.posts.index');
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        $this->model->create(request()->all());
        return redirect()->route('admin.posts.index');
    }

    public function importCSV(Request $request)
    {
        Excel::import(new PostsImport, $request->file('file'));
        return redirect()->route('admin.posts.index');
    }
}

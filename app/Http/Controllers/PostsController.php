<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\PostRequest;
use App\Post;
use Carbon\Carbon;

/**
 * Class PostsController
 *
 * @package App\Http\Controllers
 */
class PostsController extends Controller
{
    // must be signed in
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $posts = Post::latest();
        if ($month = $request->input('month')) {
            $posts->whereMonth('created_at', Carbon::parse($month)->month);
        }
        if ($year = request('year')) {
            $posts->whereYear('created_at', Carbon::parse($month)->year);
        }
        $posts = $posts->get();

        $archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at)desc')
            ->get();

        //return $archives;
        return \view('posts.index', [
            'archives' => $archives,
            'posts'    => $posts,
        ]);
    }

    /**
     * Shows single blog post
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        return \view('posts.show', compact('post'));
    }

    /**
     * Shows create blog post
     *
     * @return View
     */
    public function create(): View
    {
        return \view('posts.create');
    }

    /**
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        auth()->user()->publish(new Post(request(['title', 'body'])));

        return redirect('/');
    }
}


	





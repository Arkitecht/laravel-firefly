<?php

namespace Firefly\Http\Controllers;

use Firefly\Http\Requests\StorePostRequest;
use Firefly\Http\Requests\UpdatePostRequest;
use Firefly\Models\Discussion;
use Firefly\Models\Post;
use Firefly\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Instance of the discussion service.
     *
     * @var \Firefly\Services\PostService
     */
    public $postService;

    /**
     * Create a new instance of the controller.
     *
     * @param  \Firefly\Services\PostService  $service
     */
    public function __construct(PostService $postService)
    {
        $this->middleware('auth');

        $this->postService = $postService;
    }

    /**
     * Store the new post.
     *
     * @param  \Firefly\Http\Requests\StorePostRequest  $request
     * @param  \Firefly\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request, Discussion $discussion)
    {
        $this->authorize('reply', $discussion);

        $post = $this->postService->make($request, $discussion);

        return redirect()->route('firefly.discussion.show', [$discussion->id, $discussion->slug]);
    }

    /**
     * Show the form for editing a post.
     *
     * @param  \Firefly\Models\Group  $group
     * @param  \Firefly\Models\Post  $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('firefly::posts.edit')->withPost($post);
    }

    /**
     * Update the specified post.
     *
     * @param  \Firefly\Http\Requests\UpdatePostRequest  $request
     * @param  \Firefly\Models\Discussion  $discussion
     * @param $slug
     * @param  \Firefly\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Discussion $discussion, $slug, Post $post)
    {
        $this->authorize('update', $post);

        $this->postService->update($request, $post);

        return redirect()->route('firefly.discussion.show', [$discussion->id, $discussion->slug]);
    }

    /**
     * Delete the specified post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Firefly\Models\Discussion  $discussion
     * @param $slug
     * @param  \Firefly\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, Discussion $discussion, $slug, Post $post)
    {
        $this->authorize('delete', $post);

        $this->postService->delete($post);

        return redirect()->route('firefly.discussion.show', [$discussion->id, $discussion->slug]);
    }
}

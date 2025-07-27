<?php

namespace App\Http\Controllers\Admin\Comments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comments\AdminCommentStatusChangeRequest;
use App\Http\Resources\Admin\Comments\AdminCommentsIndexResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = AdminCommentsIndexResource::collection(Comment::latest()->paginate(30));
        return Inertia::render('Admin/pages/Comments/index', ['commentsData' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function change_status(AdminCommentStatusChangeRequest $request)
    {
        Comment::whereId($request->id)->update([
            'approved' => $request->status,
        ]);
        return response()->json('success', 200);
    }

    public function search(string $search)
    {
        if ($search != '***')
            return response()->json(AdminCommentsIndexResource::collection(Comment::where('comment', 'LIKE', '%' . $search . '%')->latest()->paginate(20)));
        else
            return response()->json(AdminCommentsIndexResource::collection(Comment::latest()->paginate(20)));
    }
}

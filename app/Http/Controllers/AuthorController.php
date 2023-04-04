<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $authors = Author::all();

        return response()->json($authors);
    }

//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Models\Author  $author
//     * @return \Illuminate\Http\Response
//     */
//    public function show(Author $author)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Models\Author  $author
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Author $author)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Models\Author  $author
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Author $author)
//    {
//        //
//    }
}

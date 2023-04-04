<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\JsonResponse;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $genres = Genre::all();

        return response()->json($genres);
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
//     * @param  \App\Models\Genre  $genre
//     * @return \Illuminate\Http\Response
//     */
//    public function show(Genre $genre)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Models\Genre  $genre
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Genre $genre)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Models\Genre  $genre
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Genre $genre)
//    {
//        //
//    }
}

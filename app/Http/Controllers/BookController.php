<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller //todo: middleware
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        // Set default values for pagination parameters
        $perPage = $request->input('perPage', 10);
        $page = $request->input('page', 1);

        // Get a collection of books, paginated with the given parameters
        $booksQuery = Book::with('author', 'genres');

        // Search
        $search = $request->input('searchTerm');
        if ('' != $search) {
            $booksQuery->where('title', 'like', "%$search%")
                ->orWhereHas('author', function ($query) use ($search) {
                    $query->whereRaw('concat(first_name, " ", last_name) like ?', ["%$search%"]);
                })
                ->orWhereHas('genres', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                });
        }

        $books = $booksQuery->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        // Return the books as a JSON response
        return response()->json([
            'books' => $books->items(),
            'total' => $books->total(),
            'perPage' => $books->perPage(),
            'currentPage' => $books->currentPage(),
            'lastPage' => $books->lastPage(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BookStoreRequest $request
     * @return JsonResponse
     */
    public function store(BookStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $book = new Book($validated);
        $book->save();

        $book->genres()->attach($validated['genre_ids']);

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        $book->load('author', 'genres');

        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BookUpdateRequest $request
     * @param Book $book
     * @return JsonResponse
     */
    public function update(BookUpdateRequest $request, Book $book): JsonResponse
    {
        $validated = $request->validated();

        $book->update($validated);
        $book->genres()->sync($validated['genre_ids']);


        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function destroy(Book $book): JsonResponse
    {
        if (Gate::denies('delete-book')) {
            abort(403);
        }

        $book->delete();

        return response()->json([
            'message' => 'The book has been deleted.'
        ]);
    }
}

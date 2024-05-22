<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Models\Rentals;
use GuzzleHttp\Psr7\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json(["data" => $books]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $book = new Book($request->all());
        $book->save();
        return response()->json($book);
    }

    public function renting(Request $request, string $id)
    {
        $book = Book::find($id);
        if (is_null($book)){
            return response()-> json(["message" => "Book not found with id: $id"], 404);
        }
        $rentals = Rentals::where([
            ["book_id", $id],
            ["start_date", "<=", date("Y-m-d")],
            ["end_date", ">", date("Y-m-d")],
        ])->get();

        if(!$rentals->isEmpty()){
            return response()->json(["message" => "The book is currently rented"], 409);
        }

        $rental = new Rentals();
        $rental->book_id = $id;
        $rental->start_date = date("Y-m-d");
        $rental->end_date = date("Y-m-d", strtotime("+1 week"));
        $rental->save();

        return response()->json($rental, 201);
    }
}

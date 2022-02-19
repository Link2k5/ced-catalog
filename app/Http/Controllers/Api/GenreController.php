<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use function response;

class GenreController extends Controller
{
    private $rules = [
        'name' => 'required|max:255',
        'is_active' => 'boolean'
    ];

    public function index(): Collection
    {
        return Genre::all();
    }

    public function show(Genre $genre): Genre
    {
        return $genre;
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
        return Genre::create($request->all());
    }

    public function update(Request $request, Genre $genre): Genre
    {
        $this->validate($request, $this->rules);

        $genre->updateOrFail($request->all());

        return $genre;
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->noContent();
    }
}

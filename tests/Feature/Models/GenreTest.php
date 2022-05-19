<?php

namespace Tests\Feature\Models;

use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class GenreTest extends TestCase
{
    use RefreshDatabase;

    private $genre;

    public function setUp() :void
    {
        parent::setUp();

        $this->genre = new Genre();
    }

    /** @test */
    public function list_all_categories()
    {
        $this->genre->factory()->create();

        $this->assertCount(1, Genre::all());
    }

    /** @test */
    public function test_if_genre_has_attributes()
    {
        $attributes = [
            'id',
            'name',
            'is_active',
            'created_at',
            'updated_at',
            'deleted_at'
        ];

        $fakeGenre = $this->genre
            ->factory()
            ->create()
            ->first();

        $genreAttributes = array_keys($fakeGenre->getAttributes());
        $this->assertEqualsCanonicalizing($attributes, $genreAttributes);
    }

    /** @test */
    public function test_if_a_genre_can_be_created()
    {
        $data = [
            'name' => 'Novo gênero',
            'is_active' => true,
        ];
        $newGenre = $this->genre->create($data);

        foreach($data as $key => $value) {
            $this->assertEquals($value, $newGenre->{$key});
        }
    }

    public function test_if_description_is_nullable()
    {
        $newGenre = $this->genre->create([
            'name' => 'Novo Gênero'
        ]);

        $this->assertNull($newGenre->description);
    }

    public function test_if_is_active_is_false()
    {
        $newGenre = $this->genre->factory()->create([
            'is_active' => false,
        ]);

        $this->assertFalse($newGenre->is_active);
    }

    /** @test */
    public function test_if_a_genre_can_be_updated()
    {
        $newGenre = $this->genre->factory()->create();
        $data = [
            'name' => 'Gênero atualizado',
            'is_active' => true,
        ];
        $newGenre->update($data);

        foreach($data as $key => $value) {
            $this->assertEquals($value, $newGenre->{$key});
        }
    }

    /** @test */
    public function test_if_id_has_a_valid_uuid()
    {
        $newGenre = Genre::factory()->create();

        // TODO É viável colocar um cast no Model para sempre retornar uma string ao chamar o id?
        $this->assertTrue(Str::isUuid((string) $newGenre->id));
    }
}

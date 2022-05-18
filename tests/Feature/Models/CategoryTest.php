<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private $category;

    public function setUp() :void
    {
        parent::setUp();

        $this->category = new Category();
    }

    /** @test */
    public function list_all_categories()
    {
        $this->category->factory()->create();

        $this->assertCount(1, Category::all());
    }

    /** @test */
    public function test_if_category_has_attributes()
    {
        $attributes = [
            'id',
            'name',
            'description',
            'is_active',
            'created_at',
            'updated_at',
            'deleted_at'
        ];

        $fakeCategory = $this->category
                ->factory()
                ->create()
                ->first();

        $categoryAttributes = array_keys($fakeCategory->getAttributes());
        $this->assertEqualsCanonicalizing($attributes, $categoryAttributes);
    }

    /** @test */
    public function test_if_a_category_can_be_created()
    {
        $newCategory = $this->category->create([
            'name' => 'Nova categoria',
            'description' => 'Descrição da categoria',
            'is_active' => true,
        ]);

        foreach($newCategory as $key => $value) {
            $this->assertEquals($value, $newCategory->{$key});
        }

        $this->assertTrue($newCategory->is_active);
    }

    public function test_if_description_is_nullable()
    {
        $newCategory = $this->category->create([
            'name' => 'Nova categoria'
        ]);

        $this->assertNull($newCategory->description);
    }

    public function test_if_is_active_is_false()
    {
        $newCategory = $this->category->factory()->create([
            'is_active' => false,
        ]);

        $this->assertFalse($newCategory->is_active);
    }

    /** @test */
    public function test_if_a_category_can_be_updated()
    {
        $newCategory = $this->category->factory()->create();
        $data = [
            'name' => 'Categoria atualizada',
            'description' => 'Descrição atualizada',
            'is_active' => true,
        ];
        $newCategory->update($data);

        foreach($data as $key => $value) {
            $this->assertEquals($value, $newCategory->{$key});
        }
    }

    /** @test */
    public function test_if_id_has_a_valid_uuid()
    {
        $newCategory = Category::factory()->create();
        $this->assertTrue(Str::isUuid((string) $newCategory->id));
    }
}

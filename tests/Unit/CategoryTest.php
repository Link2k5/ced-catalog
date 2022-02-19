<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testFillable()
    {
        $fillable = ['name', 'description', 'is_active'];
        $category = new Category();
        $this->assertEquals($fillable, $category->getFillable());
    }

    public function testIfUsingTraits()
    {
        $traits = [
            SoftDeletes::class,
            HasFactory::class,
            HasUuid::class
        ];

        $category_traits = array_keys(class_uses(Category::class));

        $this->assertEquals($traits, $category_traits);
    }

    public function testIncrementingAttribute()
    {
        $category = new Category();

        $this->assertFalse($category->incrementing);
    }

    public function testDatesAttribute()
    {
        $category = new Category();
        $dates = ['created_at', 'updated_at', 'deleted_at'];

        foreach($dates as $date) {
            $this->assertContains($date, $category->getDates());
        }

        $this->assertCount(count($dates), $category->getDates());
    }

    public function testIfKeyTypeIsAString()
    {
        $category = new Category();

        $this->assertEquals('string', $category->getKeyType());
    }
}

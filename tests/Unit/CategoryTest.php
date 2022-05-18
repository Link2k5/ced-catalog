<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    private $category;

    public function setUp() : void
    {
        parent::setUp();
        $this->category = new Category;

    }
    public function testFillable()
    {
        $fillable = ['name', 'description', 'is_active'];
        $this->assertEquals($fillable, $this->category->getFillable());
    }

    public function testIfUsingTraits()
    {
        $traits = [
            SoftDeletes::class,
            HasFactory::class,
            HasUuid::class
        ];

        $category_traits = array_keys(class_uses($this->category));

        $this->assertEquals($traits, $category_traits);
    }

    public function testIncrementingAttribute()
    {
        $this->assertFalse($this->category->incrementing);
    }

    public function testDatesAttribute()
    {
        $dates = ['created_at', 'updated_at', 'deleted_at'];

        foreach($dates as $date) {
            $this->assertContains($date, $this->category->getDates());
        }

        $this->assertCount(count($dates), $this->category->getDates());
    }

    public function testIfKeyTypeIsAString()
    {
        $this->assertEquals('string', $this->category->getKeyType());
    }
}

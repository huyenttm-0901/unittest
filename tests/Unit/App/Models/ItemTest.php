<?php

namespace Tests\Unit\App\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Item;
use App\Models\User;

class ItemTest extends TestCase
{
    protected $item;

    protected function setUp(): void
    {
        $this->item = new Item();
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->item);
        parent::tearDown();
    }

    public function test_fillable()
    {
        $this->assertEquals([
            'name',
	    	'quantity',
	    	'description',
	    	'user_id',
        ], $this->item->getFillable());
    }

    public function test_table()
    {
        $this->assertEquals('items', $this->item->getTable());
    }

    public function test_incrementing_key()
    {
        $this->assertEquals(['id' => 'int'], $this->item->getCasts());
    }

    public function test_date()
    {
        $this->assertEquals(['created_at', 'updated_at'], $this->item->getDates());
    }

    public function test_belongsTo_user()
    {
        $relation = $this->item->user();
        $relation_model = $relation->getRelated();
        $key = $this->item->getKeyName();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertInstanceOf(User::class, $relation_model);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals($key, $relation->getOwnerKeyName());
    }
}

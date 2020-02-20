<?php

namespace Tests\Unit\App\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use App\Http\Controllers\ItemController;
use App\Models\Item;
use App\Repositories\ItemRepositoryInterface;
use Mockery;

class ItemControllerTest extends TestCase
{
	protected $itemRepositoryMock;

    public function setUp(): void
    {
    	$this->itemRepositoryMock = Mockery::mock(ItemRepositoryInterface::class . '[create, destroy]');
        parent::setUp();
    }

    public function tearDown(): void
    {
        unset($this->controller);
        parent::tearDown();
    }

    public function test_index()
    {
    	$this->itemRepositoryMock->shouldReceive('getAll')
            ->once()
            ->andReturn(new Collection(array(new Item, new Item)));

    	$controller = new ItemController($this->itemRepositoryMock);
    	$result = $controller->index();
    	$data = $result->getData();

        $this->assertEquals('items.list', $result->getName());
        $this->assertArrayHasKey('items', $result->getData());
        $this->assertInstanceOf(Collection::class, $data['items']);
        $this->assertInstanceOf(Item::class, $data['items']->all()[0]);
    }


}

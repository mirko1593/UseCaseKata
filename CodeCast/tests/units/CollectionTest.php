<?php 

use CodeCast\Support\Collection;

class CollectionTest extends PHPUnit\Framework\TestCase
{
    /** @test */
    public function can_create_a_collection_from_an_empty_array()
    {
        $collection = new Collection([]);

        $this->assertEquals(0, $collection->size());
    }   

    /** @test */
    public function can_cast_items_to_array()
    {
        $collection = new Collection(['A', 'B', 'C']);

        $this->assertEquals(['A', 'B', 'C'], $collection->toArray());
    }

    /** @test */
    public function can_visit_each_element_in_collection()
    {
        $sum = 0;
        $items = range(1, 10);

        $result = collect($items)->each(function ($i) use (&$sum) {
            $sum += $i;
        });

        $this->assertEquals(55, $sum);
        $this->assertEquals(10, $result->size());
    } 

    /** @test */
    public function can_append_item_to_collection_like_array()
    {
        $collection = collect(['A', 'B']);

        $collection[] = 'C';

        $this->assertEquals(['A', 'B', 'C'], $collection->toArray());
    }

    /** @test */
    public function can_filter_item_in_collection()
    {
        $collection = collect(range(1, 10));

        $collection = $collection->filter(function ($item) {
            return $item <= 5;
        });

        $this->assertEquals(range(1, 5), $collection->all());
    }
}
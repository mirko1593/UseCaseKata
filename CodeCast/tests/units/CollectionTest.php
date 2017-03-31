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

    /** @test */
    public function can_map_elems_in_collection()
    {
        $collection = collect(['a', 'b', 'c']);

        $collection = $collection->map(function ($e) {
            return strtoupper($e);
        });

        $this->assertEquals(['A', 'B', 'C'], $collection->all());
    }

    /** @test */
    public function can_sort_items_with_user_defined_sort()
    {
        $collection = collect([
            (object) ['age' => 24], 
            (object) ['age' => 20], 
            (object) ['age' => 31]
        ]);

        $collection = $collection->sort(function ($item1, $item2) {
            return $item1->age <=> $item2->age;
        });

        $this->assertEquals([20, 24, 31], $collection->map(function ($item) {
            return $item->age;
        })->toArray());
    }

    /** @test */
    public function can_delete_an_item_by_key()
    {
        $collection = collect([
            'age' => 24, 
            'name' => 'kobe'
        ]);

        $collection->delete('age');

        $this->assertEquals(['name' => 'kobe'], $collection->toArray());
    }

    /** @test */
    public function can_delete_items_satisfy_condition()
    {
        $collection = collect([1, 2, 3, 4, 5]);

        $collection->delete(function ($item) { return $item > 3; });

        $this->assertEquals([1, 2, 3], $collection->toArray());
    }
}
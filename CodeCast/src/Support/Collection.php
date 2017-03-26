<?php 

namespace CodeCast\Support;

class Collection
{
    protected $items;

    public function __construct($items = [])
    {
        $this->items = $items;
    }

    public function size()
    {
        return sizeof($this->items);
    }

    public function toArray()
    {
        return $this->items;
    }

    public function each(callable $callback)
    {
        foreach ($this->items as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }
}
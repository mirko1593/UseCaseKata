<?php 

namespace CodeCast\Support;

use ArrayAccess;

class Collection implements ArrayAccess
{
    protected $items;

    public function __construct($items = [])
    {
        $this->items = $items;
    }

    public function all()
    {
        return $this->items;
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

    public function filter(callable $callback)
    {
        if ($callback) {
            return new static(array_filter($this->items, $callback));
        }

        return new static(array_filter($this->items));
    }

    public function map(callable $callback)
    {
        $keys = array_keys($this->items);

        $items = array_map($callback, array_values($this->items), $keys);

        return new static(array_combine($keys, $items));
    }

    public function first()
    {
        return $this->size() > 0 ? $this->items[0] : null;
    }

    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    public function offsetExists($key)
    {
        return array_key_exists($key, $this->items);
    }

    public function offsetUnset($key)
    {
        unset($this->items[$key]);
    }
}
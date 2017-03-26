<?php 

namespace CodeCast\Gateway;

class MockGateway implements Gateway
{
    protected $codeCasts;

    public function __construct($codeCasts = [])
    {
        $this->codeCasts = collect($codeCasts);
    }

    public function findAllCodeCasts()
    {
        return $this->codeCasts;
    }

    public function save($codeCast)
    {
        return $this->codeCasts[] = $codeCast;   
    }

    public function delete($codeCast)
    {
        $this->codeCasts = $this->codeCasts->filter(function ($item) use ($codeCast) {
            return $item != $codeCast;
        });
    }
}
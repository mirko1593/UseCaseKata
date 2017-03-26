<?php 

namespace CodeCast\Gateway;

class MockGateway implements Gateway
{
    public function findAllCodeCasts()
    {
        return collect();
    }
}
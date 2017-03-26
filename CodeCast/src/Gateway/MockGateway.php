<?php 

namespace CodeCast\Gateway;

class MockGateway implements Gateway
{
    protected $codeCasts;

    protected $users;

    public function __construct($codeCasts = [], $users = [])
    {
        $this->codeCasts = collect($codeCasts);
        $this->users = collect($users);
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

    public function saveUser($user)
    {
        $this->users[] = $user;
    }

    public function findUser($username)
    {
        return $this->users->filter(function ($user) use ($username) {
            return $username === $user->getUsername();
        });
    }
}
<?php 

namespace CodeCast\Gateway;

class MockGateway implements Gateway
{
    protected $codeCasts;

    protected $users;

    protected $licences;

    public function __construct($codeCasts = [], $users = [], $licences = [])
    {
        $this->codeCasts = collect($codeCasts);
        $this->users = collect($users);
        $this->licences = collect($licences);
    }

    public function findAllCodeCasts()
    {
        return $this->codeCasts;
    }

    public function saveManyCodeCasts($codeCasts)
    {
        $codeCasts->each(function ($codeCast) {
            $this->save($codeCast);
        });

        return $codeCasts;
    }

    public function save($codeCast)
    {
        $this->codeCasts[] = $codeCast->establishId();   
        return $codeCast;
    }

    public function delete($codeCast)
    {
        $this->codeCasts = $this->codeCasts->filter(function ($item) use ($codeCast) {
            return $item != $codeCast;
        });
    }

    public function saveUser($user)
    {
        $this->users[] = $user->establishId();
        return $user;
    }

    public function findUser($username)
    {
        return $this->users->filter(function ($user) use ($username) {
            return $username === $user->getUsername();
        })->first();
    }

    public function findCodeCastByTitle($title)
    {
        return $this->codeCasts->filter(function ($codeCast) use ($title) {
            return $codeCast->getTitle() === $title;
        })->values()->first();
    }

    public function saveLicence($licence)
    {
        $this->licences[] = $licence->establishId();
        return $licence;
    }

    public function findLicenceForUserAndCodeCast($user, $codeCast)
    {
        return $this->licences->filter(function ($licence) use ($user, $codeCast) {
            return $licence->getUser()->isSame($user)
                &&  $licence->getCodeCast()->isSame($codeCast);
        });
    }

    public function findCodeCastByPermalink($permalink)
    {
        return $this->codeCasts->filter(function ($CodeCast) use ($permalink) {
            return $CodeCast->getPermalink() === $permalink;
        })->first();
    }
}
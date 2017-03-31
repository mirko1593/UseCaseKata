<?php 

use CodeCast\Entities\NullCodeCast;
use CodeCast\Gateway\CodeCastGateway;

class InMemoryCodeCastGateway implements CodeCastGateway
{
    protected $codeCasts;

    public function __construct()
    {
        $this->codeCasts = collect();
    }

    public function save($codeCast)
    {
        if (is_null($codeCast->getId())) {
            $this->establishId($codeCast);
        }

        return $this->codeCasts[$codeCast->getId()] = $codeCast;
    }

    public function delete($codeCast)
    {
        $this->codeCasts->delete($codeCast->getId());
    }

    public function findAllCodeCasts()
    {
        return $this->codeCasts;
    }

    public function findCodeCastByTitle($title)
    {
        return $this->codeCasts->values()->filter(function ($codeCast) use ($title) {
            return $codeCast->getTitle() === $title;
        })->values()->first();
    }

    public function findCodeCastByPermalink($permalink)
    {
        return $this->codeCasts->values()->filter(function ($codeCast) use ($permalink) {
            return $codeCast->getPermalink() === $permalink;
        })->first() ?? new NullCodeCast;        
    }

    public function saveManyCodeCasts($codeCasts)
    {
        $codeCasts->each(function ($codeCast) {
            $this->save($codeCast);
        });

        return $codeCasts;        
    }

    protected function establishId(&$entity)
    {
        $entity->setId($this->randomId());
    }

    protected function randomId($length = 16)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['=', '+', '-'], '', base64_encode($bytes)), 0, $size);
        }

        return $string;  
    }
}
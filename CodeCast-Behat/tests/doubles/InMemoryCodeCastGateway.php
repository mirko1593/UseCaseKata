<?php 

use CodeCast\Gateway\CodeCastGateway;

class InMemoryCodeCastGateway implements CodeCastGateway
{
    protected $codeCasts;

    public function __construct($codeCasts = null)
    {
        $this->codeCasts = $codeCasts ?? collect();
    }

    public function clearCodeCasts()
    {
        $this->codeCasts = collect();
    }

    public function save($codeCast)
    {
        if (is_null($codeCast->getId())) {
            $this->establishId($codeCast);
        }
        
        return $this->codeCasts[] = $codeCast;
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

    public function findCodeCastByTitle($title)
    {
        return $this->codeCasts->filter(function ($codeCast) use ($title) {
            return $codeCast->getTitle() === $title;
        })->first();
    }

    public function findAllCodeCasts()
    {
        return $this->codeCasts;
    }
}
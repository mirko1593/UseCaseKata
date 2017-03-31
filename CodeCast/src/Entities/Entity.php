<?php 

namespace CodeCast\Entities;

class Entity 
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function isSame($entity)
    {
        return !is_null($this->getId()) && ($this->getId() === $entity->getId());
    }

    public function establishId()
    {
        $this->setId($this->randomId());

        return $this;
    }

    public function randomId($length = 16)
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
<?php 

use CodeCast\Gateway\LicenceGateway;

class InMemoryLicenceGateway implements LicenceGateway
{
    protected $licences;  

    public function __construct()
    {
        $this->licences = collect();
    }

    public function save($licence) 
    {
        if (is_null($licence)) {
            $this->establishId($licence);
        }

        return $this->licences[$licence->getId()] = $licence;
    }

    public function findLicenceForUserAndCodeCast($user, $codeCast)
    {
        return $this->licences->filter(function ($licence) use ($user, $codeCast) {
            return $licence->getUser()->isSame($user)
                &&  $licence->getCodeCast()->isSame($codeCast);
        });
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
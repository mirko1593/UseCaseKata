<?php 

use CodeCast\Gateway\LicenceGateway;

class InMemoryLicenceGateway implements LicenceGateway
{
    protected $licences;

    public function __construct($licences = null)
    {
        $this->licences = $licences ?? collect();
    }

    public function save($licence)
    {
        if (is_null($licence->geTId())) {
            $this->establishId($licence);
        }

        return $this->licences[] = $licence;
    }

    public function findLicenceByUserAndCodeCast($user, $codeCast)
    {
        return $this->licences->filter(function ($licence) use ($user, $codeCast) {
            return $user->isSame($licence->getUser()) 
                && $codeCast->isSame($licence->getCodeCast());
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
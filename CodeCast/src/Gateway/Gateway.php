<?php 

namespace CodeCast\Gateway;

interface Gateway
{
    public function findAllCodeCasts();

    public function save($item);

    public function delete($item);

    public function saveUser($user);

    public function findUser($username);

    public function findCodeCastByTitle($title);

    public function saveLicence($licence);

    public function findLicenceForUserAndCodeCast($user, $codeCast);
}
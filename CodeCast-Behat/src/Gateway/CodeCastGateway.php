<?php 

namespace CodeCast\Gateway;

interface CodeCastGateway
{
    public function clearCodeCasts();

    public function save($codecast);

    public function findCodeCastByTitle($title);

    public function findAllCodeCasts();

    public function findCodeCastByPermalink($permalink);
}
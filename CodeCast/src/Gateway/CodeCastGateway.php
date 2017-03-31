<?php 

namespace CodeCast\Gateway;

interface CodeCastGateway
{
    public function save($codeCast);

    public function delete($codeCast);

    public function findAllCodeCasts();

    public function findCodeCastByTitle($title);

    public function findCodeCastByPermalink($permalink);

    public function saveManyCodeCasts($codeCasts);
}
<?php 

use CodeCast\Context;
use CodeCast\Entities\Entity;
use CodeCast\Gateway\MockGateway;

class EntityTest extends PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        parent::setUp();
        Context::$gateway = new MockGateway;
    }

    /** @test */
    public function entities_with_different_username_is_not_the_same_entity()
    {
        $entity1 = new Entity();
        $entity2 = new Entity();

        $this->assertFalse($entity1->isSame($entity2));
    }    

    /** @test */
    public function one_entity_is_same_to_itself()
    {
        $entity = new Entity();
        $entity->establishId();

        $this->assertTrue($entity->isSame($entity));
    }

    /** @test */
    public function entities_with_same_id_are_the_same()
    {
        $entity1 = new Entity();
        $entity2 = new Entity();
        $entity1->setId('SameID');
        $entity2->setId('SameID');

        $this->assertTrue($entity1->isSame($entity2));        
    }

    /** @test */
    public function entity_with_null_id_is_not_same_to_anyone()
    {
        $entity = new Entity();
        $otherEntity = new Entity();
        $otherEntity->establishId();

        $this->assertFalse($entity->isSame($entity));
        $this->assertFalse($entity->isSame($otherEntity));
    }
}
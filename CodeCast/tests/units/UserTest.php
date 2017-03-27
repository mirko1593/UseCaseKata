<?php 

use CodeCast\{User, Context};
use CodeCast\Gateway\MockGateway;

class UserTest extends PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        parent::setUp();
        Context::$gateway = new MockGateway;
    }

    /** @test */
    public function users_with_different_username_is_not_the_same_user()
    {
        $user1 = new User('User1');
        $user2 = new User('User2');

        $this->assertFalse($user1->isSame($user2));
    }    

    /** @test */
    public function one_user_is_same_to_itself()
    {
        $user = new User('User');
        Context::$gateway->saveUser($user);

        $this->assertTrue($user->isSame($user));
    }

    /** @test */
    public function user_can_establish_id_to_itself()
    {
        $user = new User('User');
        $user->establishId();

        $this->assertNotNull($user->getId());
    }

    /** @test */
    public function users_with_same_id_are_the_same()
    {
        $user1 = new User('User1');
        $user2 = new User('User2');
        $user1->setId('u1ID');
        $user2->setId('u1ID');

        $this->assertTrue($user1->isSame($user2));        
    }

    /** @test */
    public function user_with_null_id_is_not_same_to_anyone()
    {
        $user = new User('User');
        $otherUser = new User('OtherUser');

        $this->assertFalse($user->isSame($user));
        $this->assertFalse($user->isSame($otherUser));
    }
}
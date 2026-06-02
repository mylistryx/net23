<?php

namespace tests\unit\models;

use app\models\Identity\Identity;
use Codeception\Test\Unit;

class UserTest extends Unit
{
    public function testFindUserById(): void
    {
        verify($user = Identity\Identity::findIdentity(100))->notEmpty();
        verify($user->username)->equals('admin');

        verify(Identity\Identity::findIdentity(999))->empty();
    }

    public function testFindUserByAccessToken(): void
    {
        verify($user = Identity\Identity::findIdentityByAccessToken('100-token'))->notEmpty();
        verify($user->username)->equals('admin');

        verify(Identity\Identity::findIdentityByAccessToken('non-existing'))->empty();
    }

    public function testFindUserByUsername(): void
    {
        verify(Identity\Identity::findByUsername('admin'))->notEmpty();
        verify(Identity\Identity::findByUsername('not-admin'))->empty();
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser(): void
    {
        $user = Identity\Identity::findByUsername('admin');
        verify($user->validateAuthKey('test100key'))->notEmpty();
        verify($user->validateAuthKey('test102key'))->empty();

        verify($user->validatePassword('admin'))->notEmpty();
        verify($user->validatePassword('123456'))->empty();
    }
}

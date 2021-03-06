<?php

namespace Battis\SharedLogs\Tests\Objects;

use Battis\SharedLogs\AbstractObject;
use Battis\SharedLogs\Exceptions\ObjectException;
use Battis\SharedLogs\Objects\User;
use Battis\SharedLogs\Tests\AbstractObjectTest;

class UserTest extends AbstractObjectTest
{
    protected $user;

    protected function setUp()
    {
        parent::setUp();
        $this->user = self::$records['users'][0];
    }

    public function testInvalidInstantiation()
    {
        $this->expectException(ObjectException::class);
        $this->expectExceptionCode(ObjectException::MISSING_DATABASE_RECORD);
        $u = new User("foo bar");
    }

    public function testInstantiation()
    {
        $u = new User($this->user);
        $this->assertInstanceOf(User::class, $u);
        $this->reconcileFields($this->user, $u);

        return $u;
    }

    /**
     * @depends testInstantiation
     */
    public function testJsonSerialization(AbstractObject $u)
    {
        $json = json_encode($u);
        $this->assertJson($json);
        $this->assertJsonStringEqualsJsonFile(self::$jsonDir . '/user.json', $json);
    }
}

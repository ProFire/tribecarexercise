<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\Visitor;
use Cake\Chronos\Chronos;
use Cake\TestSuite\TestCase;

class VisitorTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testIsCheckedOut(): void
    {
        $visitorEntity = new Visitor();

        $this->assertFalse($visitorEntity->isCheckedOut());

        $visitorEntity->check_out = Chronos::now();
        $this->assertTrue($visitorEntity->isCheckedOut());
    }
}
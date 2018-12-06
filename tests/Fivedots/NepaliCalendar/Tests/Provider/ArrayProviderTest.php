<?php

namespace Fivedots\NepaliCalendar\Tests\Provider;

use PHPUnit\Framework\TestCase;
use Fivedots\NepaliCalendar\Provider\ArrayProvider;

class ArrayProviderTest extends TestCase
{
    /**
     * @var ArrayProvider
     */
    private $provider;

    protected function setUp()
    {
        $this->provider = new ArrayProvider();
    }

    public function testGetData()
    {
        $expected = array(2007, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31);
        $found = $this->provider->getData(2007);

        $this->assertEquals($expected, $found);
    }

    /**
     * @expectedException \Fivedots\NepaliCalendar\CalendarException
     */
    public function testGetDataException()
    {
        $this->provider->getData(3050);
    }

    public function testIsValidDate()
    {
        $this->assertTrue($this->provider->isValidDate(2007, 1, 31));
    }

    public function testIsValidDateFail()
    {
        $this->assertFalse($this->provider->isValidDate(2043,11,31));
    }
}

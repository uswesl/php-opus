<?php

namespace capesesp;

use capesesp\Arguments;

class ArgumentsTest extends \PHPUnit_Framework_TestCase
{
    public function testValidInput()
    {
        $this->assertTrue(Arguments::validate("123", true, ["string"]));
        $this->assertTrue(Arguments::validate([123], true, ['string', 'array']));
        $this->assertTrue(Arguments::validate("123", true, ['string', 'array']));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidInput()
    {
        $this->assertTrue(Arguments::validate(123, true, ["array"]));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidInputForManyTypes()
    {
        $this->assertTrue(Arguments::validate(false, true, ["array", "string"]));
    }

    public function testValidateAssociativeArray()
    {
        $this->assertTrue(Arguments::validateAssociativeArray(["a" => 1, "b" => 2]));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testValidateAssociativeArrayInvalid()
    {
        $this->assertTrue(Arguments::validateAssociativeArray(["a", "b"]));
    }
}

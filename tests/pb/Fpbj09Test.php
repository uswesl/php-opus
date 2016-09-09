<?php

namespace capesesp;

use capesesp\pb\Fpbj09;
use capesesp\json\OpusJsonTestCase;

class Fpbj09 extends OpusJsonTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->schemaPath = './src/pb/schemas/fpbj09.schema.json';
    }

    public function testSchema()
    {
        $args = array(201512, 0, 100, 1);
        $jsonObj = Fpbj09::executa($args);
        $this->assertSchema($jsonObj, $this->schemaPath, $args);
    }


}

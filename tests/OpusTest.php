<?php

namespace capesesp;

use capesesp\OpusJson;
use capesesp\OpusJsonTestCase;

class OpusTest extends OpusJsonTestCase
{
    public function testJsonObject()
    {
        $json_obj = OpusJson::executa('fucj01', '903626 0');
        $this->assertTrue(is_object($json_obj));
    }

    public function testJsonString()
    {
        $json_obj = OpusJson::executa('fucj01', '903626 0', false);
        $this->assertTrue(is_string($json_obj));
    }
}

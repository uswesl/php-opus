<?php

namespace capesesp;

use capesesp\util\XmlSerializer;

class XmlSerializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getTests
     */
    public function testSerializer($obj, $expectedXml)
    {
        $this->assertEquals($expectedXml, XmlSerializer::toXml($obj));
    }

    public function getTests(){
        return [
            [
                (object)["a" => 1],
                "<a>1</a>"
            ],
            [
                (object)["a" => true],
                "<a>1</a>"
            ],
            [
                (object)["a" => false],
                "<a/>"
            ],
            [
                (object)["a" => 123.34],
                "<a>123.34</a>"
            ],
            [
                (object)["a" => (object)["b" => "1"]],
                "<a><b>1</b></a>"
            ],
            [
                (object)[
                    "a" => (object)[
                        "b" => ["1", "2"]
                    ]
                ],
                "<a><b>1</b><b>2</b></a>"
            ],
            [
                (object)[
                    "a" => (object)[
                        "b" => [
                            (object)["c" => "1", "d" => "2"],
                            (object)["c" => "3", "d" => "4"]
                        ]
                    ]
                ],
                "<a><b><c>1</c><d>2</d></b><b><c>3</c><d>4</d></b></a>"
            ],
            [
                (object)[
                    "a" => (object)[
                        "b" => [
                            (object)["c" => (object)["d" => "1", "e" => "1"], "f" => "1"],
                            (object)["c" => (object)["d" => "2", "e" => "2"], "f" => "2"],
                        ]
                    ]
                ],
                "<a><b><c><d>1</d><e>1</e></c><f>1</f></b><b><c><d>2</d><e>2</e></c><f>2</f></b></a>"
            ],
        ];
    }
}


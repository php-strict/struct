<?php
require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use \PhpStrict\Struct;

class StructEmptyExample extends Struct
{
    public $int = 0;
    public $flt = 0.0;
    public $str = '';
    public $bln = false;
    public $arr = [];
    public $obj = null;
}

class StructFilledExample extends Struct
{
    public $int = 1;
    public $flt = 2.3;
    public $str = 'test';
    public $bln = true;
    public $arr = ['value1', 'value2', 'value3'];
    public $obj = null;
}

class StructTest extends \Codeception\Test\Unit
{
    public function testStruct()
    {
        $struct = new StructFilledExample();
        $this->assertInstanceOf(Struct::class, $struct);
        $this->assertEquals(1, $struct->int);
        $this->assertEquals(2.3, $struct->flt);
        $this->assertEquals('test', $struct->str);
        $this->assertEquals(true, $struct->bln);
        $this->assertCount(3, $struct->arr);
        $this->assertNull($struct->obj);
        
        $data = [
            'int' => 1,
            'flt' => 2.3,
            'str' => 'test',
            'bln' => true,
            'arr' => ['value1', 'value2', 'value3'],
            'obj' => (object) ['field1' => 'value1', 'field2' => 'value2'],
        ];
        $json = <<<JSN
{
    "int": 1,
    "flt": 2.3,
    "str": "test",
    "bln": true,
    "arr": ["value1", "value2", "value3"],
    "obj": {"field1": "value1", "field2": "value2"}
}
JSN;
        
        $struct1 = new StructEmptyExample($data);
        $this->assertNotNull($struct1->obj);
        
        $struct2 = new StructEmptyExample();
        $this->assertNull($struct2->obj);
        $struct2->setFromArray($data);
        $this->assertEquals($struct1, $struct2);
        $this->assertEquals($data, $struct2->getArray());
        
        $struct3 = new StructEmptyExample();
        $struct3->set($struct2);
        $this->assertEquals($struct2, $struct3);
        $this->assertEquals($data, $struct3->getArray());
        
        $struct4 = new StructEmptyExample();
        $struct4->setFromJson($json);
        $this->assertEquals($struct3, $struct4);
        $this->assertEquals(['int', 'flt', 'str', 'bln', 'arr', 'obj'], $struct4->getFields());
        $this->assertEquals(json_encode(json_decode($json)), (string) $struct4);
    }
}

<?php
use \PhpStrict\Struct;
use \PhpStrict\StructInterface;

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
    protected function getDataArray(): array
    {
        return [
            'int' => 1,
            'flt' => 2.3,
            'str' => 'test',
            'bln' => true,
            'arr' => ['value1', 'value2', 'value3'],
            'obj' => (object) ['field1' => 'value1', 'field2' => 'value2'],
        ];
    }
    
    protected function getDataStringArray(): array
    {
        return [
            'int' => '1',
            'flt' => '2.3',
            'str' => 'test',
            'bln' => 'true',
            'arr' => ['value1', 'value2', 'value3'],
            'obj' => (object) ['field1' => 'value1', 'field2' => 'value2'],
        ];
    }
    
    protected function getDataJson(): string
    {
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
        return $json;
    }
    
    protected function testFields(StructInterface $struct, array $data)
    {
        $this->assertInstanceOf(Struct::class, $struct);
        $this->assertEquals($data['int'], $struct->int);
        $this->assertEquals($data['flt'], $struct->flt);
        $this->assertEquals($data['str'], $struct->str);
        $this->assertEquals($data['bln'], $struct->bln);
        $this->assertCount(count($data['arr']), $struct->arr);
        $this->assertEquals($data['arr'], $struct->arr);
        $this->assertEquals($data['arr'][1], ($struct->arr)[1]);
        $this->assertEquals($data['obj'], $struct->obj);
    }
    
    public function testStruct()
    {
        $data = $this->getDataArray();
        $struct = new StructFilledExample();
        $struct->obj = $data['obj'];
        $this->testFields($struct, $data);
    }
    
    public function testConstructWithArray()
    {
        $data = $this->getDataArray();
        
        $this->testFields(
            new StructEmptyExample($data), 
            $this->getDataArray()
        );
    }
    
    public function testConstructWithStruct()
    {
        $data = $this->getDataArray();
        $struct = new StructFilledExample();
        $struct->obj = $data['obj'];
        
        $this->testFields(
            new StructEmptyExample($struct), 
            $data
        );
    }
    
    public function testConstructWithJson()
    {
        $this->testFields(
            new StructEmptyExample($this->getDataJson()), 
            $this->getDataArray()
        );
    }
    
    public function testSetFromArray()
    {
        $data = $this->getDataArray();
        
        $struct1 = new StructEmptyExample($data);
        $this->assertNotNull($struct1->obj);
        
        $struct2 = new StructEmptyExample();
        $this->assertNull($struct2->obj);
        
        //with cast using typed data
        $struct2->setFromArray($data);
        $this->assertEquals($struct1, $struct2);
        $this->assertEquals($data, $struct2->getArray());
        
        //without cast using typed data
        $struct3 = new StructEmptyExample();
        $struct3->setFromArray($data, false);
        $this->assertEquals($struct1, $struct3);
        
        //with cast using string data
        $strData = $this->getDataStringArray();
        $struct4 = new StructEmptyExample();
        $struct4->setFromArray($strData);
        $this->assertEquals($struct1, $struct4);
        $this->assertEquals($data, $struct4->getArray());
        
        //without cast using string data
        $strData = $this->getDataStringArray();
        $struct5 = new StructEmptyExample();
        $struct5->setFromArray($strData, false);
        $this->assertNotEquals($struct1, $struct5);
        $this->assertNotEquals($data, $struct5->getArray());
        $this->assertEquals($strData, $struct5->getArray());
    }
    
    public function testSet()
    {
        $data = $this->getDataArray();
        
        $struct1 = new StructEmptyExample($data);
        
        $struct2 = new StructEmptyExample();
        $struct2->set($struct1);
        $this->assertEquals($struct1, $struct2);
        $this->assertEquals($data, $struct1->getArray());
    }
    
    public function testSetFromJson()
    {
        $data = $this->getDataArray();
        
        $struct1 = new StructEmptyExample($data);
        
        $json = $this->getDataJson();
        
        $struct2 = new StructEmptyExample();
        $struct2->setFromJson($json);
        $this->assertEquals($struct1, $struct2);
        $this->assertEquals(['int', 'flt', 'str', 'bln', 'arr', 'obj'], $struct2->getFields());
        $this->assertEquals(json_encode(json_decode($json)), (string) $struct2);
    }
}

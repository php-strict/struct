<?php
require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use \PhpStrict\Struct;
 
class StructTest extends \Codeception\Test\Unit
{
    public function testStruct()
    {
        $struct = new class() extends Struct {
            public $int = 1;
            public $flt = 2.3;
            public $str = 'test';
            public $bln = true;
            public $arr = ['key' => 'value'];
        };
        $this->assertInstanceOf(Struct::class, $struct);
        $this->assertEquals(1, $struct->int);
        $this->assertEquals(2.3, $struct->flt);
        $this->assertEquals('test', $struct->str);
        $this->assertEquals(true, $struct->bln);
        $this->assertEquals(['key' => 'value'], $struct->arr);
    }
}

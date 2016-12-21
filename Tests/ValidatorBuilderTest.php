<?php

/**
 * 测试用例
 */
namespace FurthestWorld\Validator\Tests;

use FurthestWorld\Validator\Src\RequestValidator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ValidatorBuilderInterface
     */
    protected $builder;

    protected function setUp()
    {
        $this->builder = new RequestValidator();
    }

    protected function tearDown()
    {
        $this->builder = null;
    }

    public function testValidateParams()
    {
        $params = [
            'title' => 'this is a title',
            'created_at' => '2016-12-21 14:40:43'
        ];
        $rules = [
            'title' => 'required|unique:posts|max:255',
            'created_at' => 'required',
        ];
        $this->builder->validateParams($params, $rules);
    }

    public function testAddObjectInitializers()
    {
        $this->assertSame($this->builder, $this->builder->addObjectInitializers(array()));
    }

}

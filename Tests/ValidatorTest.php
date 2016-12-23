<?php

/**
 * 测试用例
 */
namespace FurthestWorld\Validator\Tests;

use FurthestWorld\Validator\Src\RequestValidator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{



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
        $res = RequestValidator::validateParams($params, $rules);
        var_dump($res);
    }


}

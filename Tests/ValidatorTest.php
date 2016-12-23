<?php

/**
 * 测试用例
 */

include_once(dirname(__DIR__) . '/Src/Code/ConstService.php');
include_once(dirname(__DIR__) . '/Src/Rules/NormalRules.php');
include_once(dirname(__DIR__) . '/Src/Validator.php');
include_once(dirname(__DIR__) . '/Src/RequestValidator.php');
use FurthestWorld\Validator\Src\RequestValidator;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

    public function testValidateParams() {
        $params = [
            'domain'     => 'furthestworld.com',
            'member_id' => 10,
        ];
        $rules  = [
            ['name' => 'domain', 'check_rule' => 'number|string#string:1,500'],
            ['name' => 'member_id', 'check_rule' => 'numberGt0'],
        ];
        RequestValidator::validateParams($params, $rules);
        if (!RequestValidator::pass()) {
            var_dump(RequestValidator::getErrors());
        }
    }


}

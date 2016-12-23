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
            'domain'    => 'furthestworld.com',
            'member_id' => 10,
        ];
        RequestValidator::formatParams(
            $params,
            [
                ['name' => 'domain', 'default_value' => '', 'format_method' => 'strtoupper'],
                ['name' => 'member_id']
            ]
        );
        RequestValidator::extend('extend_test', new TestExtendRules());
        RequestValidator::validateParams(
            $params,
            [
                ['name' => 'domain', 'check_rule' => 'number|string#string:10,500'],
                ['name' => 'member_id', 'check_rule' => 'extendEq:10#numberGt0'],
            ]
        );
        if (!RequestValidator::pass()) {
            var_dump(RequestValidator::getErrors());
        }
    }


}

class TestExtendRules {

    /**
     * @node_name
     * @param     $param_value
     * @param int $eq
     * @return array
     */
    public static function paramExtendEq($param_value, $eq = 0) {
        if($eq == $param_value){
            return [1, '验证成功'];
        }
        return [999, '呵呵:不相等~'];
    }

}

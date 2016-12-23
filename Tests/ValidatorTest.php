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
        RequestValidator::extend('extend_test', new TestExtendRules());
        RequestValidator::formatParams(
            $params,
            [
                'domain'    => ['default_value' => '', 'format_method' => 'strtoupper'],
                'member_id' => ['format_method' => 'formatExtendMemberId:domain']
            ]
        );
        RequestValidator::validateParams(
            $params,
            [
                'domain'    => ['check_rule' => 'number|string#string:10,500'],
                'member_id' => ['check_rule' => 'extendEq:20#number'],
            ]
        );

        if (!RequestValidator::pass()) {
            var_dump(RequestValidator::getErrors());
        }else{
            var_dump("\r\n验证通过！");
        }
    }


}

/**
 * @node_name 测试扩展验证规则实例
 * Class TestExtendRules
 */
class TestExtendRules {

    /**
     * @node_name
     * @param     $param_value
     * @param int $eq
     * @return array
     */
    public static function checkExtendEq($param_value, $eq = 0) {
        if ($eq == $param_value) {
            return [1, '验证成功'];
        }
        return [999, '呵呵:不相等~'];
    }

    public static function formatExtendMemberId($param_value){
        return intval($param_value) + 20;
    }

}

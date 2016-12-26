<?php

/**
 * 测试用例
 * 这是一个很不规范的测试用例，请不要在意这些细节~~
 */

include_once(dirname(__DIR__) . '/Src/Code/ConstService.php');
include_once(dirname(__DIR__) . '/Src/Rules/NormalRules.php');
include_once(dirname(__DIR__) . '/Src/Validator.php');
use FurthestWorld\Validator\Src\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

    public function testValidateParams() {

        $params = [
            'domain'    => 'furthe32-_&stworldcom',
            'member_id' => 10,
            'level_id' => '20',
            'created_at' => '2016-12-23 18:28:40',
            'bool' => '0',
        ];
        Validator::extend('extend_test', new TestExtendRules());
        Validator::formatParams(
            $params,
            [
                'domain'    => ['format_rule' => 'strtoupper', 'default_value' => ''],
                'member_id' => ['format_rule' => 'formatExtendMemberId:domain'],
                'level_id' => [],
                'created_at' => [],
                'bool' => []
            ]
        );
        var_dump($params);
        Validator::validateParams(
            $params,
            [
                'domain'    => ['check_rule' => 'number|alphaDash#string#string:10,500'],
                'member_id' => ['check_rule' => 'extendEq:20#number:1,20#in:1,2,3,4,20'],
                'level_id' => ['check_rule' => 'same:'.$params['member_id']],
                'created_at' => ['check_rule' => 'validDate'],
                'bool' => ['check_rule' => 'boolean']
            ]
        );

        if (!Validator::pass()) {
            var_dump(Validator::getErrors());
        } else {
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

    public static function formatExtendMemberId($param_value) {
        return intval($param_value) + 20;
    }

}

<?php
/**
 * Desc: 普通验证规则
 * Created by PhpStorm.
 * User: xuanskyer | <furthestworld@icloud.com>
 * Date: 2016-12-23 09:50:35
 */
namespace FurthestWorld\Validator\Src\Rules;

use FurthestWorld\Validator\Src\Code\CodeService;

class NormalRules {

    /**
     * @node_name 要求参数必须为空
     * @param $param_value
     * @return int
     */
    public static function checkEmpty($param_value) {
        return empty($param_value) ? CodeService::CODE_OK : CodeService::CODE_MUST_EMPTY;
    }


    /**
     * @node_name 要求参数必须为非空
     * @param $param_value
     * @return int
     */
    public static function checkNotEmpty($param_value) {
        return !empty($param_value) ? CodeService::CODE_OK : CodeService::CODE_MUST_NOT_EMPTY;
    }

    /**
     * @node_name 要求参数必须为数字
     * @param $param_value
     * @return int
     */
    public static function checkNumber($param_value) {
        return is_numeric($param_value) ? CodeService::CODE_OK : CodeService::CODE_MUST_NUMBER;
    }

    /**
     * @node_name 要求参数必须为大于0的数字
     * @param $param_value
     * @return int
     */
    public static function checkNumberGt0($param_value) {
        return (is_numeric($param_value) && $param_value > 0) ? CodeService::CODE_OK : CodeService::CODE_MUST_NUMBER_GT0;
    }

    /**
     * @node_name 参数必须为字符串
     * @param     $param_value
     * @param int $min_length
     * @param int $max_length
     * @return int
     */
    public static function checkString($param_value, $min_length = 0, $max_length = 255) {
        if (!is_string($param_value)) {
            return CodeService::CODE_MUST_STRING;
        } elseif (strlen($param_value) < $min_length) {
            return CodeService::CODE_STRING_INVALID_MIN;
        } elseif (strlen($param_value) > $max_length) {
            return CodeService::CODE_STRING_INVALID_MAX;
        } else {
            return CodeService::CODE_OK;
        }
    }

    /**
     * @node_name 参数必须为数组
     * @param $param_value
     * @return int
     */
    public static function checkArray($param_value) {

        return is_array($param_value) ? CodeService::CODE_OK : CodeService::CODE_MUST_ARRAY;
    }


    public static function formatExtendDomain($param_value){
        return "http://{$param_value}";
    }
}
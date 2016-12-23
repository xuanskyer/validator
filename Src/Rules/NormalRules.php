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

    public static function checkEq($param_value, $set_value) {
        return self::checkSame($param_value, $set_value);
    }

    /**
     * @node_name 要求参数必须为数字
     * @return int
     */
    public static function checkNumber() {
        $args_num  = func_num_args();
        $args_list = func_get_args();
        if (3 == $args_num) {
            if ($args_list[0] < $args_list[1]) {
                return CodeService::CODE_STRING_INVALID_MIN;
            }
            if ($args_list[0] > $args_list[2]) {
                return CodeService::CODE_STRING_INVALID_MAX;
            }
        } elseif (2 == $args_num) {
            if ($args_list[0] < $args_list[1]) {
                return CodeService::CODE_STRING_INVALID_MIN;
            }
        } elseif (1 == $args_num) {
            return is_numeric($args_list[0]) ? CodeService::CODE_OK : CodeService::CODE_MUST_NUMBER;
        }
        return CodeService::CODE_OK;
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

    /**
     * @node_name 验证是否相等
     * @param $param_value
     * @param $compare_value
     * @return array
     */
    public static function checkSame($param_value, $compare_value) {
        if ($param_value == $compare_value) {
            return CodeService::CODE_OK;
        }
        return CodeService::CODE_NOT_SAME;
    }

    /**
     * @node_name 验证是否是合法的日期
     * @param        $param_value
     * @param string $check_format
     * @return array
     */
    public static function checkValidDate($param_value, $check_format = '') {
        if(empty($check_format)){
            return strtotime($param_value) ? CodeService::CODE_OK : CodeService::CODE_INVALID_DATE;
        }
        $res = date_parse_from_format($check_format, $param_value);
        if(0 == $res['warning_count'] && 0 == $res['error_count']){
            return CodeService::CODE_OK;
        }
        return CodeService::CODE_INVALID_DATE;
    }

    /**
     * @node_name 验证是否合法邮箱
     * @param $param_value
     * @return array
     */
    public static function checkEmail($param_value) {
        if (!filter_var($param_value, FILTER_VALIDATE_EMAIL)) {
            return CodeService::CODE_INVALID_EMAIL;
        }
        return CodeService::CODE_OK;
    }

    /**
     * @node_name 验证是否合法json
     * @param $param_value
     * @return array
     */
    public static function checkJson($param_value) {
        return CodeService::CODE_OK;
    }

    /**
     * @node_name 验证是否合法IP
     * @param $param_value
     * @return array
     */
    public static function checkIp($param_value) {
        if (!filter_var($param_value, FILTER_VALIDATE_IP)) {
            return CodeService::CODE_INVALID_IP;
        }
        return CodeService::CODE_OK;
    }

    /**
     * @node_name 验证是否合法IP
     * @param $param_value
     * @return array
     */
    public static function checkIpV6($param_value) {
        if (!filter_var($param_value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return CodeService::CODE_INVALID_IPV6;
        }
        return CodeService::CODE_OK;
    }

    /**
     * @node_name 验证是否在列表中
     * @return array
     */
    public static function checkIn() {
        $args_list   = func_get_args();
        $param_value = array_shift($args_list);
        if (!in_array($param_value, $args_list)) {
            return CodeService::CODE_NOT_IN_LIST;
        }
        return CodeService::CODE_OK;
    }

    /**
     * @node_name 验证是否不在列表中
     * @return array
     */
    public static function checkNotIn() {
        $args_list   = func_get_args();
        $param_value = array_shift($args_list);
        if (in_array($param_value, $args_list)) {
            return CodeService::CODE_NOT_IN_LIST;
        }
        return CodeService::CODE_OK;
    }

    /**
     * @node_name 验证是否匹配指定的正则
     * @param $param_value
     * @param $pattern
     * @return array
     */
    public static function checkRegex($param_value, $pattern) {
        if (!preg_match($pattern, $param_value)) {
            return CodeService::CODE_INVALID_REGEX_MATCH;
        }
        return CodeService::CODE_OK;
    }

    /**
     * @node_name 验证是否合法URL
     * @param $param_value
     * @return array
     */
    public static function checkUrl($param_value) {
        if (!filter_var($param_value, FILTER_VALIDATE_URL)) {
            return CodeService::CODE_INVALID_URL;
        }
        return CodeService::CODE_OK;
    }

    /**
     * @node_name 格式化域名
     * @param $param_value
     * @return string
     */
    public static function formatExtendDomain($param_value) {
        return "http://{$param_value}";
    }
}
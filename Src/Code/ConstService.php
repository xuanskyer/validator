<?php
/**
 * Desc: 错误码服务类
 * Created by PhpStorm.
 * User: xuanskyer | <furthestworld@icloud.com>
 * Date: 2016-12-23 09:50:35
 */


namespace FurthestWorld\Validator\Src\Code;


class CodeService {

    //错误码列表
    const CODE_FAIL = [0, '验证失败'];
    const CODE_OK   = [1, '验证成功'];

    const CODE_INVALID_PARAMS = [100, '非法参数：参数必须为数组！'];
    const CODE_INVALID_RULES  = [101, '非法验证规则：验证规则必须为数组！'];
    //1-1000保留为内部错误码使用
    const CODE_PARAM_OK                = [1000, '参数%s验证通过！'];
    const CODE_NO_PARAM_NAME           = [1001, '参数名%s不能为空！'];
    const CODE_INVALID_CHECK_TYPE      = [1002, '参数%s验证方式非法！'];
    const CODE_NO_EXISTED_CHECK_METHOD = [1003, '参数%s验证方法不存在！'];
    const CODE_MUST_NOT_EMPTY          = [1004, '参数%s不能为空！'];
    const CODE_MUST_EMPTY              = [1005, '参数%s必须为空！'];
    const CODE_MUST_NUMBER             = [1006, '参数%s必须为数字！'];
    const CODE_MUST_NUMBER_GT0         = [1009, '参数%s必须为字符串！'];
    const CODE_MUST_STRING             = [1007, '参数%s必须为数组！'];
    const CODE_MUST_ARRAY              = [1008, '参数%s必须为大于0的数字！'];
    const CODE_STRING_INVALID_MIN      = [1009, '参数%s长度小于最小长度%d'];
    const CODE_STRING_INVALID_MAX      = [1010, '参数%s长度大于最大长度%d'];

    public static function message($code = 0) {

    }

    public static function code($mess = '') {

    }
}
<?php
/**
 * Desc: 常规请求参数验证服务
 * Created by PhpStorm.
 * User: xuanskyer | <furthestworld@icloud.com>
 * Date: 2016/12/20 17:46
 */
namespace FurthestWorld\Validator\Src;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RequestValidator extends Validator {

    const OPERATE_METHOD        = '|';      //方法分隔符
    const OPERATE_METHOD_PARAMS = ':';      //方法参数分隔符
    const OPERATE_PARAMS        = ',';      //参数分隔符

    public function __construct() {
        parent::__construct();
        $this->adapter = Validation::createValidator();
    }

    public function formatParams($params = [], $rules = []) {
        // TODO: Implement formatParams() method.
        $formatted_params = [];

        return $formatted_params;
    }

    public function validateParams($params = [], $rules = []) {
        // TODO: Implement validateParams() method.
        if (is_array($params) && !empty($params) && is_array($rules) && !empty($rules)) {
            foreach ($rules as $rule) {

            }
        }
    }

    /**
     * @desc 解析规则中的方法和参数
     * @param string $rule
     * @return array
     */
    protected function getValidateMethods($rule = '') {
        $methods = [];
        if (!empty($rule)) {
            $explode_rule = explode(self::OPERATE_METHOD, $rule);
            foreach($explode_rule as $method_params){
                $explode_method = explode(self::OPERATE_METHOD_PARAMS, $method_params);
                if(isset($explode_method[1])){
                    array_push($methods, ['method' => $explode_method[0], 'params' => explode(self::OPERATE_PARAMS, $explode_method[1])]);
                }else{
                    array_push($methods, ['method' => $explode_method, 'params' => []]);
                }
            }
        }
        return $methods;
    }
}
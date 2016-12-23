# validator

yeah, another params validate component for PHP applications.

嗯，又一个PHP应用参数验证组件

## 安装
* 在项目的composer.json文件中的require项中添加：

```
"furthestworld/validator": "~1.0"
```
并更新composer依赖：`composer update`

* 在需要使用Validator服务的地方添加：

```

require_once __ROOT__ . '/vendor/autoload.php';
use FurthestWorld\Validator\Src\Validator;
```

* 食用方法

```
Validator::formatParams(
    $params,
    [
        'domain'    => ['format_rule' => 'strtoupper', 'default_value' => ''],
        'member_id' => ['format_rule' => 'formatExtendMemberId:domain']
    ]
);
Validator::validateParams(
    $params,
    [
        'domain'    => ['check_rule' => 'number|string#string:10,500'],
        'member_id' => ['check_rule' => 'extendEq:20#number'],
    ]
);

if (!Validator::pass()) {
    //验证未通过
    var_dump(Validator::getErrors());
} else {
    //验证通过
}
```

> 语法说明

* enjoy~ :)


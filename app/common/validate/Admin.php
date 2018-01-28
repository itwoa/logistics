<?php
namespace app\common\validate;
use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username'  =>  'require|max:25|token'
    ];

}

?>
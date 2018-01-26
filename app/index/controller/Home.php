<?php
namespace app\index\controller;
/*后台主页面*/
class Home extends Common
{
    public function index()
    {
        
    	echo model('user')->test();

    }
}

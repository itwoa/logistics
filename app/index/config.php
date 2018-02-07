<?php
return [

  'template'               => [
      // 模板路径
      'view_path'    => '../theme/',
      // 模板文件名分隔符
      'view_depr'    => '_',
      'token'     => [
        'token_on'    => true,
        'token_name'  => '__hash__',
        'token_type'  => 'md5',
        'token_reset' => true,
      ]
     
  ]

]


?>
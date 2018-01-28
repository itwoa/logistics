<?php
return [

  'template'               => [
      // 模板路径
      'view_path'    => '../theme/',
      // 模板文件名分隔符
      'view_depr'    => '_',
      // 视图输出字符串内容替换
      'view_replace_str'  =>  [
        'JS'=>'/static/js',
        'LIB'=>'/static/js/lib',
        'CSS'=>'/static/css',
        'IMG'=>'/static/images'
      ],
      'token'     => [
        'token_on'    => true,
        'token_name'  => '__hash__',
        'token_type'  => 'md5',
        'token_reset' => true,
      ]
     
  ]

]


?>
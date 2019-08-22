<?php

return array(


    'pdf' => array(
        'enabled' => true,
//        'binary'  => '/usr/local/bin/wkhtmltopdf',
        'binary'  => "\"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf\"", //将wkthmltopdf文件夹的路径放在转义双引号中。
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
//        'binary'  => '/usr/local/bin/wkhtmltoimage',
        'binary'  => "\"C:\Program Files\wkhtmltopdf\bin\wkhtmltoimage\"",//将wkthmltopdf文件夹的路径放在转义双引号中。
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);

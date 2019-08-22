<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <style type="text/css">
        *{margin:0;padding:0}
        html,body{width: 360px!important;overflow：hidden;}
        section._editor{width:360px!important;overflow:visible!important;}
    </style>
    <link href="{{ asset('static/plugins/ueditor/themes/default/css/ueditor.css') }}" rel="stylesheet" >
    <link href="{{ asset('static/plugins/ueditor/themes/iframe.css') }}" rel="stylesheet" >
</head>
<body>
{!! $content !!}
</body>
</html>
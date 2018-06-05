<?php

$file = $_GET['f'];

if (empty($file)) {
    die('缺少参数:f');
}

$fc = $_GET['fc'];

if (empty($fc)) {
    die('缺少参数:fc');
}

$service = $_GET['m'];

if (empty($service)) {
    die('缺少参数:m');
}

include_once(DOC_CACHE_DIR . $fc);

list($className, $methodName) = explode('.', $service);

//获取返回结果
$rMethod = new ReflectionMethod($className, $methodName);
$docComment = $rMethod->getDocComment();
$docCommentArr = explode("\n", $docComment);

//获取接口参数
$rules = array();
if (method_exists($className, 'getRules')) {
    //$classObj = new $className();
    $rulesArr = $className::getRules();
    $rules = array_key_exists($methodName, $rulesArr) ? $rulesArr[$methodName] : array();
}

//定义类型
$typeMaps = array(
    'string' => '字符串',
    'int' => '整型',
    'float' => '浮点型',
    'boolean' => '布尔型',
    'date' => '日期',
    'array' => '数组',
    'fixed' => '固定值',
    'enum' => '枚举类型',
    'object' => '对象',
);

$description = '//请检测函数标题描述';
$descComment = '//请使用@desc 注释';

if (!empty($docCommentArr)) {
    foreach ($docCommentArr as $comment) {
        $comment = trim($comment);

        //标题描述
        if (strpos($comment, '@') === false && strpos($comment, '/') === false) {
            $description = substr($comment, strpos($comment, '*') + 1);
            continue;
        }

        //@desc注释
        $pos = stripos($comment, '@desc');
        if ($pos !== false) {
            $descComment = substr($comment, $pos + 5);
            continue;
        }

        //@param 注释
        $pos = stripos($comment, '@param');
        if ($pos !== false) {
            $paramCommentArr = explode(' ', substr($comment, $pos + 7));
            //将数组中的空值过滤掉，同时将需要展示的值返回
            $paramCommentArr = array_values(array_filter($paramCommentArr));
            if (count($paramCommentArr) < 2) {
                continue;
            }
            /*if (!isset($paramCommentArr[2])) {
                $paramCommentArr[2] = ''; //可选的字段说明
            } else {
                //兼容处理有空格的注释
                $paramCommentArr[2] = implode(' ', array_slice($paramCommentArr, 2));
            }*/

            $params[] = $paramCommentArr;
            continue;
        }

        //@return注释
        $pos = stripos($comment, '@return');
        if ($pos !== false) {
            $returnCommentArr = explode(' ', substr($comment, $pos + 8));

            //将数组中的空值过滤掉，同时将需要展示的值返回
            $returnCommentArr = array_values(array_filter($returnCommentArr));
            if (count($returnCommentArr) < 2) {
                continue;
            }
            if (!isset($returnCommentArr[2])) {
                $returnCommentArr[2] = ''; //可选的字段说明
            } else {
                //兼容处理有空格的注释
                $returnCommentArr[2] = implode(' ', array_slice($returnCommentArr, 2));
            }

            $returns[] = $returnCommentArr;
            continue;
        }

    }
}
$_dir = array_shift(explode('/', $_GET['f']));
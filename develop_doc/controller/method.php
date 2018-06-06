<?php

$file = $_GET['f'];

if (empty($file)) {
    die('缺少参数:f');
}

$fileData = doc_make_file($file); //通过原来的类文件生成新的类文件

include_once(DOC_CACHE_DIR . $fileData['file_name']); //包含文件

$methods = doc_get_method_data($fileData['class_name']); //通过类名获取方面数据


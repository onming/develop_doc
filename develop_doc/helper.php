<?php

function doc_page_nav()
{
    $basename = $_GET['c']?$_GET['c']:'class';
    echo '<a class="item' . ($basename=='class'?' active':'') . '" href="index.php?c=class">文件列表</a>';
    echo '<a class="item' . ($basename=='method'?' active':'') . '" href="javascript:void(0);">接口列表</a>';
    echo '<a class="item' . ($basename=='doc'?' active':'') . '" href="javascript:void(0);">文档详情</a>';
    echo '<a class="item' . ($basename=='desc'?' active':'') . '" href="index.php?c=desc">接口规范</a>';
}

/**
 * 获取某目录下所有文件、目录名
 * @param string $dir
 * @return array
 */
function my_scandir($dir)
{
    $files = array();
    if ($handle = opendir($dir)) {
        while (($file = readdir($handle)) !== false) {
            //过滤隐藏文件
            $ArrFileName = explode('.', $file);
            if ($file != ".." && $file != "." && $ArrFileName[0]) {
                if (is_dir($dir . "/" . $file)) {
                    $files['name'][] = empty($_GET['d']) ? $file : $_GET['d'] . '/' . $file;
                    $files['time'][] = @filemtime(SYSTEM_CLASS_DIR . $file);
                    $files['type'][] = 'dir';
                    my_scandir($dir . "/" . $file);
                } else {
                    $ext = substr($file, strrpos($file, '.') + 1); //获取后缀
                    if ($ext == 'php') {
                        $files['name'][] = empty($_GET['d']) ? $file : $_GET['d'] . '/' . $file;
                        $files['time'][] = @filemtime(SYSTEM_CLASS_DIR . $file);
                        $files['type'][] = 'file';
                    }
                }
            }
        }
        closedir($handle);
        return $files;
    }
}

/**
 * 生成文件
 * @param string $file 文件名
 * @return array
 */
function doc_make_file($file = '')
{
    //步骤:分析原来的类文件,将继承去掉并获取类名
    $path = SYSTEM_CLASS_DIR . $file;
    $php_content = file_get_contents($path);
    if (empty($php_content)) {
        die('empty:' . $path);
    }

    $check_extends = strstr($php_content, 'extends');
    if ($check_extends) {
        //表示存在 继承 关系
        $start = 'extends';
        $end = '({|\n{)';
        $pattern = "/" . $start . ".*" . $end . "/U";
        preg_match_all($pattern, $php_content, $matches);
        $php_content = str_replace($matches[0], '{', $php_content);
    }
    $check_namespace = strstr($php_content, 'namespace');
    if ($check_namespace) {
        $start = 'namespace';
        $end = ';';
        $pattern = "/" . $start . ".*" . $end . "/U";
        preg_match_all($pattern, $php_content, $matches);
        $php_content = str_replace($matches[0], '', $php_content);
    }
    //获取类名
    $start = 'class';
    $end = '{';

    $pattern = "/" . $start . ".*" . $end . "/U";
    preg_match_all($pattern, $php_content, $matches);
    $class_name = str_replace($start, '', $matches[0]);
    $class_name = str_replace($end, '', $class_name[0]);
    $class_name = str_replace(' ', '', $class_name);
    //生成新文件
    //$new_file_name = $class_name . '.php';
    $new_file_name = md5($php_content);
    if (!is_dir(DOC_CACHE_DIR)) {
        $mask = umask(0);
        mkdir(DOC_CACHE_DIR, 0777, true);
        umask($mask);
    }
    if (file_exists(DOC_CACHE_DIR . $new_file_name)) {
        unlink(DOC_CACHE_DIR . $new_file_name) or die ('删除文件:' . DOC_CACHE_DIR . $new_file_name . '失败');
    }
    file_put_contents(DOC_CACHE_DIR . $new_file_name, $php_content) or die ('写入文件:' . DOC_CACHE_DIR . $new_file_name . '失败');
    return array(
        'file_name' => $new_file_name,
        'class_name' => $class_name
    );
}

/**
 * 获取类中的方法数据
 * @param string $class 类名
 * @return mixed
 */
function doc_get_method_data($class = '')
{
    $method = get_class_methods($class);
    $arrApi = array();
    if (!empty($method)) {
        foreach ($method as $mValue) {
            $rMethod = new Reflectionmethod($class, $mValue);
            if (!$rMethod->isPublic() || strpos($mValue, '__') === 0 || $mValue == 'getRules') {
                continue;
            }

            $title = '//请检测函数注释';
            $desc = '//请使用@desc 注释';

            $docComment = $rMethod->getDocComment(); //获取评论
            if ($docComment !== false) {
                $docCommentArr = explode("\n", $docComment);
                $comment = trim($docCommentArr[1]);
                $title = trim(substr($comment, strpos($comment, '*') + 1));

                foreach ($docCommentArr as $comment) {
                    $pos = stripos($comment, '@desc');
                    if ($pos !== false) {
                        $desc = substr($comment, $pos + 5);
                    }
                }
            }

            $service = $class . '.' . $mValue;

            $arrApi[$service] = array(
                'service' => $service,
                'title' => $title,
                'desc' => $desc,
            );
        }
    }
    return $arrApi;
}
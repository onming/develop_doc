<?php
// +----------------------------------------------------------------------
// | DEVELOP_DOC
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 170893265@qq.com
// +----------------------------------------------------------------------

header("Content-type: text/html; charset=utf-8");

//是否显示错误
ini_set('display_errors', 1);

//全局变量
define('DOC_VERSION', '1.0.0');
define('EXT', '.php');
define('DS', DIRECTORY_SEPARATOR);
define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']) . DS);
define('ROOT_PATH', dirname(realpath(APP_PATH)) . DS);
//网站访问地址
define('SITE_URL', 'http://'.$_SERVER['HTTP_HOST'].'/demo/index.php/');

$_GET['c'] = empty($_GET['c'])?'class':$_GET['c'];

$dir = '';
if (!empty($_GET['d'])) {
    $dir = trim($_GET['d']) . '/';
    $_GET['d'] = '';
} else if (!empty($_GET['f']) && $pos = strripos('/', $_GET['f'])) {
    $dir = substr($_GET['f'], 0, $pos) . '/';
    $_GET['f'] = substr($_GET['f'], $pos);
}

//加载配置文件
require APP_PATH . 'config/config.php';

//加载辅助函数
require APP_PATH . 'helper.php';

// 加载controllers
require APP_PATH . 'controller/' . $_GET['c'] . EXT;

// 加载view
require APP_PATH . 'view/' . $_GET['c'] . EXT;
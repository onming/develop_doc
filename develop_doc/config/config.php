<?php
//设置版权
define('COPYRIGHT', '© Powered By ONMING项目');
//设置产品名称
define('PRODUCT_NAME', '项目API接口文档');
//设置DOC缓存目录
define('DOC_CACHE_DIR', APP_PATH . 'cache/');
//设置项目根目录
define('SYSTEM_CLASS_DIR', ROOT_PATH . 'demo/controller/' . $dir);
//设置需要生成文档的控制器目录其余排除
$controllers_arr = array('api', 'app');

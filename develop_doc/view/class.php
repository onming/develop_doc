<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>在线接口列表<?php echo ' | ' . PRODUCT_NAME; ?></title>
    <link rel="stylesheet" href="static/css/semantic.min.css">
    <link rel="stylesheet" href="static/css/icon.min.css">
</head>
<body>
    <div class="ui large top fixed menu transition visible" style="display: flex !important;">
        <div class="ui container">
            <div class="header item"><?echo PRODUCT_NAME;?></div>
            <?php doc_page_nav(); ?>
        </div>
    </div>
    <div class="ui text container" style="max-width: none !important;margin-top: 50px;">
        <div class="ui floating message">
            <h1 class="ui header">文件列表</h1>
            <table class="ui black celled striped table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>接口文件名称</th>
                    <th>最后修改时间</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($files)) {
                    $num = 1;
                    foreach ($files['name'] as $k => $v) {

                        if ($files['type'][$k] == 'file' && !$dir) { //一级控制器不生成DOC
                            continue;
                        }else if ($files['type'][$k] == 'dir' && !in_array($v, $controllers_arr)) { //指定目录生成DOC
                            continue;
                        }
                        $NO = $num++;
                        echo '<tr>';
                        echo '<td>' . $NO . '</td>';
                        echo '<td>';
                        if ($files['type'][$k] == 'file') {
                            echo '<i class="file icon"></i> <a href="index.php?c=method&f=' . $dir . $v . '">' . ucfirst(rtrim($v, '.php')) . '</a>';
                        } elseif ($files['type'][$k] == 'dir') {
                            echo '<i class="folder icon"></i> <a href="index.php?c=class&d=' . $dir . $v . '">' . $v . '</a>';
                        }
                        echo '</td>';
                        echo '<td>' . date('Y-m-d H:i:s', $files['time'][$k]) . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <p><?php echo COPYRIGHT ?><p>
    </div>
</body>
</html>
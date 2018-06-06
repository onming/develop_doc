<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>在线接口列表<?php echo ' | ' . PRODUCT_NAME; ?></title>
    <link rel="stylesheet" href="static/css/semantic.min.css">
</head>
<body>
    <div class="ui large top fixed menu transition visible" style="display: flex !important;">
        <div class="ui container">
            <div class="header item"><?echo PRODUCT_NAME;?></div>
            <?php doc_page_nav(); ?>
        </div>
    </div>
    <div class="ui text container" style="max-width: none !important; margin-top: 50px;">
        <div class="ui floating message">
            <h2 class='ui header'>
                接口：<?php
                echo($service ? '<a target="_blank" href="' . SITE_URL . strtolower($className) . '/testing/' . $methodName . '">' . $service . '</a>' : '--');
                ?></h2>
            <br/>
            <span class='ui teal tag label'>
                <a style="opacity: 1;"
                   href="index.php?c=method&f=<?php echo $file ?>"><?php echo($description ? $description : '//请检测函数标题描述'); ?></a>
            </span>

            <div class="ui raised segment">
                <span class="ui red ribbon label">接口说明</span>

                <div class="ui message">
                    <p> <?php echo($descComment ? $descComment : '//请使用@desc 注释'); ?></p>
                </div>
            </div>

            <div class="ui blue message">
                <strong>接口地址：</strong>
                <?php echo SITE_URL.strtolower($className).DS.$methodName?>
            </div>

            <h3>接口参数</h3>
            <table class="ui red celled striped table">
                <thead>
                <tr>
                    <th>参数名字</th>
                    <th>类型</th>
                    <th>是否必须</th>
                    <th>参考值</th>
                    <!--<th>其他</th>-->
                    <th>说明</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($rules)) {
                    foreach ($rules as $key => $rule) {
                        $name = $rule['name'];
                        if (!isset($rule['type'])) {
                            $rule['type'] = 'string';
                        }
                        $type = isset($typeMaps[$rule['type']]) ? $typeMaps[$rule['type']] : $rule['type'];
                        $require = isset($rule['require']) && $rule['require'] ? '<font color="red">必须</font>' : '可选';
                        $default = isset($rule['default']) ? $rule['default'] : '';
                        if ($default === NULL) {
                            $default = 'NULL';
                        } else if (is_array($default)) {
                            $default = json_encode($default);
                        } else if (!is_string($default)) {
                            $default = var_export($default, true);
                        }

                        $other = '';
                        if (isset($rule['min'])) {
                            $other .= ' 最小：' . $rule['min'];
                        }
                        if (isset($rule['max'])) {
                            $other .= ' 最大：' . $rule['max'];
                        }
                        if (isset($rule['range'])) {
                            $other .= ' 范围：' . implode('/', $rule['range']);
                        }
                        $desc = isset($rule['desc']) ? trim($rule['desc']) : '';

                        echo '<tr>';
                        echo '<td>' . $name . '</td>';
                        echo '<td>' . $type . '</td>';
                        echo '<td>' . $require . '</td>';
                        echo '<td>' . $default . '</td>';
                        echo '<td>' . $other . '</td>';
                        //echo '<td>' . $desc . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
                <?php
                if (!empty($params)) {
                    foreach ($params as $item) {
                        $name = $item[1];
                        $type = isset($typeMaps[$item[0]]) ? $typeMaps[$item[0]] : $item[0];
                        echo '<tr>';
                        echo '<td>' . $name . '</td>';
                        echo '<td>' . $type . '</td>';
                        echo '<td>' . $item[2] . '</td>';
                        echo '<td>' . $item[3] . '</td>';
                        echo '<td>' . $item[4] . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
                </tbody>
            </table>

            <h3>返回结果</h3>
            <table class="ui green celled striped table">
                <thead>
                <tr>
                    <th>返回字段</th>
                    <th>类型</th>
                    <th>说明</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($returns)) {
                    foreach ($returns as $item) {
                        $name = $item[1];
                        $type = isset($typeMaps[$item[0]]) ? $typeMaps[$item[0]] : $item[0];
                        $detail = $item[2];
                        echo '<tr>';
                        echo '<td>' . $name . '</td>';
                        echo '<td>' . $type . '</td>';
                        echo '<td>' . $detail . '</td>';
                        echo '</tr>';
                    }
                }
                ?>
                </tbody>
            </table>

            <div class="ui red message">
                <strong>注意事项：</strong> 此处暂不列明默认必要参数(unique|timestamp|random|sign)，具体按请协同开发人员按接口规范处理
            </div>

            <div class="ui blue message">
                <strong>温馨提示：</strong> 返回数据除[status][msg]，其余都分装在[data]下，一级只存在三项
            </div>

        </div>
        <p><?php echo COPYRIGHT ?><p>
    </div>
</body>
</html>
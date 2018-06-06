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
            <h3>公共参数</h3>
            <table class="ui red celled striped table">
                <thead>
                <tr>
                    <th>参数名字</th>
                    <th>类型</th>
                    <th>是否必须</th>
                    <th>参考值</th>
                    <th>说明</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>unique</td>
                        <td>String(64)</td>
                        <td>是</td>
                        <td>AoFtuEDAqP8_firj3UN3KFxVTXd6vaigL_5xRkIVqUMX</td>
                        <td>设备唯一标识</td>
                    </tr>
                    <tr>
                        <td>timestamp</td>
                        <td>Int(10)</td>
                        <td>是</td>
                        <td>1234567890</td>
                        <td>时间戳</td>
                    </tr>
                    <tr>
                        <td>random</td>
                        <td>Int(6)</td>
                        <td>是</td>
                        <td>123456</td>
                        <td>随机值</td>
                    </tr>
                    <tr>
                        <td>sign</td>
                        <td>String(32)</td>
                        <td>是</td>
                        <td>ad4a980c5e4d9616b0090e8facb37b68</td>
                        <td>sign=md5(<font color="red">admin~!@#$%^&*()</font>+unique+timestamp+random)</td>
                    </tr>
                </tbody>
            </table>


            <h3>业务错误码</h3>
            <div class="ui blue message">
                <strong>{"status":1,"msg":"Success"}</strong>
            </div>
            <table class="ui green celled striped table">
                <thead>
                <tr>
                    <th>status</th>
                    <th>msg</th>
                    <th>返回说明</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Success</td>
                        <td>成功</td>
                    </tr>
                    <tr>
                        <td>0</td>
                        <td>Fail</td>
                        <td>失败</td>
                    </tr>
                    <tr>
                        <td>-1</td>
                        <td>APPIDError</td>
                        <td>应用的APPID无效或没有授权</td>
                    </tr>
                    <tr>
                        <td>-2</td>
                        <td>InvalidSign</td>
                        <td>无效的验证签名</td>
                    </tr>
                    <tr>
                        <td>-3</td>
                        <td>InvalidTimestamp</td>
                        <td>无效的时间戳，请使用当前的时间</td>
                    </tr>
                    <tr>
                        <td>-4</td>
                        <td>CountLimit</td>
                        <td>超过当天查询次数限制，或此IP被限制访问</td>
                    </tr>
                    <tr>
                        <td>-5</td>
                        <td>SpeedLimit</td>
                        <td>查询过于频繁</td>
                    </tr>
                    <tr>
                        <td>-6</td>
                        <td>ArgFormatError</td>
                        <td>查询参数格式错误，例如某些api我们要求对参数进行base64编码，如果base64编码错误，服务器将返回此错误提示</td>
                    </tr>
                    <tr>
                        <td>-7</td>
                        <td>$arg</td>
                        <td>缺少必需的查询参数。$arg说明所缺少的具体参数名</td>
                    </tr>
                    <tr>
                        <td>-8</td>
                        <td>ServerBusyError</td>
                        <td>服务器繁忙</td>
                    </tr>
                    <tr>
                        <td>-9</td>
                        <td>ReLogin</td>
                        <td>请重新登录</td>
                    </tr>
                    <tr>
                        <td>-10</td>
                        <td>ForcedUpdate</td>
                        <td>请强制更新</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p><?php echo COPYRIGHT ?><p>
    </div>
</body>
</html>
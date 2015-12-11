<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Seeed API Page</title>
        <meta name="description" content="">
        <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <h2>API 接口参数</h2>
        <p>API接口描述</p>
        <div class="alert-info title">API列表</div>
        <table class="table table-bordered">
            <tr class="active">
                <th style="width:40%">URL</th>
                <th style="width:50%">说明</th>
                <th>操作</th>
            </tr>
            <?php foreach($data as $ko => $vo):?>
                <tr>
                    <td><a href="<?=$url['view_url']?>&id=<?=$vo['id']?>"><?=$apiHost?><?=$vo['url']?></a></td>
                    <td><?=$vo['name']?></td>
                    <td><a href="<?=$url['edit_url']?>&id=<?=$vo['id']?>" target="_self"><i class="icon-edit mr5"></i>修改</a></td>
                </tr>
            <?php endforeach;?>
        </table>
    </body>
</html>

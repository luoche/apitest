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
      <?php
        use yii\helpers\Html;
      ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container center-block">
          
           <h2>接口标题</h2>
           
           <div class=" alert-info title">请求方式</div>
           <p class=""><?=$base_message['method']?></p>
           
           <div class=" alert-info title">用户授权</div>
           <p><?php if($base_message['user_auth'] == 1):?>是<?php else:?>否<?php endif;?></p>
           
           <div class=" alert-info title">应用场景</div>
           <p><?=$base_message['detail']?></p>
           
           <div class=" alert-info title">系统参数</div>
           <table class="table table-bordered table-hover">
               <tr class="active">
                   <th style="width:20%;">名称</th>
                   <th style="width:10%;">类型</th>
                   <th style="width:10%;">是否必须</th>
                   <th style="width:26%;">示例值</th>
                   <th>描述</th>
               </tr>
               <?php foreach($post_param as $ko =>$vo):?>
                  <tr>
                   <td><?=$vo['name']?></td>
                   <td><?=$vo['type']?></td>
                   <td><?php if($vo['is_required'] == 1):?>是<?php else:?>否<?php endif;?></td>
                   <td><?=$vo['detail']?></td>
                   <td><?=$vo['value']?></td>
               </tr>
               <?php endforeach;?>
               
           </table>
           
           <div class=" alert-info title">返回参数</div>
           <table class="table table-bordered table-hover">
               <tr class="active">
                   <th style="width:20%;">名称</th>
                   <th style="width:10%;">类型</th>
                   <th style="width:10%;">是否必须</th>
                   <th style="width:26%;">示例值</th>
                   <th>描述</th>
               </tr>
               <?php foreach($return_param as $ko =>$vo):?>
                  <tr>
                   <td><?=$vo['name']?></td>
                   <td><?=$vo['type']?></td>
                   <td><?php if($vo['is_required'] == 1):?>是<?php else:?>否<?php endif;?></td>
                   <td><?=$vo['detail']?></td>
                   <td><?=$vo['value']?></td>
               </tr>
               <?php endforeach;?>
           </table>
            
            <div class=" alert-info title">返回示例</div>
            <pre><?=$return_code['data']?></pre>
            
            <div class=" alert-info title">错误代码</div>
           <table class="table table-bordered table-hover">
               <tr class="active">
                   <th style="width:20%;">名称</th>
                   <th style="width:40%;">描述</th>
                   <th>解决方案</th>
               </tr>
              <?php foreach($error_msg as $ko =>$vo):?>
                  <tr>
                   <td><?=$vo['errorcode']?></td>
                   <td><?=$vo['msg']?></td>
                   <td><?=$vo['solve_answer']?></td>
               </tr>
               <?php endforeach;?>
           </table>
            
           
        </div>
        
        
        
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

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
            use yii\helpers\Url;
            use app\models\Category;
            use app\models\BaseMessage;

            $typeLst = BaseMessage::getAllFieldType();
        ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container center-block">
            
            
            
            <!--创建接口参数-->
            <form action="<?=$action['action']?>" method="post" class="form-horizontal" id="create-api-param">
                <div class="page-header">
                  <h1>修改接口参数</h1>
                </div>
                <!--第一步-->
                <div class="creat-api-step-1">
                    
                </div>
             
              <!--请求参数-->
              <div class="creat-api-step-2">
                  <div class="alert alert-info rel" role="alert">
                      修改基本信息
                      <input type="hidden" name="BasicMessage[id]" value="<?=$base_message['id']?>">
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">接口名称：</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="" name="BasicMessage[name]" placeholder="分类名称" value="<?=$base_message['name']?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">所属分类：</label>
                    <div class="col-sm-10">
                        <select class="form-control w50p" name="BasicMessage[cate]">
                          <?php $cateLst = Category::getAllCategory();?>
                          <?php foreach($cateLst as $ko => $vo):?>
                            <option value="<?=$vo['id']?>" <?php if($vo['id'] == $base_message['cate']):?>selected<?php endif;?>><?=$vo['name']?></option>
                          <?php endforeach;?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">请求方式：</label>
                    <div class="col-sm-10">
                        <select class="form-control w50p" name="BasicMessage[method]">
                          <option value="POST" <?php if('POST' == $base_message['method']):?>selected<?php endif;?>>POST</option>
                          <option value="GET" <?php if('GET' == $base_message['method']):?>selected<?php endif;?>>GET</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">用户授权：</label>
                    <div class="col-sm-10">
                        <select class="form-control w50p" name="BasicMessage[user_auth]">
                          <option value="1" <?php if(1 == $base_message['user_auth']):?>selected<?php endif;?>>是</option>
                          <option value="0" <?php if(0 == $base_message['user_auth']):?>selected<?php endif;?>>否</option>
                        </select>
                    </div>
                  </div>
                <div class="form-group">
                   <label for="inputPassword" class="col-sm-2 control-label">应用场景：</label>
                   <div class="col-sm-10">
                        <textarea class="form-control" rows="6" name="BasicMessage[detail]"><?=$base_message['detail']?></textarea>
                    </div>
                </div>
                    
                  <div class="alert alert-info rel" role="alert">
                      请求参数
                      <span class="glyphicon glyphicon-plus abs add-row" data-id="1" title="添加一行"></span>
                  </div>
                  <table class="table table-bordered table-1"> 
                      <tr>
                           <th>名称</th>
                           <th>类型</th>
                           <th>是否必须</th>
                           <th>示例值</th>
                           <th>描述</th>
                           <th></th>
                      </tr>
                    <?php foreach($post_param as $ko => $vo):?>
                    <tr>
                        <td><input type="text" class="form-control" name="PostParam_name[]" placeholder="接口名称" value="<?=$vo['name']?>"></td>
                        <td>
                          <select class="form-control" name="PostParam_type[]">
                              <?php $typeLst = ['INT','STRING','CHAR','VARCHAR','TEXT','TINYINT','DATETIME','BLOB'];?>
                              <?php foreach($typeLst as $ko1 => $vo1):?>
                                <option value="<?=$vo1?>" <?php if($vo1 === $vo['type']):?>selected<?php endif;?>>
                                <?=$vo1?></option>
                              <?php endforeach;?>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="PostParam_is_required[]">
                              <option value="1" <?php if(1 == $vo['is_required']):?>selected<?php endif;?>>是</option>
                              <option value="0" <?php if(0 == $vo['is_required']):?>selected<?php endif;?>>否</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="PostParam_detail[]" placeholder="示例值" value="<?=$vo['detail']?>"></td>
                        <td><input type="text" class="form-control" name="PostParam_value[]" placeholder="描述" value="<?=$vo['value']?>"></td>
                        <td><span class="remove-row">x</span></td>
                    </tr>
                    <?php endforeach;?>
                  </table>
                
                <!--返回结果-->
                <div class="alert alert-info rel mt40" role="alert">
                    返回结果
                    <span class="glyphicon glyphicon-plus abs add-row" data-id="2" title="添加一行"></span>    
                </div>
                <table class="table table-bordered table-2"> 
                    <tr>
                       <th>名称</th>
                       <th>类型</th>
                       <th>是否必须</th>
                       <th>示例值</th>
                       <th>描述</th>
                       <th></th>
                    </tr>
                    <?php foreach($return_param as $ko => $vo):?>
                    <tr>
                      <td><input type="text" class="form-control" name="ReturnParam_name[]" value="<?=$vo['name']?>" placeholder="接口名称"></td>
                      <td>
                          <select class="form-control" name="ReturnParam_type[]">
                              <?php $typeLst = ['INT','STRING','CHAR','VARCHAR','TEXT','TINYINT','DATETIME','BLOB'];?>
                              <?php foreach($typeLst as $ko1 => $vo1):?>
                                <option value="<?=$vo1?>" <?php if($vo1 === $vo['type']):?>selected<?php endif;?>><?=$vo1?></option>
                              <?php endforeach;?>
                          </select>
                      </td>
                        <td>
                            <select class="form-control" name="ReturnParam_is_required[]">
                              <option value="1" <?php if(1 == $vo['is_required']):?>selected<?php endif;?>>是</option>
                              <option value="0" <?php if(0 == $vo['is_required']):?>selected<?php endif;?>>否</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="ReturnParam_detail[]" value="<?=$vo['detail']?>" placeholder="示例值"></td>
                        <td><input type="text" class="form-control" name="ReturnParam_value[]" value="<?=$vo['value']?>" placeholder="描述"></td>
                        <td><span class="remove-row">x</span></td>
                    </tr>
                  <?php endforeach;?>
                </table>
                
                <!--返回示例-->
                <div class="alert alert-success mt40" role="alert">
                    返回示例
                </div>
                <textarea class="form-control" name="ReturnCode_data" rows="6"><?=$return_code['data']?></textarea>
                
                <!--错误代码-->
                <div class="alert alert-success rel mt40" role="alert">
                    错误代码
                    <span class="glyphicon glyphicon-plus abs add-row" data-id="3" title="添加一行"></span>
                </div>
                <table class="table table-bordered table-3"> 
                    <tr>
                       <th>名称</th>
                       <th>描述</th>
                       <th>解决方案</th>
                       <th></th>
                    </tr>
                    <?php foreach($error_msg as $ko => $vo):?>
                    <tr>
                        <td><input type="text" class="form-control" id="" name="ErrorMessage_errorcode[]" placeholder="接口名称" value="<?=$vo['errorcode']?>"></td>
                        <td><input type="text" class="form-control" id="" name="ErrorMessage_msg[]" placeholder="描述" value="<?=$vo['msg']?>"></td>
                        <td><input type="text" class="form-control" id="" name="ErrorMessage_solve_answer[]" placeholder="解决方案" value="<?=$vo['solve_answer']?>"></td>
                        <td><span class="remove-row">x</span></td>
                    </tr>
                    <?php endforeach;?>
                </table>
                
                <!--确定-->
                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-primary center-block">确  定</button>
                </div>
              </div>
            </form>
            
        </div>
        
        
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

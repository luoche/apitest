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
           
           <!--导航-->
            <ul class="nav nav-tabs nav-justified" id="main-nav">
                <li role="presentation" class="active" data-id="create-api-type"><a href="#">创建接口分类</a></li>
                <li role="presentation"><a href="#" data-id="create-api-param">创建接口参数</a></li>
            </ul>
            
            <!--创建接口分类-->
            
            <form class="form-horizontal tab-block" id="create-api-type" action="<?=$category['action_url'];?>" method="post">
             <div class="page-header">
              <h1>创建接口分类</h1>
            </div>
              <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">分类名称：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="" placeholder="分类名称" name="<?=$category['tableName'];?>[name]">
                </div>
              </div>
              <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">请求地址：</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="" placeholder="分类请求" name="<?=$category['tableName'];?>[url]">
                </div>
              </div>
                <div class="form-group">
                   <label for="inputPassword" class="col-sm-2 control-label">交互说明：</label>
                   <div class="col-sm-10">
                        <textarea class="form-control" rows="6" placeholder="交互说明" name="<?=$category['tableName'];?>[detail]"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-primary btn-lg" id="form-category-submit">确定</button>
                    </div>
                  </div>
            </form>
            
            
            
            <!--创建接口参数-->
            <!-- <form action="" method="post" class="form-horizontal dn tab-block" id="create-api-param"> -->
            <div class="form-horizontal dn tab-block" id="create-api-param">
                <div class="page-header">
                  <h1>创建接口参数</h1>
                </div>
                <!--第一步-->
                <div class="creat-api-step-1">
                <form class="form-horizontal tab-block" id="create-api-type" action="<?=$BaseMessage['action_url'];?>" method="post">
                    <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">接口名称：</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="" name="<?=$BaseMessage['tableName'];?>[name]" placeholder="分类名称">
                    </div>
                  </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">接口URL：</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="" name="<?=$BaseMessage['tableName'];?>[url]" placeholder="分类名称">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">所属分类：</label>
                    <div class="col-sm-10">
                        <select class="form-control w50p" name="<?=$BaseMessage['tableName'];?>[cate]">
                          <!-- <option value="0">--请选择--</option> -->
                          <?php $cateLst = Category::getAllCategory();?>
                          <?php foreach($cateLst as $ko => $vo):?>
                            <option value="<?=$vo['id']?>"><?=$vo['name']?></option>
                          <?php endforeach;?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">请求方式：</label>
                    <div class="col-sm-10">
                        <select class="form-control w50p" name="<?=$BaseMessage['tableName'];?>[method]">
                          <option value="POST" selected>POST</option>
                          <option value="GET">GET</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">用户授权：</label>
                    <div class="col-sm-10">
                        <select class="form-control w50p" name="<?=$BaseMessage['tableName'];?>[user_auth]">
                          <option value="1" selected>是</option>
                          <option value="0">否</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">创建作者：</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="" name="<?=$BaseMessage['tableName'];?>[author]" placeholder="创建作者">
                    </div>
                  </div>
                    <div class="form-group">
                       <label for="inputPassword" class="col-sm-2 control-label">应用场景：</label>
                       <div class="col-sm-10">
                            <textarea class="form-control" rows="6" name="<?=$BaseMessage['tableName'];?>[detail]"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="button" class="btn btn-primary btn-lg btn-step-1" id="form-baseMessage-submit">下一步</button>
                        </div>
                      </div>
                    </form>
                </div>
             
              <!--请求参数-->
              <!-- 这里开始表单 -->
              <form class="form-horizontal tab-block" id="create-api-type" action="<?=$BaseMessage['info_url'];?>" method="post">
                <input type="hidden" name="b_id" id="b_id" value="">
                  <div class="creat-api-step-2 dn">
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
                        <tr>
                            <td><input type="text" class="form-control" name="PostParam_name[]" placeholder="接口名称"></td>
                            <td>
                              <select class="form-control" name="PostParam_type[]">
                                  <option value="INT" selected>INT</option>
                                  <option value="STRING">STRING</option>
                                  <option value="CHAR">CHAR</option>
                                  <option value="VARCHAR">VARCHAR</option>
                                  <option value="TEXT">TEXT</option>
                                  <option value="TINYINT">TINYINT</option>
                                  <option value="DATETIME">DATETIME</option>
                                  <option value="BLOB">BLOB</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="PostParam_is_required[]">
                                  <option value="1" selected>是</option>
                                  <option value="0">否</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control" name="PostParam_detail[]" placeholder="示例值"></td>
                            <td><input type="text" class="form-control" name="PostParam_value[]" placeholder="描述"></td>
                            <td><span class="remove-row">x</span></td>
                        </tr>
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
                        <tr>
                            <td><input type="text" class="form-control" name="ReturnParam_name[]" placeholder="接口名称"></td>
                            <td>
                              <select class="form-control" name="ReturnParam_type[]">
                                  <option value="INT" selected>INT</option>
                                  <option value="STRING">STRING</option>
                                  <option value="CHAR">CHAR</option>
                                  <option value="VARCHAR">VARCHAR</option>
                                  <option value="TEXT">TEXT</option>
                                  <option value="TINYINT">TINYINT</option>
                                  <option value="DATETIME">DATETIME</option>
                                  <option value="BLOB">BLOB</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="ReturnParam_is_required[]">
                                  <option value="1" selected>是</option>
                                  <option value="0">否</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control" name="ReturnParam_detail[]" placeholder="示例值"></td>
                            <td><input type="text" class="form-control" name="ReturnParam_value[]" placeholder="描述"></td>
                            <td><span class="remove-row">x</span></td>
                        </tr>
                    </table>
                    
                    <!--返回示例-->
                    <div class="alert alert-success mt40" role="alert">
                        返回示例
                    </div>
                    <textarea class="form-control" rows="6" name="ReturnCode_data"></textarea>
                    
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
                        <tr>
                            <td><input type="text" class="form-control" id="" name="ErrorMessage_errorcode[]" placeholder="接口名称"></td>
                            <td><input type="text" class="form-control" id="" name="ErrorMessage_msg[]" placeholder="描述"></td>
                            <td><input type="text" class="form-control" id="" name="ErrorMessage_solve_answer[]" placeholder="解决方案"></td>
                            <td><span class="remove-row">x</span></td>
                        </tr>
                    </table>
                    
                    <!--确定-->
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary center-block">确  定</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        
        
        
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

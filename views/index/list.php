<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Seeed API Page</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/main.css">
        <style>
            html { overflow: hidden;}
        </style>
    </head>
    <body>
        <?php
            use yii\helpers\Html;
            use yii\helpers\Url;
        ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <header class="header-wraper fix">
            <div class="com-w fix mao header">
                <img src="img/slogo.png" class="logo fl" alt="">
                <span class="logo-text fl">OPEN API</span>
                <!--<form class="form-inline fr api-search" action="" method="post" id="search-form">
                  <div class="form-group">
                      <input type="text" class="form-control key-word" placeholder="key word">
                  </div>
                  <button type="submit" class="btn btn-primary" id="btn-submit-search">Search API</button>
                </form>-->
                <span class="fr"><a href="<?=$url?>" class="btn-add-api"><i class="icon-plus mr5"></i>创建分类和接口</a></span>
            </div>
        </header>
        
        <section class="com-w fix mao rel api-content">
            <ul class="left-bar scrollbar f16 abs" id="ul-cate-bar" data-url="<?=$cate_url?>">
                <li class="b-b">
                   <a href="" class="nav-item"><i class="icon-angle-right mr10"></i>分类</a>
                    <ul class="child-nav" >
                        <?php foreach($data['cateLst'] as $ko => $vo):?>
                            <li><a href="<?=$cate_url?>&cate=<?=$vo['id']?>" class="cate-list"><?=$vo['name']?></a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <li class="b-b dn">
                    <a href="" class="nav-item"><i class="icon-angle-right mr10"></i>功能02</a>
                    <ul class="child-nav dn">
                        <li><a href="demo2.html">子功能12</a></li>
                        <li><a href="demo3.html">子功能13</a></li>
                    </ul>
                </li>
            </ul>
            
            <div class="right-bar abs">
                <iframe class="scrollbar" id="api-box" frameborder="0">
                    
                </iframe>
            </div>      
                  
        </section>
        
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

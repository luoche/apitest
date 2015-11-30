<?php
/**
 * 浏览器友好的变量输出
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
function dump($var, $echo=true, $label=null, $strict=true) {
  $label = ($label === null) ? '' : rtrim($label) . ' ';
  if (!$strict) {
    if (ini_get('html_errors')) {
      $output = print_r($var, true);
      $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
    } else {
      $output = $label . print_r($var, true);
    }
  } else {
    ob_start();
    var_dump($var);
    $output = ob_get_clean();
    // if (!extension_loaded('xdebug')) {
      $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
      $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
    // }
  }
  if ($echo) {
    echo($output);
    return null;
  }else
    return $output;
}
/**
 * 友好时间
 * @dates  2015-07-24
 * @author wangyafei
 */
function frienddate($time) {
    if (!$time)
        return false;
    $fdate = '';
    $d = time() - intval($time);
    $ld = $time - mktime(0, 0, 0, 0, 0, date('Y')); //年
    $md = $time - mktime(0, 0, 0, date('m'), 0, date('Y')); //月
    $byd = $time - mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')); //前天
    $yd = $time - mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')); //昨天
    $dd = $time - mktime(0, 0, 0, date('m'), date('d'), date('Y')); //今天
    $td = $time - mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')); //明天
    $atd = $time - mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')); //后天
    if ($d == 0) {
        $fdate = '刚刚';
    } else {
        switch ($d) {
            case $d < $atd:
                $fdate = date('Y年m月d日', $time);
                break;
            case $d < $td:
                $fdate = '后天' . date('H:i', $time);
                break;
            case $d < 0:
                $fdate = '明天' . date('H:i', $time);
                break;
            case $d < 60:
                $fdate = $d . '秒前';
                break;
            case $d < 3600:
                $fdate = floor($d / 60) . '分钟前';
                break;
            case $d < $dd:
                $fdate = floor($d / 3600) . '小时前';
                break;
            case $d < $yd:
                $fdate = '昨天' . date('H:i', $time);
                break;
            case $d < $byd:
                $fdate = '前天' . date('H:i', $time);
                break;
            case $d < $md:
                $fdate = date('m月d日 H:i', $time);
                break;
            case $d < $ld:
                $fdate = date('m月d日', $time);
                break;
            default:
                $fdate = date('Y年m月d日', $time);
                break;
        }
    }
    return $fdate;
}
/**
 * 剩余时间
 * @dates  2015-07-29
 * @author wangyafei
 * @param  string     $time date格式的时间
 * @return string           友好的剩余时间显示
 */
function friendtime($time){
    if (!$time)
        return false;
    $fdate = '';
    $d   = intval($time)-time();//中间的差时间
    $ld  = mktime(0, 0, 0, 0, 0, date('Y',strtotime("+1 year"))) - $time;//年
    $md  = mktime(0, 0, 0, date('m',strtotime("+1 month")), 0, date('Y')) - $time;//月
    $td  = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - $time; //明天
    $dd  = mktime(0, 0, 0, date('m'), date('d'), date('Y')) - $time; //今天
    if ($d == 0) {
        $fdate = '马上';
    } else {
        switch ($d) {
            case $d > 3600*24*30*12://
                $left_month = intval($d%(3600*24*30*12));
                $left_days = intval($d%(3600*24*30));
                $fdate = round($d/3600/24/30/12).'年'.round($left_month/3600/24/30).'月'.round($left_days/3600/24).'天';
                break;
            case $d > 3600*24*30:
                $left_month = intval($d%(3600*24*30));
                $fdate = round($d/3600/24/30).'月'.round($left_month/3600/24).'天';
                break;
            case $d > 3600*24:
                $fdate = round($d/3600/24).'天' ;
                break;
            case $d > 3600:
                // $day    = round($d/3600/24);
                $fdate = round($d/3600).'小时' ;
                break;
            case $d > 60:
                $fdate = round($d/60).'分钟';
                break;
            case $d > 0:
                $fdate = $d . '秒';
                break;
            default:
                $fdate = date('Y年m月d日', $time).'已结束';
                break;
        }
    }
    return $fdate;
}
/**
 * 过滤html标签内容
 * @dates  2015-09-17
 * @author wangyafei
 * @param  string     $str 页面原先html
 * @return string          
 */
function filterHtml($str)
{
    $str=str_replace("</?[^>]+>", '', $str);
    $str=str_replace("</*[^<>]*>", '', $str);
    $str=str_replace("</?[^>]+>", '', $str);
    $str=str_replace(" ", '', $str);
    $str=str_replace("::", ':', $str);
    $str=str_replace(PHP_EOL, '', $str);
    $str=str_replace("&nbsp;", '', $str);
    return $str;
}
function deletehtml($str)
{
    $str = trim($str);
    $str=strip_tags($str,"");
    $str=preg_replace("{\t}","",$str);
    $str=preg_replace("{\r\n}","",$str);
    $str=preg_replace("{\r}","",$str);
    $str=preg_replace("{\n}","",$str);
    $str=preg_replace("{ }","",$str);
    return $str;
}
/**
 * 剔除非法html标签 （script标签、iframe标签）
 * Enter description here ...
 * @param $str
 */
function filterIllegalHtml($str){
    $bid = array("<script", "</script>", "<textarea>", "</textarea>" ,"<iframe>" ,"</iframe>" ,"<input>" ,"</input>");
    $str =  str_replace($bid, "", $str);
    $str=str_replace("/&lt;p&gt;&amp;lt;script[^>]*>.*<\/script&amp;gt;&lt;/p&gt;/i", '', $str);
    $str=str_replace("/&lt;p&gt;&amp;lt;script[^>]*>.*<\/script&amp;gt;&lt;/p&gt;/i", '', $str);
    $str=str_replace("/&lt;script&gt;.*&lt;\/script&gt;/i", '', $str);
    $str=str_replace("</*[^<>]*>", '3333', $str);
    $str=str_replace("</?[^>]+>", '255', $str);
    return $str;
}

function arrayToObject($e){
    if( gettype($e)!='array' ) return;
    foreach($e as $k=>$v){
        if( gettype($v)=='array' || getType($v)=='object' )
            $e[$k]=(object)arrayToObject($v);
    }
    return (object)$e;
}
 
function objectToArray($e){
    $e=(array)$e;
    foreach($e as $k=>$v){
        if( gettype($v)=='resource' ) return;
        if( gettype($v)=='object' || gettype($v)=='array' )
            $e[$k]=(array)objectToArray($v);
    }
    return $e;
}

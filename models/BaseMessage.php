<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\PostParam;
use app\models\ReturnParam;
use app\models\ReturnCode;
use app\models\ErrorMessage;
/**
 * This is the model class for table "{{%base_message}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $cate
 * @property string $url
 * @property string $method
 * @property integer $user_auth
 * @property string $author
 * @property string $detail
 * @property string $tag
 * @property integer $status
 * @property integer $add_time
 * @property integer $role_apply_level
 * @property integer $sort
 */
class BaseMessage extends \yii\db\ActiveRecord
{
    CONST STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%base_message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url', 'method', 'detail'], 'required'],
            [['cate', 'user_auth', 'status', 'add_time', 'role_apply_level', 'sort'], 'integer'],
            [['detail'], 'string'],
            [['name'], 'string', 'max' => 30],
            [['url', 'tag'], 'string', 'max' => 255],
            [['method'], 'string', 'max' => 10],
            [['author'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '主键id'),
            'name' => Yii::t('app', '接口名称'),
            'cate' => Yii::t('app', '所属分类'),
            'url' => Yii::t('app', '对应的url测试地址'),
            'method' => Yii::t('app', '提交方式'),
            'user_auth' => Yii::t('app', '用户授权'),
            'author' => Yii::t('app', '作者'),
            'detail' => Yii::t('app', '接口详细介绍'),
            'tag' => Yii::t('app', 'tag(多值以，分割)'),
            'status' => Yii::t('app', '状态值（1：显示 0：隐藏）'),
            'add_time' => Yii::t('app', '添加时间'),
            'role_apply_level' => Yii::t('app', '能够查看和修改的等级'),
            'sort' => Yii::t('app', '排序'),
        ];
    }

    public static function getAllFieldType()
    {
        return [
            'INT','STRING','CHAR','VARCHAR','TEXT','TINYINT','DATETIME','BLOB'
        ];
    }
    public function addAllApiMessage($deal_data,$b_id=0)
    {
        $post_return   = $this->dealRelPostParam(ArrayHelper::getValue($deal_data,'PostParam'),$b_id);
        $return_return = $this->dealRealReturnParam(ArrayHelper::getValue($deal_data,'ReturnParam'),$b_id);
        $code_return   = $this->dealRelReturnCode(ArrayHelper::getValue($deal_data,'ReturnCode'),$b_id);
        $error_return  = $this->dealRelErrorMsg(ArrayHelper::getValue($deal_data,'ErrorMessage'),$b_id);
        if ($post_return || $return_return || $code_return || $error_return) {
            return true;
        }
        return false;
    }

    /**
     * 修改基本信息
     * @dates  2015-12-02
     * @author wangyafei
     * @param  array     $deal_data  post过来的数组
     * @param  integer    $b_id      基本信息id
     * @return boolean               
     */
    public function editAllApiMessage($deal_data,$b_id=0)
    {
        $flag = false;
        $post_return   = $this->editRelPostParam(ArrayHelper::getValue($deal_data,'PostParam'),$b_id);
        $return_return = $this->editRelReturnParam(ArrayHelper::getValue($deal_data,'ReturnParam'),$b_id);
        $code_return   = $this->editRelReturnCode(ArrayHelper::getValue($deal_data,'ReturnCode'),$b_id);
        $error_return  = $this->editRelErrorMsg(ArrayHelper::getValue($deal_data,'ErrorMessage'),$b_id);
        if ($post_return || $return_return || $code_return || $error_return ) {
            return true;
        }
        return false;;
    }


    public function updateBaseMessage($id,$post)
    {
        $model = BaseMessage::find()->where(['status'=>1,'id'=>$id])->one();
        $data['BaseMessage'] = $post;
        if ($model->load($data) && $model->save()) {
            return true;
        }
        return false;
    }
    /**
     * post参数的存储
     * @dates  2015-12-01
     * @author wangyafei
     * @param  array     $data  数组
     * @return boolean          
     */
    public function dealRelPostParam($data,$b_id='')
    {
        $return = false;
        if (empty($data)) {
            return false;
        }
        $dataLst = $this->dealParamCommon($data);
        foreach ($dataLst as $ko => $vo) {
            $check_name = ArrayHelper::getValue($vo,'name');
            if (empty($check_name)) {
                ArrayHelper::remove($dataLst,$ko);
            } else {
                $post_param_model = new PostParam();//放在外面是同一个 第二次就是更新
                $data['PostParam'] = $vo;
                if ($post_param_model->load($data)) {
                    //b_id先不写入
                    $post_param_model->b_id = $b_id;
                    $post_param_model->sort = 1;
                    $post_param_model->status = 1;
                    $flag = $post_param_model->save();
                    $return = $flag;
                }
            }
        }
        return $return;
    }
    /**
     * 修改post-param部分
     * @dates  2015-12-02
     * @author wangyafei
     * @param  array     $data   修改内容
     * @param  integer   $b_id  base_message的id
     * @return boolean          
     */
    public function editRelPostParam($data,$b_id='')
    {
        $base    = PostParam::deleteAll(['b_id'=>$b_id]);
        $return  = $this->dealRelPostParam($data,$b_id);
        return $return;
    }
    public function dealRealReturnParam($data,$b_id='')
    {
        $return = false;
        if (empty($data)) {
            return false;
        }
        $dataLst = $this->dealParamCommon($data);
        foreach ($dataLst as $ko => $vo) {
            $check_name = ArrayHelper::getValue($vo,'name','');
            if (empty($check_name)) {
                ArrayHelper::remove($dataLst,$ko);
            } else {
                $return_param_model = new ReturnParam();//放在外面是同一个 第二次就是更新
                $data['ReturnParam'] = $vo;
                if ($return_param_model->load($data)) {
                    //b_id先不写入
                    $return_param_model->b_id = $b_id;
                    $return_param_model->sort = 1;
                    $return_param_model->status = 1;
                    $flag = $return_param_model->save();
                    $return = $flag;
                }
            }
        }
        return $return;
    }
    /**
     * 修改return-param部分
     * @dates  2015-12-02
     * @author wangyafei
     * @param  array     $data   修改内容
     * @param  integer   $b_id  base_message的id
     * @return boolean          
     */
    public function editRelReturnParam($data,$b_id='')
    {
        dump($data);
        $base    = ReturnParam::deleteAll(['b_id'=>$b_id]);
        $return  = $this->dealRealReturnParam($data,$b_id);
        return $return;
    }


    public function dealRelReturnCode($data,$b_id='')
    {
        $return = false;
        if (!empty($data)) {
            $return_code_model = new ReturnCode();//放在外面是同一个 第二次就是更新
            $data['ReturnCode'] = $data;
            if ($return_code_model->load($data)) {
                $return_code_model->b_id = $b_id;
                $return_code_model->errorcode = 0;
                $return_code_model->status = 1;
                $return_code_model->msg = '';
                // $return_code_model->data = '';
                $flag = $return_code_model->save();
                $return = $flag;
            }
        }
        return $return;
    }
    /**
     * 修改代码基本信息
     * @dates  2015-12-02
     * @author wangyafei
     * @param  array     $data 修改内容
     * @param  integer   $b_id base_message的id
     * @return boolean          
     */
    public function editRelReturnCode($data,$b_id='')
    {
        if (empty($data) || empty($data['data'])) {
            return false;
        }
        $post['ReturnCode'] = $data; 
        $model = ReturnCode::find()->where(['status'=>1,'b_id'=>$b_id])->one();
        if ($model->load($post) && $model->save()) {
            return true;
        }
        return false;
    }


    public function dealRelErrorMsg($data,$b_id='')
    {
        $return = false;
        if (empty($data)) {
            return false;
        }
        $dataLst = $this->dealParamCommon($data);
        foreach ($dataLst as $ko => $vo) {
            $check_name = ArrayHelper::getValue($vo,'errorcode','');
            if ($check_name === '') {
                ArrayHelper::remove($dataLst,$ko);
            } else {
                $error_model = new ErrorMessage();//放在外面是同一个 第二次就是更新
                $data['ErrorMessage'] = $vo;
                if ($error_model->load($data)) {
                    $error_model->b_id = $b_id;
                    $error_model->status = 1;
                    $flag = $error_model->save();
                    $return = $flag;
                }
            }
        }
        return $return;
    }
    /**
     * 修改error-msg部分
     * @dates  2015-12-02
     * @author wangyafei
     * @param  array     $data   修改内容
     * @param  integer   $b_id  base_message的id
     * @return boolean          
     */
    public function editRelErrorMsg($data,$b_id='')
    {
        $base    = ErrorMessage::deleteAll(['b_id'=>$b_id]);
        $return  = $this->dealRelErrorMsg($data,$b_id);
        return $return;
    }
    /**
     * 对提交的数据处理成插入表单的数组
     * @dates  2015-12-01
     * @author wangyafei
     * @param  array     $data 提交过来的数组结构
     * @return array           处理后的array
     */
    public function dealParamCommon($data)
    {
        $return = [];
        if (!empty($data)) {
            foreach ($data as $field => $value) {
                foreach ($value as $ko1 => $vo2) {
                    $return[$ko1][$field] = $vo2;
                }
            }
        }
        return $return;
    }
}

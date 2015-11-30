<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%return_param}}".
 *
 * @property string $id
 * @property integer $b_id
 * @property integer $errorcode
 * @property string $msg
 * @property string $data
 * @property string $status
 */
class ReturnParam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%return_param}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b_id', 'errorcode', 'msg'], 'required'],
            [['b_id', 'errorcode'], 'integer'],
            [['data'], 'string'],
            [['msg', 'status'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '主键id'),
            'b_id' => Yii::t('app', 'api基本信息对应的id'),
            'errorcode' => Yii::t('app', '错误代码'),
            'msg' => Yii::t('app', '返回信息'),
            'data' => Yii::t('app', '返回数据'),
            'status' => Yii::t('app', '状态值（1：使用 0：禁止）'),
        ];
    }
}

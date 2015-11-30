<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%code}}".
 *
 * @property string $id
 * @property integer $b_id
 * @property string $success_code
 * @property string $error_code
 * @property integer $status
 */
class Code extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b_id', 'status'], 'integer'],
            [['success_code', 'error_code'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'b_id' => Yii::t('app', 'api信息基本表对应的id'),
            'success_code' => Yii::t('app', '成功代码'),
            'error_code' => Yii::t('app', '错误代码'),
            'status' => Yii::t('app', '状态（1：显示 0：隐藏）'),
        ];
    }
}

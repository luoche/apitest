<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%error_message}}".
 *
 * @property string $id
 * @property integer $b_id
 * @property string $errorcode
 * @property string $msg
 * @property resource $solve_answer
 * @property integer $status
 */
class ErrorMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%error_message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b_id', 'status'], 'integer'],
            [['solve_answer'], 'string'],
            [['errorcode', 'msg'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'b_id' => Yii::t('app', 'code的基本id'),
            'errorcode' => Yii::t('app', '错误代码'),
            'msg' => Yii::t('app', '错误描述'),
            'solve_answer' => Yii::t('app', '解决方案(可以是图片）'),
            'status' => Yii::t('app', '状态值(1：启用 0：隐藏）'),
        ];
    }
}

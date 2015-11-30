<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "{{%post_param}}".
 *
 * @property string $id
 * @property integer $b_id
 * @property string $name
 * @property string $type
 * @property integer $sort
 * @property string $value
 * @property integer $status
 */
class PostParam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%post_param}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['b_id', 'sort', 'status'], 'integer'],
            [['name', 'type', 'value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '主键id'),
            'b_id' => Yii::t('app', '基本表对应的id'),
            'name' => Yii::t('app', '参数名称'),
            'type' => Yii::t('app', '参数类型（如int string）'),
            'sort' => Yii::t('app', '排序'),
            'value' => Yii::t('app', '对应的值'),
            'status' => Yii::t('app', '状态（1：显示 0：隐藏）'),
        ];
    }
}

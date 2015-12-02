<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%post_param}}".
 *
 * @property string $id
 * @property integer $b_id
 * @property string $name
 * @property string $type
 * @property integer $sort
 * @property integer $is_required
 * @property string $value
 * @property string $detail
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
            [['b_id', 'sort', 'is_required', 'status'], 'integer'],
            [['name', 'type', 'value', 'detail'], 'string', 'max' => 255]
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
            'is_required' => Yii::t('app', '是否必须（1：必须 0：非必须）'),
            'value' => Yii::t('app', '对应的值'),
            'detail' => Yii::t('app', '描述'),
            'status' => Yii::t('app', '状态（1：显示 0：隐藏）'),
        ];
    }
}

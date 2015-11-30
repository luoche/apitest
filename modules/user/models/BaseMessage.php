<?php

namespace app\modules\user\models;

use Yii;

/**
 * This is the model class for table "{{%base_message}}".
 *
 * @property string $id
 * @property integer $cate
 * @property string $url
 * @property string $author
 * @property integer $status
 * @property integer $role_apply_level
 * @property integer $sort
 */
class BaseMessage extends \yii\db\ActiveRecord
{
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
            [['cate', 'status', 'role_apply_level', 'sort'], 'integer'],
            [['url'], 'string', 'max' => 255],
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
            'cate' => Yii::t('app', '所属分类'),
            'url' => Yii::t('app', '对应的url测试地址'),
            'author' => Yii::t('app', '作者'),
            'status' => Yii::t('app', '状态值（1：显示 0：隐藏）'),
            'role_apply_level' => Yii::t('app', '能够查看和修改的等级'),
            'sort' => Yii::t('app', '排序'),
        ];
    }
}

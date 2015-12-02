<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $name
 * @property string $detail
 * @property string $url
 * @property integer $sort
 * @property integer $status
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['detail', 'name', 'url'], 'required'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['name'], 'unique'],
            [['detail', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '分类名称'),
            'detail' => Yii::t('app', '分类描述'),
            'url' => Yii::t('app', 'url'),
            'sort' => Yii::t('app', '排序'),
            'status' => Yii::t('app', '分类状态'),
        ];
    }

    /**
     * 获取所有分类的信息 可以是某些字段
     * @dates  2015-12-01
     * @author wangyafei
     * @param  array     $field 字段数组
     * @return array            
     */
    public static function getAllCategory($field='')
    {
        $field = ['id','name'];
        if (empty($field)) {
            $field = '';
        } else if(is_array($field)){
            $field = implode(',', $field);
        }
        $model = Category::find()->select('id,name')->where(['status'=>Category::STATUS_ACTIVE])->orderBy('sort desc,id asc')->asArray()->all();
        return $model;
    }
}

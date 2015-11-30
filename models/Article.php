<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seeed_article".
 *
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $content
 * @property integer $status
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seeed_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name', 'content'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return ApiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApiQuery(get_called_class());
    }
}

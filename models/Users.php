<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $loginIp
 * @property integer $last_login_time
 * @property integer $role
 * @property integer $status
 * @property integer $sort
 * @property integer $count
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_login_time', 'role', 'status', 'sort', 'count'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 255],
            [['loginIp'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', '用户名'),
            'password' => Yii::t('app', '密码'),
            'loginIp' => Yii::t('app', '登录ip'),
            'last_login_time' => Yii::t('app', 'Last Login Time'),
            'role' => Yii::t('app', '角色'),
            'status' => Yii::t('app', '状态值 （1：使用 0：禁止用户）'),
            'sort' => Yii::t('app', '排序'),
            'count' => Yii::t('app', '登录次数'),
        ];
    }
}

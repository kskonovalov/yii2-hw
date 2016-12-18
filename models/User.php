<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\Query;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['login', 'password'], 'string', 'max' => 200],
            [['login'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    public static function findByLogin($login)
    {
        $query = new Query();
        $user = $query->select("*")
            ->from(self::tableName())
            ->where("login = :login", [":login" => $login])
            ->limit(1)
            ->one()
        ;
        return new static($user);
    }

    public static function addUser($login, $password)
    {
        Yii::$app->db->createCommand()->insert(self::tableName(), [
            'login' => $login,
            'password' => $password
        ])->execute();
    }

    public function validatePassword($password)
    {
        return $password === $this->password;
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $query = new Query();
        $user = $query->select("*")
            ->from(self::tableName())
            ->where("id = :id", [":id" => $id])
            ->limit(1)
            ->one()
        ;
        return new static($user);
//        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException("findIdentityByAccessToken not supported yet");
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}

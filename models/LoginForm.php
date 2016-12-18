<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $login;
    public $password;
    public $password2;
    public $rememberMe = true;

    private $_user = false;

    const SCENARIO_LOGIN = "login";
    const SCENARIO_REGISTRATION = "registration";


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // login and password are both required
            [['login', 'password'], 'required', 'on' => self::SCENARIO_LOGIN],
            [['login', 'password', 'password2'], 'required', 'on' => self::SCENARIO_REGISTRATION],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword', 'on' => self::SCENARIO_LOGIN],
            ['login', 'loginNotExists', 'on' => self::SCENARIO_REGISTRATION],
            [['password', 'password2'], 'comparePasswords', 'on' => self::SCENARIO_REGISTRATION],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect login or password.');
            }
        }
    }

    public function loginNotExists($attribute, $params)
    {
        $res = User::findByLogin($this->login);
        die(VAR_DUMP($res, !empty($res)));
    }
    public function comparePasswords($attribute, $params)
    {
        die(VAR_DUMP("comparePasswords",$attribute, $params));
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect login or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided login and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Logs in a user using the provided login and password.
     * @return bool whether the user is logged in successfully
     */
    public function registration()
    {
        if ($this->validate()) {
            $user = $this->saveUser();
            if($user) {
                return Yii::$app->user->login($user,
                    $this->rememberMe ? 3600 * 24 * 30 : 0);
            }
        }
        return false;
    }

    /**
     * Finds user by [[login]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByLogin($this->login);
        }
        return $this->_user;
    }

    public function saveUser()
    {
        if ($this->_user === false) {
            $this->_user = User::addUser($this->login, $this->password);
        }
        return $this->_user;
    }
}

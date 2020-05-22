<?php

namespace app\models\forms;

use app\models\User;
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
    public $email;
    public $password;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [[ 'email', 'password'], 'required'],
            ['email', 'trim'],
            ['email', 'email'],
            // password is validated by validatePassword()
            ['password', 'string', 'min' => 6],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels() {
        return [
            'email' => 'Email',
            'password' => 'Пароль',
        ];
    }


    /**
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Email или пароль указаны неверно.');
            }
        }
    }


    /**
     * @return bool
     */
    public function login()
    {
        if ( $this->validate() ) {
            return Yii::$app->user->login($this->getUser(), 3600*24*7);
        }
        return false;
    }



    /**
     * Get User
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }


}

<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\Email;
use app\components\exceptions\CustomException;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            ['username', 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 255 ],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Указанный логин уже используется'],

            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'validateUserEmail'],

            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels() {
        return [
            'username' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
        ];
    }


    public function validateUserEmail($attribute, $params) {
        if ( !$this->hasErrors() ) {
            if ( $user = User::findByEmail($this->email)) {
                $this->addError($attribute, 'Указанный email уже используется.');
            }
        }
    }


    /**
     * @return User
     * @throws CustomException
     */
    public function save()
    {
        if ( $this->validate() ) {
            $time = time();
            $user = new User();

            $user->username = $this->username;
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            $user->created_at = $user->updated_at = $time;

            if ( !$user->save() ) {
                $except = new CustomException('Ошибка сохранения нового пользователя || SignupForm->save()');
                throw $except->errorExcept('Не удаётся сохранить данные');
            }

            $user->setEmail($this->email, $user->id);
            return $user;
        }
    }

}

<?php

namespace app\components\exceptions;

use Yii;
use yii\helpers\Url;
use yii\base\Exception;

class CustomException extends Exception {

    /** @prop $level string  contains level name */
    protected $level;
    protected $userMsg = null;


    /*
     * Info
     */
    public function infoExcept( $userMsg ) {
        /* init except */
        if ( $this->level == 'infoExcept' ) {
            Yii::$app->session->setFlash('exceptionMsg', $this->userMsg, false);
            Yii::info(PHP_EOL . 'INFO: '. $this->message,  __METHOD__);
            Yii::$app->response->redirect('/');
        }
        /* set */
        else {
            $this->level = 'infoExcept';
            $this->userMsg = $userMsg;
            return $this;
        }
    }


    /*
     * Warning
     */
    public function warningExcept( $userMsg ) {
        /* init except */
        if ( $this->level == 'warningExcept' ) {
            Yii::$app->session->setFlash('exceptionMsg', $this->userMsg, false);
            Yii::warning(PHP_EOL . 'WARNING: '.$this->message, __METHOD__);
            Yii::$app->response->redirect('/');
        }
        /* set */
        else {
            $this->level = 'warningExcept';
            $this->userMsg = $userMsg;
            return $this;
        }
    }


    /*
     * Error
     */
    public function errorExcept( $userMsg ) {
        Yii::$app->session->setFlash('test', $this->userMsg);
        /* init except */
        if ( $this->level == 'errorExcept' ) {
            Yii::$app->session->setFlash('exceptionMsg', $this->userMsg, false);
            Yii::error(PHP_EOL . 'ERROR: '. $this->message, __METHOD__);
            Yii::$app->response->redirect('/');
        }
        /* set and return $this for throw */
        else {
            $this->level = 'errorExcept';
            $this->userMsg = $userMsg;
            return $this;
        }
    }


    /*
     * Init
     */
    public function init() {
        if ( method_exists($this, $this->level) ) {
            $method = $this->level;
            $this->$method( $this->userMsg );
        }
    }

}
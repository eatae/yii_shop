<?php

namespace app\components;

use yii\base\ActionFilter;


class MyFilter extends ActionFilter
{
    public $foo;

    public function beforeAction($action)
    {
        echo 'I\'m filter<br>';
        echo $this->foo;
        if ($action->controller->hasProperty('bar')) {
            $action->controller->bar = 'in Filter';
        }
        //var_dump(get_defined_vars());
        return parent::beforeAction($action);
    }
}
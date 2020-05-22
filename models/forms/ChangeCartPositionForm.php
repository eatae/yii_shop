<?php

namespace app\models\forms;

use yii\base\Model;


class ChangeCartPositionForm extends Model
{
    public $quantity;
    public $product_id;

    public function rules()
    {
        return [
            [['quantity', 'product_id'], 'required'],
            ['quantity', 'integer',
                'min' => 1, 'tooSmall' => 'Количество не может быть менее 1',
                'max' => 100, 'tooBig' => 'Количество не может быть более 100'],
            ['product_id', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'quantity' => 'количество'
        ];
    }
}
<?php

namespace app\models;


use yii\db\ActiveRecord;
use paulzi\adjacencyList\AdjacencyListBehavior;


class Category extends ActiveRecord
{

    public static $tree;

    public static function tableName()
    {
        return 'category';
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }


    /* Adjacency List
    -----------------*/

    /**
     * @return array
     */
    public function behaviors() {
        return [
            [
                'class' => AdjacencyListBehavior::className(),
            ],
        ];
    }


    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }


}
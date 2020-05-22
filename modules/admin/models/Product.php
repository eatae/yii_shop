<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property string $id
 * @property string $name
 * @property string $category_id
 * @property string $content
 * @property string $price
 * @property string $keywords
 * @property string $description
 * @property string $create_timestamp
 * @property string $img
 * @property int $sale 0 or 1
 * @property int $new 0 or 1
 * @property int $hit 0 or 1
 *
 * @property OrderItems[] $orderItems
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'price'], 'required'],
            [['category_id', 'sale', 'new', 'hit'], 'integer'],
            [['content'], 'string'],
            [['price'], 'number'],
            [['create_timestamp'], 'safe'],
            [['name', 'keywords', 'description', 'img'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
            'content' => 'Content',
            'price' => 'Price',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'create_timestamp' => 'Create Timestamp',
            'img' => 'Img',
            'sale' => 'Sale',
            'new' => 'New',
            'hit' => 'Hit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}

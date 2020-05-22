<?php

namespace app\components;

use yii\base\Component;
use app\models\Category;
use app\models\Product;
use Yii;

class MyClass extends Component
{


    public function frontBeforeAction($action)
    {
        /* primary button name */
        $top_button = $action->id;

        /* $_GET contains - category_id / product_id */
        if ( $this->node = $this->getNodeByRequest() ) {
            /* current_root */
            $tmp_root = $this->node->parent;
            $this->current_root = ($tmp_root->isRoot()) ? $tmp_root : $tmp_root->parent;

            $top_button = $this->current_root->name;
        }

        /* get all roots */
        $this->category_roots = Category::find()->roots()->all();
        /* set category_roots in main for draw topMenu */
        $this->view->params['category_roots'] = $this->category_roots;
        $this->view->params['active_buttons'] = $this->setTopMenuButtons( $this->category_roots, $top_button );
    }


    /**
     *
     *
     * @return null|static
     */
    protected function getNodeByRequest()
    {
        $node = null;
        if ( $category_id = Yii::$app->request->get('category_id') ) {
            $node = Category::findOne(['id'=>$category_id]);
        }
        elseif ( $product_id = Yii::$app->request->get('product_id') ) {
            $this->product = Product::findOne(['id'=>$product_id]);
            $node = $this->product->category;
        }
        return $node;
    }

    /**
     * Fill top menu
     *
     * @param array $category_roots
     * @param string $top_button
     * @return array
     */
    protected function setTopMenuButtons(array $category_roots, $top_button = null)
    {
        $top_button =  $top_button ?: 'index';
        $activeButtons = [ 'index' => '', 'about' => '', 'contact' => ''];
        /* add Category button in menu */
        if ( !empty($category_roots) ) {
            foreach ($category_roots as $root) {
                $activeButtons[$root->name] = '';
            }
        }
        /* set class 'active' for button */
        if ( array_key_exists($top_button, $activeButtons) ) {
            $activeButtons[$top_button] = 'active';
        }
        return $activeButtons;
    }



}
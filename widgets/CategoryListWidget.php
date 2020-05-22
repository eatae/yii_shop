<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class CategoryListWidget extends Widget
{
    public $node;
    public $ancestors_ids;
    public $category_parents;

    public function run()
    {
        /*if ( empty($this->$parentsCat) ) {
            return 'Нет товаров';
        }*/
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="widget">
                    <ul class="nav nav-pills nav-stacked">

                    <? foreach ($this->category_parents as $item_parent) {
                        $active_parent = ( in_array($item_parent->id, $this->ancestors_ids) || $item_parent->id == $this->node->id ) ? 'active' : '';
                        $active_all = ($item_parent->id == $this->node->id) ? 'active' : '';
                        ?>
                        <li class="<?= $active_parent; ?>">
                            <a href = "javascript:void(0);"><?= $item_parent->description ?></a>
                            <!-- children -->
                            <ul class="nav inline">
                                    <!-- all  -->
                                    <li>
                                        <a class="<?= $active_all ?>" href ="<?= Url::to(['category', 'category_id' => $item_parent->id])?>">
                                            Все <?= mb_strtolower($item_parent->description) ?>
                                        </a>
                                    </li>
                                <? foreach($item_parent->children as $item_child) {
                                    $active_one = ($item_child->id == $this->node->id) ? 'active' : '';
                                    ?>
                                    <!-- one -->
                                    <li>
                                        <a class="<?= $active_one ?>" href ="<?= Url::to(['category', 'category_id' => $item_child->id])?>">
                                            <?= $item_child->description ?>
                                        </a>
                                    </li>
                                <? } ?>
                            </ul>
                            <!-- end.children -->
                        </li>
                    <? } ?>

                    </ul>
                </div>
            </div>
        </div>
        <?
    }
}
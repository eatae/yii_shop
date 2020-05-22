<?php
/**
 * For Adjacency List
 */

namespace app\models;

use yii\db\ActiveQuery;
use paulzi\adjacencyList\AdjacencyListQueryTrait;


class CategoryQuery extends  ActiveQuery
{
    use AdjacencyListQueryTrait;
}
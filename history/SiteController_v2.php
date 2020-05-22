<?php

//namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\widgets\ProductListWidget;
use yii\db\Expression;
use yz\shoppingcart\ShoppingCart;


class SiteController extends Controller
{

    protected $category_roots;
    protected $category_parents;
    protected $category_childs;

    protected $current_root;
    protected $current_parent;
    protected $current_child;

    protected $product;

    protected $node;


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function beforeAction($action)
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

        return parent::beforeAction($action);
    }



    /**
     * @return mixed|null|static
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
     * @param $category_id
     * @return string
     * @throws NotFoundHttpException
     *
     * Get:
     *  - приходит родительская категория
     *  - приходит дочерняя категория
     *
     * Ajax:
     *  - приходит родительская категория (Все штаны)
     *  - приходит дочерняя категория
     */
    public function actionCategory($category_id)
    {
        if ( !$this->node || !$this->current_root ) {
            throw new NotFoundHttpException('На данный момент отсутсвует запрашиваемая категория.');
        }
        /* get parents category */
        $this->category_parents = $this->current_root->children;

        /* ancestors ids */
        $ancestors_ids = $this->node->getParentsIds();

        /* get products  */
        $ids = $this->node->getDescendantsIds(null, true) ?: [$this->node->id];
        $query = Product::find()->where(['in', 'category_id', $ids]);

        /* pagination */
        $countProducts = clone $query;
        $pages = new Pagination([
            'totalCount' => $countProducts->count(),
            'pageSize'   => 9,
            'route'      => 'category'
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        /* If ajax */
        if ( Yii::$app->request->isAjax ) {
            return ProductListWidget::widget(['pages' => $pages, 'products' => $products]);
        }
        else {
            $params = [
                'pages'              => $pages,                  // for pagination (ProductListWidget)
                'products'           => $products,               // for content (ProductListWidget)
                'node'               => $this->node,             // for left menu
                'ancestors_ids'      => $ancestors_ids,          // for left menu
                'category_parents'   => $this->category_parents, // for left menu
            ];
            return $this->render('category', $params);
        }

    }


    public function actionProductDetail($product_id)
    {
        $product = Product::findOne($product_id);
        $params = [
            'product' => $product,
            'child_category' => $this->node,
            'parent_category' => $this->node->parent,
        ];
        return $this->render('product_detail', $params);
    }






    /**
     * @param $category_id
     * @return string
     * @throws ForbiddenHttpException
     */
//    public function actionCategoryAjax($category_id)
//    {
//        if ( !Yii::$app->request->isAjax ) {
//            throw new ForbiddenHttpException();
//        }
//        elseif ( !$this->node ) {
//            return 'Errorrr category';
//        }
//
//        /* get products  */
//        $ids = $this->node->getDescendantsIds(null, true) ?: [$this->node->id];
//        $query = Product::find()->where(['in', 'category_id', $ids]);
//
//        /* pagination */
//        $countProducts = clone $query;
//        $pages = new Pagination(['totalCount' => $countProducts->count()]);
//        $pages->pageSize = 9;
//        $pages->route = 'category-ajax';
//        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
//
//        return ProductListWidget::widget(['pages' => $pages, 'products' => $products]);
//    }





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


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $hit_products = Product::find()
            ->where(['hit'=> 1])
            ->orderBy(new Expression('rand()'))
            ->limit(4)
            ->all();

        $new_products = Product::find()
            ->where(['new'=> 1])
            ->orderBy(new Expression('rand()'))
            ->limit(4)
            ->all();

        $rand_products = Product::find()
            ->orderBy(new Expression('rand()'))
            ->limit(4)
            ->all();

        return $this->render('index', [
            'hit_products' => $hit_products,
            'new_products' => $new_products,
            'rand_products' => $rand_products
        ]);
    }




    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $this->view->params['activeBtn'] = 'about';
        return $this->render('about');
    }


    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        $this->view->params['activeBtn'] = 'contact';

        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }














    /**************************************/
    /**************************************/



    public function actionTest()
    {
        $cart = new ShoppingCart();

        $positions = $cart->getPositions();
        $product = Product::findOne(1);
//        $cart->put($product, 1);
        /* add params for layout */
        $this->view->params['cart_quantity'] = ( new ShoppingCart() )->count ?: 0;

        return $this->render('test', compact('cart', 'positions'));
    }





    public function actionTest2()
    {
        $tree = Category::mapTree();
        $childs = Category::getChildren($tree[3]);

        return $this->render('test', compact('tree', 'childs'));
    }

    public function actionInfo()
    {
        phpinfo();
    }









    /****************************************/

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }








    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

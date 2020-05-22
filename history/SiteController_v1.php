<?php

//namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\widgets\ProductListWidget;

/**
 * Перед совмещением actionCategory и actionCategoryAjax
 */
class SiteController extends Controller
{

    protected $rootsCat;
    protected $rootNode;
    protected $parentsCat;
    protected $parentNode;
    protected $childsCat;
    protected $currentNode;
    protected $currentParent;


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
        /* get root categories */
        $this->rootsCat = Category::find()->roots()->all();
        /* set rootCat in main for draw topMenu */
        $this->view->params['roots_cat'] = $this->rootsCat;

        $buttonName = $action->id;

        /*
         * 1. Здесь мы должны передать параметры в Layout для отрисовки Верхнего Меню:
         *      - rootsCat          (array objects)
         *      - activeButtons     (array)
         */
        if ( $category_id = Yii::$app->request->get('category_id') ) {
            $this->currentNode = Category::findOne(['id'=>$category_id]);

            if ( !Yii::$app->request->isAjax ) {
                /* текущая корневая */
                $this->rootNode = $this->currentNode->parent;
                /* кнопка которую подсвечиваем */
                $buttonName = $this->rootNode->name;
                $this->view->params['active_buttons'] = $this->setTopMenuButtons( $this->rootsCat, $buttonName );
            }
        }
        return parent::beforeAction($action);
    }


    /**
     * Display Categories page and products
     *
     * @param int $category_id  (parent category id)
     * @return string
     */
    public function actionCategory($category_id)
    {
        if ( !$this->currentNode || !$this->rootNode) {
            return 'Error category';
        }
        /* get parents category */
        $parentsCat = $this->rootNode->children;

        /* get products  */
        $ids = $this->currentNode->getDescendantsIds(null, true) ?: [$this->currentNode->id];
        $query = Product::find()->where(['in', 'category_id', $ids]);

        /* pagination */
        $countProducts = clone $query;
        $pages = new Pagination(['totalCount' => $countProducts->count()]);
        $pages->pageSize = 9;
        $pages->route = 'category-ajax';
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $params = [
            'pages'        => $pages,                // for pagination (ProductListWidget)
            'products'     => $products,            // for content (ProductListWidget)
            'parentsCat'   => $parentsCat,          // for left menu
            'currentNode'  => $this->currentNode,   // for left menu
        ];

        return $this->render('category', $params);
    }


    /**
     * @param $category_id
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionCategoryAjax($category_id)
    {
        if ( !Yii::$app->request->isAjax ) {
            throw new ForbiddenHttpException();
        }
        elseif ( !$this->currentNode ) {
            return 'Errorrr category';
        }

        /* get products  */
        $ids = $this->currentNode->getDescendantsIds(null, true) ?: [$this->currentNode->id];
        $query = Product::find()->where(['in', 'category_id', $ids]);

        /* pagination */
        $countProducts = clone $query;
        $pages = new Pagination(['totalCount' => $countProducts->count()]);
        $pages->pageSize = 9;
        $pages->route = 'category-ajax';
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        echo ProductListWidget::widget(['pages' => $pages, 'products' => $products]);
    }



    /**
     * Fill top menu
     *
     * @param array $cat_roots
     * @param string $buttonName
     * @return array
     */
    protected function setTopMenuButtons(array $cat_roots, $buttonName = null)
    {
        $buttonName =  $buttonName ?: 'index';
        $activeButtons = [ 'index' => '', 'about' => '', 'contact' => ''];
        /* add Category button in menu */
        if ( !empty($cat_roots) ) {
            foreach ($cat_roots as $root) {
                $activeButtons[$root->name] = '';
            }
        }
        /* set class 'active' for button */
        if ( array_key_exists($buttonName, $activeButtons) ) {
            $activeButtons[$buttonName] = 'active';
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
        return $this->render('index');
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



    public function actionTest()
    {
        //$item = Category::find()->indexBy('id')->asArray()->all();
        //$tree = Category::mapTree($item);
        $a = Category::find()->roots()->all();

        return $this->render('test', compact('a'));
    }





    public function actionTest2()
    {
        $tree = Category::mapTree();
        $childs = Category::getChildren($tree[3]);

        return $this->render('test', compact('tree', 'childs'));
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

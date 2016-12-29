<?php

namespace app\modules\products\controllers;

use app\modules\products\models\Products;
use Yii;
use app\modules\products\models\Categories;
use app\modules\products\models\CategoriesSearch;
use yii\caching\DbDependency;
use yii\caching\ExpressionDependency;
use yii\caching\TagDependency;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
{
    public static $cacheDuration = 200;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $cache = \Yii::$app->cache;
        $key = "categoriesList" . md5(serialize(Yii::$app->request->queryParams));

        $searchModel = new CategoriesSearch();
        if(!$dataProvider = $cache->get($key)) {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            $dependency = new DbDependency();
            $dependency->sql = "SELECT * FROM `categories`";
            $cache->set($key, $dataProvider, self::$cacheDuration, $dependency);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categories model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $cache = \Yii::$app->cache;
        $key = "categoryProducts_{$id}";

        if(!$products = $cache->get($key)) {
            $category = Categories::findOne($id);
            $products = $category->products;

            $dependency = new DbDependency();
            $dependency->sql = "SELECT * FROM `product_category` WHERE `category_id` = " . (int)$id;
            $cache->set($key, $products, self::$cacheDuration, $dependency);
        }
        return $this->render('view', [
            'model' => $model,
            'products' => $products
        ]);
    }

    /**
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

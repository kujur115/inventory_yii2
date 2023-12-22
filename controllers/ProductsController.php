<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller {
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'create', 'view', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex() {

        $searchModel = new Products(); 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $searchModel,
        ]);

        // $model = new Products();

        // $model->load(Yii::$app->request->get());

        // return $this->render('index',
        //         [
        //             'model' => $model,
        // ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $model = $this->findModel($id);

        return $this->render('view',
                [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Products();

        if ($model->load(Yii::$app->request->post())) {
            $model->stockFinal = $model->stockFirst;
            if (!($model->uploadImage() && $model->save())) {
                return $this->redirect(['create']);
            }
            return $this->redirect(['index']);
        }

        return $this->render('create',
                [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->uploadImage() && $model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        unlink(Yii::getAlias("@webroot/img/product/$model->imageProduct"));
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionList($id) {
        $countInvoice = Products::find()->where(['id' => $id])->count();
        $invoices = Products::find()->where(['id' => $id])->all();

        if ($countInvoice > 0) {
            foreach ($invoices as $invoice) {
                echo '<input type="text" value="' . $invoice->invoice . '">';
            }
        } else {
            echo '<input type="text" placeholder="Enter Name Product...">';
        }
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}

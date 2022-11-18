<?php

namespace app\controllers;

use app\models\AccountBalance;
use app\models\AccountBalanceSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountBalanceController implements the CRUD actions for AccountBalance model.
 */
class AccountBalanceController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all AccountBalance models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AccountBalanceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccountBalance model.
     * @param int $item_id Item ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($item_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($item_id),
        ]);
    }

    /**
     * Creates a new AccountBalance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AccountBalance();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'item_id' => $model->item_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AccountBalance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $item_id Item ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($item_id)
    {
        $model = $this->findModel($item_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'item_id' => $model->item_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AccountBalance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $item_id Item ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($item_id)
    {
        $this->findModel($item_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AccountBalance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $item_id Item ID
     * @return AccountBalance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_id)
    {
        if (($model = AccountBalance::findOne(['item_id' => $item_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    public function actionMyBalance($teacher_id)
    {
        $searchModel = new AccountBalanceSearch();
        $dataProvider = $searchModel->searchUsersBalance($teacher_id);

        return $this->render('my-balance', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

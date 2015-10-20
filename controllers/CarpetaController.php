<?php

namespace app\controllers;

use Yii;
use app\models\Carpeta;
use app\models\CarpetaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Imagen;
use yii\web\UploadedFile;

/**
 * CarpetaController implements the CRUD actions for Carpeta model.
 */
class CarpetaController extends Controller
{
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
     * Lists all Carpeta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CarpetaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Carpeta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Carpeta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Carpeta();
        $imagen=new Imagen();
        $imagen->load(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()
                ) ) {
            $model->save();
            $imagen->imagen= UploadedFile::getInstance($imagen, 'imagen');
            $imagen->dir='imagenes/'.$model->nombre.$imagen->imagen->baseName.'.'.$imagen->imagen->extension;
            $model->link("idPerfil", Yii::$app->user->identity->idPerfil);
            $imagen->save();
            $imagen->link('idCarpeta',$model);
            $imagen->imagen->saveAs($imagen->dir);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'imagen'=>$imagen,
            ]);
        }
    }

    /**
     * Updates an existing Carpeta model.
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
     * Deletes an existing Carpeta model.
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
     * Finds the Carpeta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Carpeta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Carpeta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

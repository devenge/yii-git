<?php

namespace app\controllers;

use Yii;
use app\models\Page;
use app\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class PageController extends Controller
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







    // главная страница
    public function actionCreate()
    {
        // редирект, если в URL есть параметр "?url" с сокращённой ссылкой
        if (Yii::$app->request->get('url')) {
            $url = Page::find()->where(['alias' => Yii::$app->request->get('url')])->one();
            return $this->redirect($url->url, 301);
        }

        $model = new Page();

        // если ajax, то сохраняем указанную ссылку в сокращённый URL
        if (Yii::$app->request->isAjax) {
            // выводить ответ от Ajax как JSON
            header('Content-Type: application/json');
            
            $post = Yii::$app->request->post();
            $post['Page']['alias'] = uniqid();
              
            if ($model->load($post) && $model->save()) {
                echo json_encode(array('error' => '0', 'short' => $post['Page']['alias']));
            } else {
                echo json_encode(array('error' => '1'));
            }

            exit();
        }

        // вывод страницы по умолчанию
        return $this->render('create', [
            'model' => $model,
        ]);
    }











    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

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
     * Deletes an existing Page model.
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
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}

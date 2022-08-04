<?php

namespace app\controllers;

use app\models\Application;
use app\models\ApplicationSearch;
use app\models\Equipment;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * Контроллер заявок для создания/удаления/изменения заявок
 * расширяет EndopartController. Сделано для ограничения доступа не авторизованным пользователям
 */
class ApplicationController extends EndopartController
{
    /**
     * @inheritDoc
     * Поведение контроллера
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
     * Список всех моделей класса "заявка" (Application)
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ApplicationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->sort = false;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Детальное отображение одной модели "Заявка" (Application)
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException если модель не найдена
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Создание новой заявки
     * При успешном создании возвращает детальное отображение заявки
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Application();
        $e_model = new Equipment();
        if ($this->request->isPost) {
            $post = Yii::$app->request->post();
            $isNew = $post['Equipment']['isNew'];

            if ($isNew != '') {

                $e_model = Equipment::findOne(['serno' => $isNew]);
                if ($e_model == null) {
                    $e_model = new Equipment();
                    $e_model->serno = $isNew;
                    $model->equipment_id = $e_model->id;
                }

            } else if ($model->load($post) ) {
                $e_model->load($post);
                $e_model = Equipment::findOne(['serno' => $e_model->serno]);
                $model->equipment_id = $e_model->id;
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file !== null) {
                    $model->upload();
                }



                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }

//            var_dump($model->load($this->request->post()));die;
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'e_model' => $e_model,
        ]);
    }

    /**
     * Обновление существующей заявки. При успешном выполнении возвращает детальное отображение заявки
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException если модель не найдена
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $e_model = Equipment::findOne($model->equipment_id);
//        var_dump($e_model,$model);
        if ($this->request->isPost && $model->load($this->request->post()) ) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file !== null) {
                $model->upload();
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'e_model' => $e_model,
        ]);
    }

    /**
     * Обновление существующей заявки. При успешном выполнении возвращает детальное отображение заявки
     * @param int $id ID
     * @return string|\yii\web\Response
     */
    public function actionDownload($id)
    {
        $model = Application::findOne($id);
        if ($model->attachment_path !== null) {
            preg_match('#\d{9,}_(.*)#u', $model->attachment_path,$matches) !== null ?
                Yii::$app->response->sendFile($model->attachment_path, $matches[1])->send() : false;
        }
    }

    /**
     * Удаление прилагаемого к заявке файла
     * @param int $id ID
     * @return string|\yii\web\Response
     */
    public function actionDeleteFile($id)
    {
        $model = Application::findOne($id);
        unset($model->attachment_path);
        $model->attachment_path = null;
        $model->save();
        return $this->redirect(['update', 'id' => $id]);
    }

    /**
     * Экспортирует файл XLSX с отчетом по выбранным фильтрам и колонкам
     * @param int $id ID
     * @return string|\yii\web\Response
     */
    public function actionExportFile()
    {
        $searchModel = new ApplicationSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('export-file', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Удалить существующую заявку
     * При успешном удалении возвращает страницу со списком заявок
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException если модель не найдена
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Ищет заявку по ID
     * Если ненайдена, возвращает 404
     * @param int $id ID
     * @return Application загруженную модель
     * @throws NotFoundHttpException если модель не найдена
     */
    protected function findModel($id)
    {
        if (($model = Application::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
    }
}

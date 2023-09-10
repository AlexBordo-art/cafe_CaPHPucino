<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Message;
use app\models\Cafe;
use yii\helpers\Json;
use app\models\Comment;

class CafeController extends Controller
{
    public function actionCreateMessage()
    {
        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-cafe', 'id' => $model->id_cafe]);
        }

        return $this->render('create-message', [
            'model' => $model,
        ]);
    }

    public function actionViewCafe($id)
    {
        $cafe = Cafe::findOne($id);
        $commentModel = new Comment();
        $comments = Comment::find()->where(['id_cafe' => $id])->all();


        if ($commentModel->load(Yii::$app->request->post()) && $commentModel->save()) {
            return $this->refresh();
        }

        if ($cafe !== null) {
            return $this->render('view-cafe', [
                'cafe' => $cafe,
                'commentModel' => $commentModel,
                'comments' => $comments,
            ]);
        } else {
            throw new \yii\web\NotFoundHttpException('Кафе не найдено.');
        }
    }

    public function actionRandomCafe()
    {
        $cafe = Cafe::find()->orderBy('rand()')->one();

        if ($cafe !== null) {
            return $this->render('view-cafe', [
                'cafe' => $cafe,
            ]);
        } else {
            throw new \yii\web\NotFoundHttpException('Кафе не найдено.');
        }
    }

    public function actionFetchCafesFromApi()
    {
        $apiUrl = "https://bandaumnikov.ru/api/test/site/get-index";
        $cafesData = Json::decode(file_get_contents($apiUrl));

        foreach ($cafesData['data'] as $cafeData) {
            $cafe = new Cafe();
            $cafe->attributes = [
                'name' => $cafeData['name'],
                'address' => $cafeData['address'],
                'landmark' => $cafeData['landmark'],
                'cuisine' => $cafeData['cuisine'],
                'distance' => $cafeData['distance'],
                'time' => $cafeData['time'],
                'photo' => $cafeData['photo'],
                'business_lunch' => $cafeData['business_lunch'],
                'price' => $cafeData['price']
            ];
            $cafe->save();
        }

        return $this->redirect(['index']);
    }

    // public function actionCreateComment($id)
    // {
    //     $model = new Comment();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view-cafe', 'id' => $model->id_cafe]);
    //     }

    //     return $this->render('create-comment', [
    //         'model' => $model,
    //         'id' => $id,
    //     ]);
    // }

    public function actionCreateComment($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        // Получаем сырые POST-данные
        $rawData = Yii::$app->request->getRawBody();

        // Декодируем JSON-строку в массив PHP
        $postData = json_decode($rawData, true);

        $model = new Comment();
        $model->id_cafe = $id;  // Устанавливаем ID кафе для нового комментария

        // Загружаем данные в модель из декодированного массива
        $model->text = $postData['text'] ?? null;

        if ($model->save()) {
            return ['status' => 'success', 'message' => 'Комментарий успешно добавлен'];
        }

        return ['status' => 'error', 'message' => 'Не удалось добавить комментарий'];
    }




    // public function actionViewComments($id)
    // {
    //     $comments = Comment::find()->where(['id_cafe' => $id])->all();

    //     return $this->render('view-comments', [
    //         'comments' => $comments,
    //     ]);
    // }

    public function actionViewComments($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $comments = Comment::find()->where(['id_cafe' => $id])->all();

        return $comments;
    }

    public function beforeAction($action)
    {
        if ($action->id == 'create-comment') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
}

<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Cafe;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $cafes = Cafe::find()->all();
        return $this->render('index', [
            'cafes' => $cafes,
        ]);
    }

    public function actionRandomCafe()
    {
        $randomCafe = Cafe::find()->orderBy('rand()')->one();
        if ($randomCafe !== null) {
            return $this->redirect(['cafe/view-cafe', 'id' => $randomCafe->id]);
        } else {
            throw new \yii\web\NotFoundHttpException('Кафе не найдено.');
        }
    }


    // public function actionClearCache()
    // {
    //     Yii::$app->cache->flush();
    //     return 'Кэш очищен';
    // }

}

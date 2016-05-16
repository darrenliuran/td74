<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\components\helpers\BSHelper;
use backend\models\member\IdentityMemberModel;
use backend\components\constants\BKConstant;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
    public $layout = 'general';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
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
        ];
    }

    /**
     * 首页
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }

    /**
     * 登录
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        $identityMemberModel = new IdentityMemberModel();

        if (Yii::$app->request->isPost)
        {
            $memberFormData = Yii::$app->request->post('IdentityMemberModel');
            $username = trim($memberFormData['nick']);
            $password = trim($memberFormData['password']);

            /** @var $memberModel IdentityMemberModel 获取用户信息 */
            $memberModel = IdentityMemberModel::getInfoByUsername($username);

            if (!is_null($memberModel))
            {
                if ($memberModel->password != BSHelper::encryptionPassword($password))
                {
                    Yii::$app->session->setFlash('errorMessage', '密码错误');
                }
                else if ($memberModel->state != BKConstant::AdminMemberStatusOpen)
                {
                    Yii::$app->session->setFlash('errorMessage', '用户暂未启用');
                }
                else if (!Yii::$app->user->login($memberModel, 604800))
                {
                    $memberModel->login_time = time();
                    $memberModel->save(TRUE);
                    Yii::$app->session->setFlash('errorMessage', '登录失败');
                }
                else
                {
                    $this->redirect('/default');
                }

                $identityMemberModel = $memberModel;
            }
            else
            {
                Yii::$app->session->setFlash('errorMessage', '用户不存在');
            }
        }

        return $this->render('login', [
            'adminMemberModel' => $identityMemberModel,
        ]);
    }

    /**
     * 退出
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

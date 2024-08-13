<?php
namespace api\controllers;

use common\models\LoginForm;
use frontend\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;
use common\models\User;

class UserController extends ActiveController
{
	public $modelClass = 'common\models\User';

	public function behaviors()
	{
		$behaviors = parent::behaviors();
		//$behaviors['authenticator']['class'] = QueryParamAuth::className();
		//$behaviors['authenticator']['tokenParam'] = 'access_token';
		$behaviors['authenticator'] = [
			'class' => HttpBearerAuth::className(),
			'except' => ['auth']
		];

		$behaviors['contentNegotiator'] = [
			'class' => '\yii\filters\ContentNegotiator',
			'formatParam' => '_format',
			'formats' => [
				'application/json' => \yii\web\Response::FORMAT_JSON,
			],
		];
		return $behaviors;
	}

	public function actions()
	{
		$actions = parent::actions();
		unset( $actions['create']);
		return $actions;
	}

	public function actionCreate() {
		$model = new SignupForm();
		$model->load(Yii::$app->request->post(),'');
		if (! $model->signup()) {
			return array_values($model->getFirstErrors())[0];
		}
		return true;
	}

	/**
	 * User login.
	 *
	 * @return mixed
	 */
	public function actionAuth(){
		$model = new LoginForm();
		$params = Yii::$app->request->post();
		$model->username = $params['username'];
		$model->password = $params['password'];
		if ($model->login()) {
			$response['access_token'] = \common\models\User::findByUsername($model->username)['access_token'];
			return $response;
		}
		$model->validate();
		return ["error"=>$model->getErrors()];
	}
}

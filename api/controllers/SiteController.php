<?php
namespace api\controllers;

use frontend\models\SignupForm;
use Yii;
use yii\rest\ActiveController;

/**
 * Site controller
 */
class SiteController extends ActiveController {

	public $modelClass = '';

	public function actions() {
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}


	public function actionIndex() {
		return ["test" => "test"];
	}

}

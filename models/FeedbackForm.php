<?php

namespace app\models;

use Yii;
use yii\base\Model;

class FeedbackForm extends Model {

	public $name;
	public $email;

	public function rules()
	{
		return array(
			['name', 'required'],
			['email', 'email']
		);
	}

}

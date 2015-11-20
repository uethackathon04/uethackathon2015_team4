<?php

/**
 * This is the model base class for the table "notification".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Notification".
 *
 * Columns in table "notification" available as properties of the model,
 * followed by relations of table "notification" available as properties of the model.
 *
 * @property integer $notification_id
 * @property integer $user_id
 * @property integer $type
 * @property integer $isSee
 * @property string $content
 * @property integer $date
 *
 * @property User $user
 */
abstract class BaseNotification extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'notification';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Notification|Notifications', $n);
	}

	public static function representingColumn() {
		return 'content';
	}

	public function rules() {
		return array(
			array('notification_id, user_id, type, isSee, content, date', 'required'),
			array('notification_id, user_id, type, isSee, date', 'numerical', 'integerOnly'=>true),
			array('notification_id, user_id, type, isSee, content, date', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'notification_id' => Yii::t('app', 'Notification'),
			'user_id' => null,
			'type' => Yii::t('app', 'Type'),
			'isSee' => Yii::t('app', 'Is See'),
			'content' => Yii::t('app', 'Content'),
			'date' => Yii::t('app', 'Date'),
			'user' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('notification_id', $this->notification_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('type', $this->type);
		$criteria->compare('isSee', $this->isSee);
		$criteria->compare('content', $this->content, true);
		$criteria->compare('date', $this->date);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}
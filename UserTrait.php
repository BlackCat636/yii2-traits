<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-traits
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-traits
 * @version 1.1.1
 */

namespace cinghie\traits;

use Yii;
use dektrium\user\models\User;
use kartik\detail\DetailView;
use kartik\helpers\Html;
use kartik\widgets\Select2;
use yii\helpers\Url;

/**
 * Trait UserTrait
 *
 * @property integer $user_id
 * @property User user
 */
trait UserTrait
{

    /**
     * @inheritdoc
     */
    public static function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function attributeLabels()
    {
        return [
            'user_id' => Yii::t('traits', 'User Id'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        /** @var $this \yii\db\ActiveRecord */
        return $this->hasOne(User::class, ['id' => 'user_id'])->from(User::tableName() . ' AS user');
    }

    /**
     * Generate User Form Widget
     *
     * @param \kartik\widgets\ActiveForm $form
     * @param boolean $disabled
     *
     * @return \kartik\form\ActiveField
     */
    public function getUserWidget($form,$disabled = false)
    {
        if($disabled)
        {
            $value = !$this->user_id ? Yii::t('traits', 'Nobody') : [$this->user_id => $this->user->username];

            return $form->field($this, 'user_id')->widget(Select2::class, [
                'disabled' => true,
                'value' => $value,
                'addon' => [
                    'prepend' => [
                        'content'=>'<i class="glyphicon glyphicon-user"></i>'
                    ]
                ],
            ]);
        }

	    return $form->field($this, 'user_id')->widget(Select2::class, [
		    'data' => $this->getUsersSelect2(),
		    'addon' => [
			    'prepend' => [
				    'content'=>'<i class="glyphicon glyphicon-user"></i>'
			    ]
		    ],
	    ]);
    }

    /**
     * Generate GridView for User
     *
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public function getUserGridView()
    {
        if (isset($this->user->id)) {
            $url = urldecode(Url::toRoute(['/user/admin/update', 'id' => $this->user_id]));
            return Html::a($this->user->username,$url);
        }

	    return '<span class="fa fa-ban text-danger"></span>';
    }

    /**
     * Generate DetailView for User
     *
     * @return array
     * @throws \yii\base\InvalidParamException
     */
    public function getUserDetailView()
    {
        return [
            'attribute' => 'user_id',
            'format' => 'html',
            'value' => $this->user_id ? Html::a($this->user->username,urldecode(Url::toRoute(['/user/admin/update', 'id' => $this->user_id]))) : Yii::t('traits', 'Nobody'),
            'type' => DetailView::INPUT_SWITCH,
            'valueColOptions'=> [
                'style'=>'width:30%'
            ]
        ];
    }

}

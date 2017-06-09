<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-traits
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-traits
 * @version 0.1.0
 */

namespace cinghie\traits;

/*
 * @property string $language
 */
trait LanguageTrait
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language'], 'string', 'max' => 7],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'language' => \Yii::t('traits', 'Language'),
        ];
    }

    /**
     * Return an array with languages allowed
     *
     * @return array
     */
    public function getLanguagesSelect2()
    {
        $languages = \Yii::$app->urlManager->languages;
        $array = ['all' => \Yii::t('traits', 'All Female')];

        foreach($languages as $language) {
            $array[$language] = strtoupper($language);
        }

        return $array;
    }

    /**
     * Generate Language Form Widget
     *
     * @return \kartik\widgets\Select2 widget
     */
    public function getLanguageWidget($form,$model)
    {
        return $form->field($model, 'language')->widget(\kartik\widgets\Select2::classname(), [
            'data' => $model->getLanguagesSelect2(),
            'addon' => [
                'prepend' => [
                    'content'=>'<i class="glyphicon glyphicon-globe"></i>'
                ]
            ],
        ]);
    }

}

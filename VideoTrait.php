<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-traits
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-traits
 * @version 1.0.2
 */

namespace cinghie\traits;

use Yii;
use kartik\widgets\Select2;

/**
 * Trait VideoTrait
 *
 * @property string $video
 * @property string $video_caption
 * @property string $video_credits
 * @property string $video_type
 */
trait VideoTrait
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['video_caption', 'video_credits'], 'string', 'max' => 255],
            [['video'], 'string', 'max' => 50],
            [['video_type'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'video' => Yii::t('traits', 'Video ID'),
            'video_caption' => Yii::t('traits', 'Video Caption'),
            'video_credits' => Yii::t('traits', 'Video Credits'),
            'video_type' => Yii::t('traits', 'Video Type'),
        ];
    }

    /*
     * Return array for Video Type
     *
     * @return array
     */
    public function getVideoTypeSelect2()
    {
        $videotype = [
            'youtube' => 'YouTube',
            'vimeo' => 'Vimeo',
            'dailymotion' => 'Dailymotion'
        ];

        return $videotype;
    }

    /**
     * Generate Video ID Form Widget
     *
     * @param \kartik\widgets\ActiveForm $form
     *
     * @return \kartik\form\ActiveField
     */
    public function getVideoIDWidget($form)
    {
        /** @var $this \yii\base\Model */
        return $form->field($this, 'video', [
            'addon' => [
                'prepend' => [
                    'content'=>'<i class="glyphicon glyphicon-film"></i>'
                ]
            ]
        ])->textInput(['maxlength' => true]);
    }

    /**
     * Generate Video Type Form Widget
     *
     * @param \kartik\widgets\ActiveForm $form
     *
     * @return \kartik\form\ActiveField
     */
    public function getVideoTypeWidget($form)
    {
        /** @var $this \yii\base\Model | \cinghie\traits\VideoTrait */
        return $form->field($this, 'video_type')->widget(Select2::className(), [
            'data' => $this->getVideoTypeSelect2(),
            'addon' => [
                'prepend' => [
                    'content'=>'<i class="glyphicon glyphicon-film"></i>'
                ]
            ],
        ]);
    }

    /**
     * Generate Video Caption Form Widget
     *
     * @param \kartik\widgets\ActiveForm $form
     *
     * @return \kartik\form\ActiveField
     */
    public function getVideoCaptionWidget($form)
    {
        /** @var $this \yii\base\Model */
        return $form->field($this, 'video_caption', [
            'addon' => [
                'prepend' => [
                    'content'=>'<i class="glyphicon glyphicon-facetime-video"></i>'
                ]
            ]
        ])->textarea(['maxlength' => 255,'rows' => 6]);
    }

    /**
     * Generate Video Credits Form Widget
     *
     * @param \kartik\widgets\ActiveForm $form
     *
     * @return \kartik\form\ActiveField
     */
    public function getVideoCreditsWidget($form)
    {
        /** @var $this \yii\base\Model */
        return $form->field($this, 'video_credits', [
            'addon' => [
                'prepend' => [
                    'content'=>'<i class="glyphicon glyphicon-barcode"></i>'
                ]
            ]
        ])->textInput(['maxlength' => 255]);
    }

}

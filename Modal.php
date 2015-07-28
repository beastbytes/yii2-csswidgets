<?php
/**
 * Modal Widget Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   CssWidgets
 */

namespace beastbytes\csswidgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/**
 * CSS only Modal widget.
 */
class Modal extends Widget
{
    /**
     * @var $options the HTML attributes for the widget container tag.
     */
    /**
     * @var boolean|string boolean, `false` no asset bundle will be published;
     * CSS for the widget must be provided elsewhere.
     * string, the fully qualified class name of the widget's CSS asset bundle.
     */
     public $assetBundle = '\beastbytes\yii2-csswidgets\ModalAsset';
    /**
     * @var boolean whether the title should be HTML-encoded.
     */
    public $encodeTitle = true;
    /**
     * @var string label for tge model; when this is clicked the modal is shown
     */
    public $label;
    /**
     * @var string title of the modal. If empty no title is rendered
     */
    public $title;
    public $content;
    public $close = 'X';

    private $_output;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        Yii::$app->getView()->on(
            View::EVENT_END_BODY,
            [$this, 'renderModal']
        );
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo Html::tag('label', $this->label, [
            'class' => 'modal__label',
            'for' => 'modal__control--'.$this->id
        ]);

        $this->_output  = Html::beginTag('div');
        $this->_output .= Html::checkbox($this->id, false, [
            'class' => 'modal__control',
            'id' => 'modal__control--'.$this->id
        ]);
        $this->_output .= Html::beginTag('div', [
            'class' => 'modal__container'
        ]);
        $this->_output .= Html::beginTag('div', $this->options);

        if (!empty($this->title)) {
            $this->_output .= Html::tag('div', $this->title, [
                'class' => 'modal__title'
            ]);
        }
        $this->_output .= Html::tag('label', $this->close, [
            'class' => 'modal__close',
            'for' => 'modal__control--'.$this->id
        ]);
        $this->_output .= Html::tag('div', $this->content, ['class' => 'modal__content']);
        $this->_output .= Html::endTag('div');
        $this->_output .= Html::endTag('div');
        $this->_output .= Html::endTag('div');
    }

    /**
     * Renders the modal
     *
     * @param yii\base\Event $event the event
     */
    public function renderModal($event)
    {
        echo $this->_output;
    }
}

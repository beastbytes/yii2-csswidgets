<?php
/**
 * Widget Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   CssWidgets
 */

namespace beastbytes\cssWidgets;

use yii\helpers\Html;
use yii\helpers\StringHelper;

/**
 * \beastbytes\cssWidgets\Widget is the base class for all CSS based widgets
 */
class Widget extends \yii\base\Widget
{
    /**
     * @var string Fully qualified class name of the widget's CSS asset bundle.
     */
     public $assetBundle;
    /**
     * @var array HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details of how
     * attributes are rendered.
     */
    public $options = [];

    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }

        Html::addCssClass(
            $this->options,
            strtolower(StringHelper::basename(get_class($this)))
        );

        $assetBundle = $this->assetBundle;
        $assetBundle::register($this->getView());
    }
}

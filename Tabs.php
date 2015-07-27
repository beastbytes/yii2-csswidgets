<?php
/**
 * Tabs Widget Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   CssWidgets
 */

namespace beastbytes\cssWidgets;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * CSS only Tabs widget.
 * With one exception, the widget is compatible with JUI Tabs, but is
 * lighter weight as it uses CSS only, i.e. no JavaScript.
 * The compatibility exception is that $headerOptions['tag'] is ignored; the
 * header tag is a `label` tag.
 */
class Tabs extends Widget
{
    /**
     * @var $options the HTML attributes for the widget container tag. The following special options are recognized:
     *
     * - tag: string, defaults to "div", the tag name of the container tag of this widget
     *
     * NOTE: various elements of the widget are assigned a class and/or an id in order to implemet
     */
    /**
     * @var string Fully qualified class name of the widget's CSS asset bundle.
     * This must have `$depends` = [`\beastbytes\cssWidgets\BaseTabsAsset`]
     */
     public $assetBundle = '\beastbytes\cssWidgets\TabsAsset';
    /**
     * @var array list of collapsible items. Each item can be an array of the following structure:
     *
     * ~~~
     * [
     *     'header' => 'Item header',
     *     'content' => 'Item content',
     *     // the HTML attributes of the item header container tag. This will overwrite "headerOptions".
     *     'headerOptions' => [],
     *     // the HTML attributes of the item container tag. This will overwrite "itemOptions".
     *     // the following special options are recognised:
     *     // - expanded: boolean,  defaults to `false`, whether this section is expanded
     *     'options' => [],
     * ]
     * ~~~
     */
    public $items = [];
    /**
     * @var array list of HTML attributes for the item container tags. This will be overwritten
     * by the "options" set in individual [[items]]. The following special options are recognized:
     *
     * - tag: string, defaults to "div", the tag name of the item container tags.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $itemOptions = [];
    /**
     * @var array list of HTML attributes for the item header container tags. This will be overwritten
     * by the "headerOptions" set in individual [[items]]. The following special options are recognized:
     *
     * - tag: string, defaults to "div", the tag name of the item container tags.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $headerOptions = [];

    /**
     * Renders the widget.
     */
    public function run()
    {
        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'div');

        Html::addCssClass($option, 'tabs');

        return Html::tag($tag, $this->renderItems(), $options);
    }

    /**
     * Renders collapsible items as specified on [[items]].
     *
     * @param boolean $single Whether only a single section can be expanded
     * @return string the rendering result.
     * @throws InvalidConfigException.
     */
    protected function renderItems()
    {
        $headers = [];
        $items = [];

        foreach ($this->items as $i => $item) {
            if (!array_key_exists('label', $item)) {
                throw new InvalidConfigException("The 'label' option is required.");
            }
            if (!array_key_exists('content', $item)) {
                throw new InvalidConfigException("The 'content' option is required.");
            }

            $itemId = $this->id . "-$i";

            $headerOptions = array_merge(
                $this->headerOptions,
                ArrayHelper::getValue($item, 'headerOptions', []),
                ['for' => $itemId]
            );
            $headerTag = ArrayHelper::remove($headerOptions, 'tag', 'div');
            Html::addCssClass($headerOptions, 'tabs__header');

            $options = array_merge(
                $this->itemOptions,
                ArrayHelper::getValue($item, 'options', [])
            );

            $tag = ArrayHelper::remove($options, 'tag', 'div');
            $active = ArrayHelper::remove($options, 'active', false);

            $headers[] = Html::tag(
                'label',
                $item['label'],
                $headerOptions
            );
            $items[] = Html::tag(
                $tag,
                Html::radio($this->id, $active, [
                    'class' => 'tabs__control',
                    'id' => $itemId
                ]) .
                Html::tag('div', $item['content'], ['class' => 'tabs__content']),
                $options
            );
        }

        return Html::tag('div', join('', $headers), ['class' => 'tabs__headers']) . join('', $items);
    }
}

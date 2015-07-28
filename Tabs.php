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
 */
class Tabs extends Widget
{
    /**
     * @var $options the HTML attributes for the widget container tag. The
     * following special options are recognized:
     *
     * - tag: string, defaults to "div", the tag name of the container tag of
     * this widget
     *
     * NOTE: various elements of the widget are assigned a class and/or an id in
     * order to implemet the tabbed behavoir
     */
    /**
     * @var string Fully qualified class name of the widget's CSS asset bundle.
     * This should have `$depends` = [`\beastbytes\cssWidgets\BaseTabsAsset`]
     */
     public $assetBundle = '\beastbytes\cssWidgets\TabsAsset';
    /**
     * @var array list of tabbed items. Each item is an array of the following
     * structure:
     *
     ~~~
     [
         'header' => 'Item header',
         'content' => 'Item content',
         // the HTML attributes of the item header container tag. This will overwrite "headerOptions".
         'headerOptions' => [],
         // the HTML attributes of the item container tag. This will overwrite "itemOptions".
         // the following special options are recognised:
         // - tag: string, defaults to "div" - tag for tab headers
         // - active: boolean, defaults to `false`, whether this item is the active tab. If no item has the active option set the first item is the active tab. If more than one item has the active option set the last item with its active option set will be the active tab
         // - enabled: boolean, defaults to `true`, whether this tab can be active
         'options' => [],
     ]
     ~~~
     */
    public $items = [];
    /**
     * @var array list of HTML attributes for the item container tags. This will
     * be overwritten by the "options" set in individual [[items]]. The
     * following special options are recognized:
     *
     * - tag: string, defaults to "div", the tag name of the item container tags.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details of how
     * attributes are rendered.
     */
    public $itemOptions = [];
    /**
     * @var array list of HTML attributes for the item header container tags.
     * This will be overwritten by the "headerOptions" set in individual
     * [[items]]. The following special options are recognized:
     *
     * - tag: string, defaults to "div", the tag name of the item header tags.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details of how
     * attributes are rendered.
     */
    public $headerOptions = [];

    private $_activeTab = 0;

    /**
     * Initialises the widget
     */
    public function init()
    {
        parent::init();

        foreach ($this->items as $i => $item) {
            $options = ArrayHelper::remove($item, 'options', []);
            if (ArrayHelper::remove($options, 'active', false)) {
                $this->_activeTab = $i;
            }
            $this->items[$i]['options'] = $options;
        }
    }

        /**
     * Renders the widget.
     */
    public function run()
    {
        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'div');
        Html::addCssClass($options, 'tabs');

        return Html::tag($tag, $this->renderItems(), $options);
    }

    /**
     * Renders collapsible items as specified on [[items]].
     *
     * @return string the rendering result.
     * @throws InvalidConfigException.
     */
    protected function renderItems()
    {
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
            $headerTag = ArrayHelper::remove($headerOptions, 'tag', '');
            Html::addCssClass($headerOptions, 'tabs__header');

            $options = array_merge(
                $this->itemOptions,
                ArrayHelper::getValue($item, 'options', [])
            );
            Html::addCssClass($options, 'tabs__tab');

            $tag = ArrayHelper::remove($options, 'tag', 'div');
            $enabled = ArrayHelper::remove($options, 'enabled', true);

            $items[] = Html::tag(
                $tag,
                Html::radio($this->id, $this->_activeTab === $i, [
                    'class' => 'tabs__control',
                    'id' => $itemId,
                    'disabled' => !$enabled
                ]) .
                Html::tag(
                    'label',
                    $item['label'],
                    $headerOptions
                ) .
                Html::tag('div', $item['content'], ['class' => 'tabs__content']),
                $options
            );
        }

        return join('', $items);
    }
}

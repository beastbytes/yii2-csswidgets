<?php
/**
 * Accordion Widget Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   CssWidgets
 */

namespace beastbytes\csswidgets;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * CSS only Accordion widget.
 * With one exception, the widget is compatible with JUI Accordion, but is
 * lighter weight as it uses CSS only, i.e. no JavaScript.
 * The compatibility exception is that $headerOptions['tag'] is ignored; the
 * header tag is a `label` tag.
 */
class Accordion extends Widget
{
    /**
     * @var $options the HTML attributes for the widget container tag. The
     * following special options are recognized:
     *
     * - single: boolean, defaults to `true`, if `true` only one section of the
     * accordion can be expanded; if `false` sections can be expanded and
     * collapsed individually
     * - tag: string, defaults to "div", the tag name of the container tag of
     * this widget
     *
     * NOTE: various elements of the widget are assigned a class and/or an id in
     * order to implemet the accordion behaviour
     */
    /**
     * @var boolean|string boolean, `false` no asset bundle will be published;
     * CSS for the widget must be provided elsewhere.
     * string, the fully qualified class name of the widget's CSS asset bundle.
     */
     public $assetBundle = '\beastbytes\cssWidgets\AccordionAsset';
    /**
     * @var boolean whether the labels for header items should be HTML-encoded.
     */
    public $encodeLabels = true;
    /**
     * @var array list of collapsible items. Each item is an array of the
     * following structure:
     *
     ~~~
     [
         'header' => 'Item header',
         'content' => 'Item content',
         // the HTML attributes of the item header container tag. This will overwrite "headerOptions".
         'headerOptions' => [],
         // the HTML attributes of the item container tag. This will overwrite "itemOptions".
         // the following special options are recognised:
         // - expanded: boolean, defaults to `false`, whether this section is expanded
         // - enabled: boolean, defaults to `true`, whether this section is enabled
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
     * - tag: string, defaults to "div", the tag name of the item container tags.
     *
     * @see \yii\helpers\Html::renderTagAttributes() for details of how
     * attributes are rendered.
     */
    public $headerOptions = [];

    /**
     * Renders the widget.
     */
    public function run()
    {
        $options = $this->options;
        $single = ArrayHelper::remove($options, 'single', true);
        $tag = ArrayHelper::remove($options, 'tag', 'div');

        return Html::tag($tag, $this->renderItems($single), $options);
    }

    /**
     * Renders collapsible items as specified on [[items]].
     *
     * @param boolean $single Whether only a single section can be expanded
     * @return string the rendering result.
     * @throws InvalidConfigException.
     */
    protected function renderItems($single)
    {
        $items = [];

        foreach ($this->items as $i => $item) {
            if (!array_key_exists('header', $item)) {
                throw new InvalidConfigException("The 'header' option is required.");
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
            $headerTag = ArrayHelper::remove($headerOptions, 'tag', ''); // just for JUI Accordion compatibility
            Html::addCssClass($headerOptions, 'accordion__header');

            $options = array_merge(
                $this->itemOptions,
                ArrayHelper::getValue($item, 'options', [])
            );

            $control = ($single ? 'radio' : 'checkbox');
            $tag = ArrayHelper::remove($options, 'tag', 'div');
            $expanded = ArrayHelper::remove($options, 'expanded', false);
            $enabled = ArrayHelper::remove($options, 'enabled', true);

            $items[] = Html::tag(
                $tag,
                Html::$control($this->id, $expanded, [
                    'class' => 'accordion__control',
                    'id' => $itemId,
                    'disabled' => !$enabled
                ]) .
                Html::tag(
                    'label',
                    $item['header'],
                    $headerOptions
                ) .
                Html::tag('div', $item['content'], ['class' => 'accordion__content']),
                $options
            );
        }

        return join('', $items);
    }
}

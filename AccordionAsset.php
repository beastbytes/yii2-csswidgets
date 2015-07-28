<?php
/**
 * AccordionAsset Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   CssWidgets
 */

namespace beastbytes\csswidgets;

/**
 * AccordionAsset Class.
 * Default asset bundle for the Accordion widget
 */
class AccordionAsset extends \yii\web\AssetBundle
{
    public $basePath   = '@webroot';
    public $sourcePath = '@beastbytes/yii2-csswidgets/assets';
    public $depends    = ['beastbytes\csswidgets\BaseAccordionAsset'];
    public $css        = ['Accordion.css'];
}

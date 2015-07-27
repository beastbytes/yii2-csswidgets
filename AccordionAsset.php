<?php
/**
 * AccordionAsset Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   CssWidgets
 */

namespace beastbytes\cssWidgets;

/**
 * AccordionAsset Class.
 * Default asset bundle for the Accordion widget
 */
class AccordionAsset extends \yii\web\AssetBundle
{
	public $basePath   = '@webroot';
	public $sourcePath = '@beastbytes/cssWidgets/assets';
	public $depends    = ['beastbytes\cssWidgets\BaseAccordionAsset'];
    public $css        = ['Accordion.css'];
}

<?php
/**
 * BaseAccordionAsset Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   CssWidgets
 */

namespace beastbytes\csswidgets;

/**
 * BaseAccordionAsset Class.
 * Base asset bundle for the Accordion CSS
 */
class BaseAccordionAsset extends \yii\web\AssetBundle
{
	public $basePath   = '@webroot';
	public $sourcePath = '@beastbytes/cssWidgets/assets';
    public $css        = ['BaseAccordion.css'];
}

<?php
/**
 * BaseTabsAsset Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   CssWidgets
 */

namespace beastbytes\cssWidgets;

/**
 * BaseTabsAsset Class.
 * Base asset bundle for the Tabs CSS
 */
class BaseTabsAsset extends \yii\web\AssetBundle
{
	public $basePath   = '@webroot';
	public $sourcePath = '@beastbytes/cssWidgets/assets';
    public $css        = ['BaseTabs.css'];
}

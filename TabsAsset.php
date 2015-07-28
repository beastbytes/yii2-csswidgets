<?php
/**
 * TabsAsset Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   CssWidgets
 */

namespace beastbytes\csswidgets;

/**
 * TabsAsset Class.
 * Default asset bundle for the Tabs widget
 */
class TabsAsset extends \yii\web\AssetBundle
{
	public $basePath   = '@webroot';
	public $sourcePath = '@beastbytes/cssWidgets/assets';
	public $depends    = ['beastbytes\cssWidgets\BaseTabsAsset'];
    public $css        = ['Tabs.css'];
}

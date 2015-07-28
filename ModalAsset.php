<?php
/**
 * ModalAsset Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   CssWidgets
 */

namespace beastbytes\csswidgets;

/**
 * ModalAsset Class.
 * Default asset bundle for the Modal widget
 */
class ModalAsset extends \yii\web\AssetBundle
{
	public $basePath   = '@webroot';
	public $sourcePath = '@beastbytes/cssWidgets/assets';
	public $depends    = ['beastbytes\cssWidgets\BaseModalAsset'];
    public $css        = ['Modal.css'];
}

<?php
/**
 * BaseModalAsset Class file
 *
 * @author    Chris Yates
 * @copyright Copyright &copy; 2015 BeastBytes - All Rights Reserved
 * @license   BSD 3-Clause
 * @package   CssWidgets
 */

namespace beastbytes\csswidgets;

/**
 * BaseModalAsset Class.
 * Base asset bundle for the Modal CSS
 */
class BaseModalAsset extends \yii\web\AssetBundle
{
    public $basePath   = '@webroot';
    public $sourcePath = '@beastbytes/yii2-csswidgets/assets';
    public $css        = ['BaseModal.css'];
}

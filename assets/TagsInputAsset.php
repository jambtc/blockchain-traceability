<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Tags asset bundle.
 *
 * @author Sergio Casizzone <jambtc@gmail.com>
 * @since 2.0
 */
class TagsInputAsset extends AssetBundle
{
    public $basePath = '@webroot/bundles/tagsinput';
    public $baseUrl = '@web/bundles/tagsinput';
    public $css = [
        'tagsinput.css',
    ];
    public $js = [
        'tagsinput.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];
}

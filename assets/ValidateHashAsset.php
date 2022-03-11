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
class ValidateHashAsset extends AssetBundle
{
    public $basePath = '@webroot/bundles/validate-hash';
    public $baseUrl = '@web/bundles/validate-hash';
    public $css = [
    ];
    public $js = [
        'validate.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];
}

<?php

namespace app\assets;

use ScssPhp\ScssPhp\Exception\SassException;
use yii\web\AssetBundle;
use ScssPhp\ScssPhp\Compiler;
use Yii;

class AppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = ['css/site.css'];
  public $js = [];
  public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap\BootstrapAsset',
  ];

  /**
   * @throws SassException
   */
  public function init(): void
  {
    parent::init();

    if (YII_ENV_DEV) {
      $scssFile = Yii::getAlias('@app/assets/scss/site.scss');
      $cssFile  = Yii::getAlias('@webroot/css/site.css');

      if (!is_file($cssFile) || filemtime($scssFile) > filemtime($cssFile)) {
        $scss = new Compiler();
        $scss->setImportPaths(dirname($scssFile));

        $compiledCss = $scss->compileString(file_get_contents($scssFile))->getCss();
        file_put_contents($cssFile, $compiledCss);
      }
    }
  }
}

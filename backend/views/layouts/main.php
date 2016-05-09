<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link href="<?= Yii::$app->params['cssUrl'] ?>/bootstrap.min.css" rel="stylesheet">
    <link href="<?= Yii::$app->params['staticBaseUrl'] ?>/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= Yii::$app->params['cssUrl'] ?>/animate.css" rel="stylesheet">
    <link href="<?= Yii::$app->params['cssUrl'] ?>/style.css" rel="stylesheet">
</head>

<body>
<?php $this->beginBody() ?>
    <?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

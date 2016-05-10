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

    <link href="<?= Yii::$app->params['cssUrl'] ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= Yii::$app->params['cssUrl'] ?>/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= Yii::$app->params['cssUrl'] ?>/css/animate.css" rel="stylesheet">
    <link href="<?= Yii::$app->params['cssUrl'] ?>/css/style.css" rel="stylesheet">

    <script src="<?= Yii::$app->params['cssUrl'] ?>/js/jquery-2.1.1.js"></script>
    <script src="<?= Yii::$app->params['cssUrl'] ?>/js/bootstrap.min.js"></script>
</head>
<body>
<?php $this->beginBody() ?>
    <?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

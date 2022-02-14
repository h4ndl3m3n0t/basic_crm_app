<?php

use app\models\User;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        // 'brandUrl' => Yii::$app->homeUrl,
        'brandUrl' => Yii::$app->user->isGuest ? ['/site/login'] : ['/dashboard/index'],
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark',
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid'
        ]
    ]);
    $menuItems = [];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {

        if(Yii::$app->user->identity->roles === User::ROLE_ADMIN){
            $menuItems[] = ['label' => '<i class="fas fa-tachometer-alt"></i> Dashboard', 'url' => ['/dashboard/index']];
            $menuItems[] = ['label' => 'Product', 'url' => ['/product/index']];
            $menuItems[] = ['label' => 'Category', 'url' => ['/category/index']];
        }
        $menuItems[] = [
                'label' => '<i class="fas fa-door-open"></i> Logout',
                'url' => ['/site/logout'],
                'linkOptions' => [
                    'data-method' => 'post'
                ],
            ];
    }
    echo Nav::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>

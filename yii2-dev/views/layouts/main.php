<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;



use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\components\GhostNav;
use webvimark\modules\UserManagement\UserManagementModule;




AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title>College Management System</title>
    <?php $this->head() ?>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        // GhostNav::begin([
        NavBar::begin([
            // 'brandLabel' => Yii::$app->name,
            // 'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top', 'style' => 'height:50px, padding-top:10px;']
            // 'options' => ['class' => 'nav-pills nav-stacked'],
        ]);
        // echo GhostMenu::widget([
        echo Nav::widget([
            'encodeLabels' => false,
            'activateParents' => true,
            'options' => ['class' => 'navbar-nav mx-auto',],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],



                // echo GhostMenu::widget([
                // 'encodeLabels'=>false,
                // 'activateParents'=>true,
                // 'items' => [
                [
                    'label' => 'User Management',
                    'items' => UserManagementModule::menuItems(),
                ],
                [
                    'label' => 'Subjects',
                    'items' => [
                        ['label' => 'crear', 'url' => ['/subject/create']],
                        ['label' => 'index', 'url' => ['/subject/index']],
                    ],
                ],
                [
                    'label' => 'Payments',
                    'items' => [
                        ['label' => 'crear', 'url' => ['/payment/create']],
                        ['label' => 'index', 'url' => ['/payment/index']],
                    ],
                ],
                [
                    'label' => 'Grades',
                    'items' => [
                        ['label' => 'crear', 'url' => ['/user-has-grade/create']],
                        ['label' => 'index', 'url' => ['/user-has-grade/index']],
                    ],
                ],
                [   
                    'label' => Yii::$app->user->identity->username,
                    'items' => [
                        ['label' => 'Profile Data', 'url' => Url::toRoute(['/user-management/user/view','id' => Yii::$app->user->identity->id]) ],
                        ['label' => 'Logout', 'url' => ['/user-management/auth/logout']],
                        ['label' => 'Change own password', 'url' => ['/user-management/auth/change-own-password']],
                        ['label' => 'Password recovery', 'url' => ['/user-management/auth/password-recovery']],
                        ['label' => 'E-mail confirmation', 'url' => ['/user-management/auth/confirm-email']],
                    ]
                ]
            ],
        ]);

        // Yii::$app->user->isGuest
        //     ? ['label' => 'Login', 'url' => ['/site/login']]
        //     : '<li class="nav-item">'
        //         . Html::beginForm(['/site/logout'])
        //         . Html::submitButton(
        //             'Logout (' . Yii::$app->user->identity->username . ')',
        //             ['class' => 'nav-link btn btn-link logout']
        //         )
        //         . Html::endForm()
        //         . '</li>'
        // ]
        // ]);

        // GhostNav::end();
        NavBar::end();

        ?>
    </header>


    <main id="main" class="flex-shrink-0" role="main">

        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])) : ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto py-3 bg-light">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; College Management System <?= date('Y') ?></div>
                <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
$this->registerJsFile("@web/js/main.js", ['depends' => \yii\web\JqueryAsset::class]);
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Dashboard</h1>
    </div>

    <div class="body-content">

    </div>

    <?= $this->render("@app/views/site/login-popup")?>
    <?= $this->render("@app/views/site/signup-popup")?>
    <?= $this->render("@app/views/site/flash-message")?>
    <?= $this->render("@app/views/site/project-view")?>
    <?= $this->render("@app/views/site/task-view")?>
</div>

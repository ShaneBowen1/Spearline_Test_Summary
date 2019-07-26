<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('chosen.min') ?>

    <?= $this->Html->script('jquery') ?>
    <?= $this->Html->script('chosen.jquery.min') ?>

<!--    <?= $this->Html->css([
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css'
]) ?>


<?= $this->Html->script([
    '//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js',
    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'
]);?> -->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <!-- Edited by Alex, added the navigation element that will be used on every page -->
        <!-- <?= $this->element('navigation') ?>  -->
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    <?= $this->Html->scriptBlock('$(".dropdownwithsearch").chosen();', ['defer' => true]) ?>
    </footer>
</body>
</html>

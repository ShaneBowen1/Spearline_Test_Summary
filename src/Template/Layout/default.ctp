<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
<?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,600, 700" rel="stylesheet">
    <title>
        <?= $title ?>
    </title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->script('chart.min') ?>
    <?= $this->Html->script('jquery-3.1.1.min') ?>
    <?= $this->Html->script('jquery-ui-1.12.1') ?>
    <?= $this->Html->script('jquery.ui.custom') ?>
    <?= $this->Html->script('jquery-1.12.4.min') ?>
    <?= $this->Html->script('jquery-ui-1.12.1.min') ?>
    <?= $this->Html->script('weekPicker') ?>
    <?= $this->Html->script('default') ?>
    <?= $this->Html->script('excanvas.min') ?>
    <?= $this->Html->script('jquery.dataTables.min') ?>
    <?= $this->Html->script('jquery.min') ?>
    <?= $this->Html->script('notify.min') ?>
    <?= $this->Html->script('jquery.easy-pie-chart') ?>
    <!-- <?= $this->Html->script('jquery.flot.crosshair') ?> 
    <?= $this->Html->script('jquery.flot.min') ?>
    <?= $this->Html->script('jquery.flot.pie') ?>
    <?= $this->Html->script('jquery.flot.pie.min') ?>
    <?= $this->Html->script('jquery.flot.pie.min') ?>
    <?= $this->Html->script('jquery.flot.stack') ?>
    <?= $this->Html->script('jquery.flot.resize.min') ?> 
    <?= $this->Html->script('jquery.gritter.min') ?> -->
    <?= $this->Html->script('jquery.min') ?>
    <?= $this->Html->script('select2.min') ?>
    <?= $this->Html->script('jquery.peity.min') ?>
    <?= $this->Html->script('jquery.uniform') ?>
    <?= $this->Html->script('jquery.validate') ?>
    <?= $this->Html->script('bootstrap.min') ?>
    <?= $this->Html->script('bootstrap-colorpicker') ?>
    <?= $this->Html->script('bootstrap-datepicker') ?>
    <?= $this->Html->script('bootstrap-wysihtml5') ?>
    <?= $this->Html->script('masked') ?>
    <?= $this->Html->script('matrix') ?>
    <?= $this->Html->script('matrix.login') ?>
    <?= $this->Html->script('matrix.popover') ?>
    <!-- <?= $this->Html->script('matrix.tables') ?> 
    <?= $this->Html->script('matrix.wizard') ?>
    <?= $this->Html->script('matrix.calendar') ?>
    <?= $this->Html->script('matrix.charts') ?>
    <?= $this->Html->script('matrix.chat') ?>
    <?= $this->Html->script('matrix.dashboard') ?> -->
  <!--  <?= $this->Html->script('matrix.form_common') ?> -->
  <!--   <?= $this->Html->script('matrix.form_validation') ?>
    <?= $this->Html->script('matrix.interface') ?> -->

    <!-- js files for daterangepicker -->
    <?= $this->Html->script('jquery-ui-1.11.4.min') ?>
    <?= $this->Html->script('moment.min') ?>
    <?= $this->Html->script('jquery.comiseo.daterangepicker.min') ?>
    <!-- js files for daterangepicker -->

    <?= $this->Html->script('jquery.tablesorter') ?>


    <!--<?= $this->Html->script('bootstrap-datetimepicker.min') ?>-->

    <?= $this->Html->css('default.css') ?>
    <?= $this->Html->css('bootstrap-datetimepicker') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <!-- css files for daterangepicker -->
    <?= $this->Html->css('jquery-ui.min.css') ?>
    <?= $this->Html->css('jquery.comiseo.daterangepicker.css') ?>
    <!-- css files for daterangepicker -->
    <?= $this->Html->css('daterangepicker.min.css') ?>
    <?= $this->Html->css('bootstrap-responsive.min.css') ?>
    <?= $this->Html->css('colorpicker.css') ?>
    <?= $this->Html->css('datepicker.css') ?>
    <?= $this->Html->css('font-awesome.css') ?>
    <?= $this->Html->css('jquery.easy-pie-chart.css') ?>
    <?= $this->Html->css('jquery.gritter.css') ?>
    <!-- <?= $this->Html->css('matrix-media.css') ?> -->
    <?= $this->Html->css('matrix-style.css') ?>
    <?= $this->Html->css('select2.css') ?>
    <?= $this->Html->css('uniform.css') ?>
    <?= $this->Html->css('phone.css') ?>
    <?= $this->Html->css('tablet.css') ?>
    <?= $this->Html->css('/fontawesome/css/font-awesome.css') ?>
    <?= $this->Html->css('theme.default.css') ?>
    <!-- <?= $this->Html->css('notify.css') ?> -->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <?= $this->Flash->render() ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>

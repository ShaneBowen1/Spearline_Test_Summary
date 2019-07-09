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

$title = 'Spearline Test Summary';
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

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.fp.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/mapping.fp.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js"></script>

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
    <?= $this->Html->css('matrix-media.css') ?>
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
    <!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html"></a></h1>
</div>
<!--close-Header-part-->


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class="welcome"><i class="icon icon-user"></i>Welcome</li>
    <li class="logout"><?php echo $this->Html->link('<i class="icon icon-share-alt"></i> <span class="text">Logout</span>', [ 'controller' => 'User','action' => 'logout'], ['escape' => false]);?></li>
  </ul>
</div>
<!--close-top-Header-menu-->

<!--sidebar-menu-->
<div class='footer main_footer'>
    <ul>
        <li class="copyright" style="font-size: 16px">
            <?= $this->Form->button("<i class='icon-envelope-alt'></i>".__('Contact support'), ['type' => 'button', 'class'=>'btn btn-primary link contact', 'data-href'=>$this->Url->build(["controller" => "Contact", "action" => "index"])]) ?>
        </li>
        <li class="copyright"> 
            <div class="copyright-inner-div"><span>&copy;<?php echo date('Y');?> Spearline</span></div>
            <div><span>All Rights Reserved.</span></div>
        </li>
    </ul>
    
</div>

<div id="loadingDiv" style="display: none;"></div>
<!-- Contact Us Modal -->
<div id="contactModal" class="modal fade" role="dialog" style="display:none;">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Contact support</h4>
      </div>
      <div class="modal-body"> 
      </div>   
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <p class='ajax_message'></p>
      </div>
    </div>
  </div>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div class="content-default">
  <?= $this->fetch('content') ?>
</div>
<div class='footer child_footer' hidden>
        <ul>
            <li class="copyright" style="font-size: 16px">
                <?= $this->Form->button("<i class='icon-envelope'></i>".__('Contact support'), ['type' => 'button', 'class'=>'btn btn-primary link contact', 'data-href'=>$this->Url->build(["controller" => "Contact", "action" => "index"])]) ?>
            </li>
            <li class="copyright"> 
                <div class="copyright-inner-div"><span>&copy;<?php echo date('Y');?> Spearline</span></div>
                <div><span>All Rights Reserved.</span></div>
            </li>
        </ul>
    </div>
</body>
</html>

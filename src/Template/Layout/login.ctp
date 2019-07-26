<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->script('//code.jquery.com/jquery-1.12.1.js') ?>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,600, 700" rel="stylesheet">
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Login
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('login') ?>
    <?= $this->Html->css('awesome/css/font-awesome.min.css') ?>
    <?= $this->Html->script('jquery') ?>
    <?= $this->Html->script('login') ?>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="copyto">
        <div id="copytitle">Baltimore Beacon, West Cork, Ireland</div>
        <div clas="copydetails">Photo: David O'Donoghue</div>
        <div clas="copydetails">Solutions Architect at Spearline</div>
    </div>
    <div id='login-window'>
        <?= $this->fetch('content') ?>
    </div>
</body>
</html>

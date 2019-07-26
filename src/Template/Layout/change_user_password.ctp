<!DOCTYPE html>
<html>
<head>
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
        <div clas="copydetails">Service Delivery Manager at Spearline Labs</div>
    </div>

    <?= $this->Flash->render('flash', ['element' => 'Flash/change_user_passowrd_error']) ?>

    <div id='login-window'>
        <?= $this->fetch('content') ?>
    </div>
</body>
</html>

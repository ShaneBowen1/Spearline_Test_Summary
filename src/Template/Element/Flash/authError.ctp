<?= $this->Html->script('notify.min') ?>
<script>
    $( document ).ready(function() {
        $('.menu-option-choosen').notify( '<?= h($message) ?>', { position:"right" });
    });
</script>

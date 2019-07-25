<?php
    $unauthorized = $this->request->session()->consume('unauthorized') ? 1 : 0;
    if($unauthorized): ?>
        <script>
            window.top.location.reload();
            var isInIframe = window.frameElement && window.frameElement.nodeName == "IFRAME";
            if(isInIframe) {
                if(parent.$.featherlight.current())
                    parent.$.featherlight.current().close();
                window.top.location.reload();
            }
        </script>
<?php else: ?>

<?php endif; ?>

<style>
	#content {
		height: 80%;
	}
</style>
<?php
$formatted_url = substr($this->Url->build('/', true), 0, -1);

$url = str_replace('/admin', '', $formatted_url);
$url = str_replace('/GitHubadmin', '', $url);

?>

<iframe src="/<?= $app ?>" allow="microphone *;" style="width:100%; height:100%;"></iframe>

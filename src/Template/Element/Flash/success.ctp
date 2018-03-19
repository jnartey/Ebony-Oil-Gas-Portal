<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="callout success" onclick="this.classList.add('hidden')"><span class="fa fa-info"></span> <span><?= $message ?></span></div>

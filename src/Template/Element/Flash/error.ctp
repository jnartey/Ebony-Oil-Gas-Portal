<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="callout alert" onclick="this.classList.add('hidden');"><span class="fa fa-info"></span> <span><?= $message ?></span></div>

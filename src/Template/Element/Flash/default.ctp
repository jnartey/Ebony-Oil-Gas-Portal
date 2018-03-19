<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="callout warning <?= h($class) ?>" onclick="this.classList.add('hidden');"><span class="fa fa-info"></span> <span><?= $message ?></span></div>

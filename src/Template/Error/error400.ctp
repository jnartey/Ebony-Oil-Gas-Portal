<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'default';

if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?= $this->element('auto_table_warning') ?>
<?php
    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>
<div class="large-12 columns error-message-wrap text-center">
	<div class="message-box">
		<h2>Oops!</h2>
		<h4>We can't seem to find the page you're looking for...</h4>
		<?php echo $this->Html->link(__('Click here to go back to homepage'), ['controller'=> 'pages', 'action' => 'index'], ['escape'=>false, 'class'=>'button']); ?>
	</div>
	
</div>

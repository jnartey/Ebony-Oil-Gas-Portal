<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$portalDescription = 'Ebony Oil & Gas Corporate Portal';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $portalDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
	<?= $this->Html->meta('keywords', 'enter any meta keyword here') ?>
	<?= $this->Html->meta('description', 'enter any meta description here') ?>
	<?= $this->Html->meta(['link' => '', 'rel' => 'manifest']) ?>


    <?= $this->Html->css('foundation.css') ?>
	<link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/bootstrap/css/bootstrap.min.css', true); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?= $this->Url->build('/bootstrap/css/bootstrap-theme.min.css', true); ?>"/>
	<?= $this->Html->script(['vendor/jquery']); ?>
	<script type="text/javascript" src="<?= $this->Url->build('/bootstrap/js/bootstrap.min.js', true); ?>"></script>
	

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</body>
</html>
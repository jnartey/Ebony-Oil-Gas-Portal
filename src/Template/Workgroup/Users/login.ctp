<!-- File: src/Template/Users/login.ctp -->
<!-- //$this->cell('Misc'); -->
<div id="login-bg">
	<?= $this->element('head'); ?>
	<div id="auth-main" class="large-12 columns">
		<?= $this->Flash->render() ?>
	    <section class="large-12 columns centered">
			<div class="row">
		        <div class="medium-7 columns heading">
		            <h3><?= __('Welcome to the <br />Ebony Oil &amp; Gas Corporate Portal') ?></h3>
		        </div>

		        <div class="medium-5 columns form-section">
		            <h2>Sign In</h2>
					<?= $this->Form->create() ?>
			        <?= $this->Form->control('username', array('placeholder'=>'Username', 'label'=>false)) ?>
			        <?= $this->Form->control('password', array('placeholder'=>'Password', 'label'=>false)) ?>
					<?= $this->Form->button(__('Login')); ?>
					<?= $this->Form->end() ?>
		        </div>
			</div>
	    </section>
	</div>
</div>
<div class="large-12 columns login-footer">
	<?= $this->element('footer'); ?>
</div>
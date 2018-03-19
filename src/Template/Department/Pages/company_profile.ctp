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
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'default';
$this->assign('title', 'Company Profile');
echo $this->element('head');
?>
<div id="mains" class="large-12 columns" data-equalizer data-equalize-on="large">
	<div class="large-12 columns banner">
		<div class="orbit" role="region" aria-label="Banners" data-orbit>
		  <ul class="orbit-container">
		    <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span><span class="fa fa-angle-left fa-3x"></span></button>
		    <button class="orbit-next"><span class="show-for-sr">Next Slide</span><span class="fa fa-angle-right fa-3x"></span></button>
		    <li class="is-active orbit-slide">
		      <?php echo $this->Html->image("oilandgas.jpg", ["alt" => "Ebony Oil & Gas", 'class'=>'orbit-image']); ?>
		      <figcaption class="orbit-caption">
				  <div class="row">
				  	<h2>Welcome to<br />Ebony Oil & Gas Portal</h2>
				  </div>
			  </figcaption>
		    </li>
		  </ul>
		</div>
	</div>
	
	<div class="large-12 columns main-content dashboard company-profile">
		<div class="row">
			<div class="medium-3 columns">
				<div class="medium-12 columns portal-box">
					<ul class="tabs vertical" id="company-library" data-tabs>
				      <li class="tabs-title is-active"><a href="#company-overview" aria-selected="true">Company Overview</a></li>
				      <li class="tabs-title"><a href="#who-we-are">Who We Are</a></li>
				      <li class="tabs-title"><a href="#document-library">Document Library</a></li>
				    </ul>
				</div>
				<?php if(!$activeUser){ ?>
				<div class="medium-12 columns portal-box">
					<?= $this->Flash->render() ?>
			        <div class="medium-12 columns form-section">
			            <h2>Sign In</h2>
						<?= $this->Form->create() ?>
				        <?= $this->Form->control('username', array('placeholder'=>'Username', 'label'=>false)) ?>
				        <?= $this->Form->control('password', array('placeholder'=>'Password', 'label'=>false)) ?>
						<?= $this->Form->button(__('Login')); ?>
						<?= $this->Form->end() ?>
			        </div>
				</div>
				<?php } ?>
				
				<?php if($activeUser){ ?>
				<div class="medium-12 columns portal-box-x">
				    <aside class="column small-12">
				        <?php echo $this->element('aside'); ?>
				    </aside>
				</div>
				<?php } ?>
			</div>
			
			<div class="medium-9 columns">
				<div class="medium-12 columns portal-box">
					<div class="tabs-content vertical" data-tabs-content="company-library">
				      <div class="tabs-panel is-active" id="company-overview">
						 <h3>Company Overview</h3>
						 <div class="large-12">
						 	 <?php echo $this->Html->image("company-overview.jpg", ["alt" => "Ebony Oil & Gas"]); ?><br /><br />
						 </div>
				         <p>
							The company’s vision is to become the largest indigenous importer and distributor of crude and refined petroleum products across the West Africa sub region. From inception, EOGL has been structured to leverage its relationships with key strategic partners in its focused pursuit and attainment of the company’s vision. Since operations commenced in 2011, EOGL has imported and distributed in excess of 500,000 metric tons of refined products into Ghana. With a current working capital in excess of $150million, EOGL recorded a remarkable turnover of $270 million in 2013.
							<br /><br />
							Ebony has consolidated its position as one of the market leaders controlling 10% of the retail distribution market and currently the market leader for Marine Gasoil and Aviation fuel. Ebony is poised to continue the progressive growth in the coming years by leveraging on its key strategic relationships, investing in infrastructure and offering high value proposition to our stakeholders. As part of its business expansion drive, EOGL has commenced the process of constructing a 120,000MT white product multi-purpose storage facility in Takoradi, the Western part of Ghana. This facility which is expected to be completed by 2017 will serve as a hub for distribution of refined products for the upstream and commercial businesses in that region.
				         </p>
				      </div>
				      <div class="tabs-panel" id="who-we-are">
						 <h3>Who We Are</h3>
				         <p>Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>
				      </div>
				      <div class="tabs-panel" id="document-library">
						  <h3>Document Library</h3>
				      </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $this->element('footer'); ?>
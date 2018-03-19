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
							Ebony Oil & Gas limited is a Bulk Distribution Company (BDC) licensed by the National Petroleum Authority, to import and distribute refined petroleum products to local marketing Companies within Ghana and other neighbouring countries in West Africa. It also holds a petroleum service permit which allows it to offer a myriad of services to upstream and offshore entities operating within Ghana.
							<br /><br />
							Ebony Oil & Gas Limited (Ebony), works towards one clear vision; to be the downstream oil and gas Company of choice, consistently and safely delivering excellent energy solutions. This vision underscores its quest not only to deliver value to shareholders, but to consciously recruit, train and retain the best workforce.
							<br /><br />
							Ebony commenced its operations Ghana in April 2011, and over the years, has gained reputation as the most reliable and efficient supplier of refined petroleum products. Through strategic partnerships with key storage terminals, Ebony has distributed over 2million Metric Tonnes of products and it’s poised to increase its trading activities in the coming years. Our team of dynamic, qualified and experienced staff, together with our key stakeholders, particularly our customers, have been the bedrock of the successes we have achieved over the years.
							<br /><br />
							Ebony has in recent years being among the top three BDCs in Ghana in terms of market share, currently supplying more than 10% of the total national petroleum consumption. It is also the leading distributor of Aviation Turbine Kerosene (ATK) in Ghana. Ebony was adjudged the Best BDC in 2015 by reputable awarding institutions, GOGA and OGGA. 
							<br /><br />
							In the future, Ebony oil & Gas limited is looking to expand its horizons by exploring new business opportunities, leveraging on the collective rich and extensive experiences of our workforce and strategic partners, to gain dominance in the petroleum industry. 
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
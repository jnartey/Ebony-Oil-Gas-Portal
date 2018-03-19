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
			<?php
				$b = 1;
				foreach($banners as $banner):
					if($b == 1){
						echo '<li class="is-active orbit-slide">';
						echo $this->Html->image(DS.'files'.DS.'Banners'.DS.'banner_image'.DS.'large-'.$banner->banner_image, ["alt" => "Ebony Oil & Gas", 'class'=>'orbit-image']);
						echo '<figcaption class="orbit-caption"><div class="row">';
						echo '<h2>'.$banner->description.'</h2>';
						echo '</div></figcaption>';
						echo '</li>';
					}else{
						echo '<li class="orbit-slide">';
						echo $this->Html->image(DS.'files'.DS.'Banners'.DS.'banner_image'.DS.'large-'.$banner->banner_image, ["alt" => "Ebony Oil & Gas", 'class'=>'orbit-image']);
						echo '<figcaption class="orbit-caption"><div class="row">';
						echo '<h2>'.$banner->description.'</h2>';
						echo '</div></figcaption>';
						echo '</li>';
					}
					
					$b++;
				endforeach;
			?>
		  </ul>
		</div>
	</div>
	
	<div class="large-12 columns main-content dashboard company-profile">
		<div class="row">
			<div class="medium-3 columns">
				<div class="medium-12 columns portal-box">
					<ul class="tabs vertical" id="company-library" data-tabs>
				      <li class="tabs-title is-active"><a href="#company-profile" aria-selected="true">Company Profile</a></li>
				      <li class="tabs-title"><a href="#our-core-values">Our Core Values</a></li>
				      <!-- <li class="tabs-title"><a href="#document-library">Document Library</a></li> -->
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
				      <div class="tabs-panel is-active" id="company-profile">
						 <h3>Company Profile</h3>
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
						 <h5>Our Vision</h5>
						 <p>To be the downstream oil and gas company of choice, consistently and safely delivering, excellent energy solutions.</p>
						 <h5>Our Mission</h5>
						 <p>Building a customer -centric organisation by operating to the highest safety standards and delivering outstanding value to our shareholders</p>
				      </div>
				      <div class="tabs-panel" id="our-core-values">
						 <h3>Our Core Values</h3>
				         <h5>Customer - Focused</h5>
						 <p><em>"Our goal as a company is to have customer service that is not just the best but legendary"</em></p>
				         <h5>Ownership</h5>
						 <p><em>Ownership is given the highest priority because it allows employees to operate in a responsible manner.</em></p>
				         <h5>Teamwork</h5>
						 <p><em>"The strength of the team is each individual member. The strength of each member is the team."</em></p>
				         <h5>Safety</h5>
						 <p><em>We instil commitment and importance that each team member performs their duties safely and watches out for their co-worker</em></p>
				         <h5>Integrity</h5>
						 <p><em>Having a high level of integrity is one of the most important characteristics we possess. It is a consistency of actions, values, methods, measures, principles, expectation and outcome which govern our organisation.</em></p>
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
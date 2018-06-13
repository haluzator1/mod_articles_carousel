<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_carousel
 *
 * @copyright	Copyright © 2018 - All rights reserved.
 * @license		GNU General Public License v2.0
 * @author 		Erik Márföldi
 */
 
defined('_JEXEC') or die;
?>

<div id="news" class="carousel slide <?php echo $moduleclass_sfx; ?>" data-ride="carousel">
	<ol class="carousel-indicators">
	<?php foreach ($items as $key=>$item) : ?>
		<li data-target="#news" data-slide-to="<?= $key; ?>" class="<?= $key===0? 'active': '';?>"></li>
	<?php endforeach; ?>
	</ol>
	
	<div class="carousel-inner">
	<?php foreach ($items as $key=>$item) : ?>
		<article class="carousel-item<?= $key===0? ' active': '';?>" itemscope itemtype="https://schema.org/Article">
			<?php if($params->get('show_image') != 'off'): ?>
				<?php
				$images = json_decode($item->images);
				$image = $images->image_intro;
				$alt = $images->image_intro_alt ? $images->image_intro_alt : $item->title;
				if($params->get('show_image') == 'fulltext')
				{
					$image = $images->image_fulltext;
					$alt = $images->image_fulltext_alt ? $images->image_fulltext_alt : $item->title;
				}
				?>
				<?php if($params->get('link_image')): ?>
					<a href="<?php echo $item->link; ?>" itemprop="url" target="<?php echo $params->get('open_link', '_self'); ?>">
						<img class="d-block w-100" data-src="<?php echo $image; ?>" src="<?php echo $image; ?>" alt="<?php echo $alt; ?>">
					</a>
				<?php else: ?>
					<img class="d-block w-100" data-src="<?php echo $image; ?>" src="<?php echo $image; ?>" alt="<?php echo $alt; ?>">
				<?php endif; ?>
			<?php endif; ?>
			
			<?php if($params->get('show_title') || $params->get('show_content') != 'offc' || $params->get('show_readmore')): ?>
			<div class="carousel-caption">
				<?php if($params->get('show_date')): ?>
					<p class="<?php echo $params->get('design_date'); ?>">
					<?php
						$dateformat = 'DATE_FORMAT_LC';
						switch((int)$params->get('date_format')){
							case 0: $dateformat = 'DATE_FORMAT_LC'; break;
							case 1: $dateformat = 'DATE_FORMAT_LC1'; break;
							case 2: $dateformat = 'DATE_FORMAT_LC2'; break;
							case 3: $dateformat = 'DATE_FORMAT_LC3'; break;
							case 4: $dateformat = 'DATE_FORMAT_LC4'; break;
							case 5: $dateformat = 'DATE_FORMAT_LC5'; break;
							case 6: $dateformat = $params->get('date_custom_format'); break;
							default: $dateformat = 'DATE_FORMAT_LC';
						}
						echo JHtml::_('date', $item->publish_up, JText::_($dateformat));
					?>
					</p>
				<?php endif; ?>
				
				<?php if($params->get('show_category')): ?>
					<small class="<?php echo $params->get('design_category'); ?>">
						<?php echo $item->category_title; ?>
					</small>
				<?php endif; ?>
			
				<?php if($params->get('show_title')): ?>
					<h5 itemprop="name">
						<?php if($params->get('link_title')): ?>
							<a href="<?php echo $item->link; ?>" itemprop="url" target="<?php echo $params->get('open_link', '_self'); ?>">
						<?php endif; ?>
						<?php echo $item->title; ?>
						<?php if($params->get('link_title')): ?>
							</a>
						<?php endif; ?>
					</h5>
				<?php endif; ?>
			
				<?php if($params->get('show_content') != 'offc'): ?>
					<?php
					if($params->get('show_content') == 'partc'):
						$cleanText = filter_var($item->introtext, FILTER_SANITIZE_STRING);
						$introCleanText = strip_tags($cleanText);
						if (strlen($introCleanText) > $params->get('tam_content', 200))
						{
							$introtext = substr($introCleanText,0,strrpos(substr($introCleanText,0,$params->get('tam_content', 200))," ")).'...';
						}
						else
						{
							$introtext = $introCleanText;
						}
						echo '<p>'.$introtext.'</p>';
					else:
						echo $item->introtext;
					endif;
					?>
				<?php endif; ?>
				
				<?php if($params->get('show_readmore')): ?>
				<p class="text-right">
					<a href="<?php echo $item->link; ?>" class="btn btn-primary" target="<?php echo $params->get('open_link', '_self'); ?>"><?php echo $params->get('readmore_text') ? $params->get('readmore_text') : JText::_('MOD_ARTICLES_CAROUSEL_FIELD_READMORE_TEXT'); ?></a>
				</p>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</article>
	<?php endforeach; ?>
	</div>
	<a class="carousel-control-prev" href="#news" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Předchozí</span>
	</a>
	<a class="carousel-control-next" href="#news" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Další</span>
	</a>
</div>
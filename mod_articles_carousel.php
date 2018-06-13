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

JLoader::register('modarticlescarouselHelper', __DIR__ . '/helper.php');

$items = modarticlescarouselHelper::getItems($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');
$layout = $params->get('layout', 'default');

require JModuleHelper::getLayoutPath('mod_articles_carousel', $layout);
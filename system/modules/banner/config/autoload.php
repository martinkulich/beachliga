<?php

ClassLoader::addClasses(array
    (
// Modules
	'Contao\ModuleBanner'      => 'system/modules/banner/ModuleBanner.php',
    'Contao\ModuleBannerReferrer'      => 'system/modules/banner/ModuleBannerReferrer.php',
    'Contao\ModuleBannerVersion'      => 'system/modules/banner/ModuleBannerVersion.php',

    ));
/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_banner_list_right_column'      => 'system/modules/banner/templates',
    'mod_banner_list_left_column'      => 'system/modules/banner/templates',


));

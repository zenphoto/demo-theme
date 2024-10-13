<?php
/**
 * Theme page for pages of the Zenpage CMS plugin
 */
if (!defined('WEBPATH'))
	die();
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="<?php echo LOCAL_CHARSET; ?>">
			<?php zp_apply_filter('theme_head'); ?>
			<?php printHeadTitle(); ?>
			<link rel="stylesheet" href="<?php echo $_zp_themeroot; ?>/style.css" type="text/css" />
	<?php if (class_exists('RSS')) printRSSHeaderLink('Pages', '', 'Zenpage news', ''); ?>
		</head>
		<body>
			<?php zp_apply_filter('theme_body_open'); ?>
			<?php printHomeLink('', ' | '); ?><a href="<?php echo html_encode(getGalleryIndexURL()); ?>" title="<?php echo ('Gallery Index'); ?>"><?php echo getGalleryTitle(); ?></a> | <?php printZenpageItemsBreadcrumb(' » ', ''); ?>
			<?php
			if (getOption('Allow_search')) {
				printSearchForm('', 'search', '', gettext('Search gallery'));
			}
			printPageTitle();
			printPageContent();
			printTags('links', gettext('<strong>Tags:</strong>') . ' ', 'taglist', ', ');
			printRSSLink('Gallery', '', 'RSS', ' | ');
			printRSSLink('News', '', '', gettext('News'), '');
			//comment form plugin support
			if (function_exists('printCommentForm')) {
				printCommentForm();
			}
			zp_apply_filter('theme_body_close');
			?>
		</body>
	</html>
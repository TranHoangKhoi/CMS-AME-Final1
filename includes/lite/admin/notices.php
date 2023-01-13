<?php
/**
 * Lite-specific admin notices.
 */

add_action('admin_init', 'wpcode_maybe_add_library_connect_notice');
add_action('wpcode_admin_page', 'wpcode_maybe_add_lite_top_bar_notice', 4);


/**
 * Show a prompt to connect to the WPCode Library to get access to more snippets.
 *
 * @return void
 */
function wpcode_maybe_add_library_connect_notice()
{
	if (wpcode()->library_auth->has_auth() || !isset($_GET['page']) || 0 !== strpos($_GET['page'], 'wpcode')) {
		return;
	}
	// Don't show if in headers & footers mode only.
	if (wpcode()->settings->get_option('headers_footers_mode')) {
		return;
	}

	$settings_url = add_query_arg(
		array(
			'page' => 'wpcode-settings',
		),
		admin_url('admin.php')
	);

	$snippets_count = wpcode()->library->get_snippets_count();
	// Translators: more here is used in the sense of "get access to more snippets" and gets replaced with the number of snippets if the library items are loaded correctly.
	$more = $snippets_count > 0 ? $snippets_count : __('more', 'insert-headers-and-footers');

	WPCode_Notice::info(
		sprintf(
			// Translators: %1$s and %2$s add a link to the settings page. %3$s and %4$s make the text bold. %6$s is replaced with the number of snippets and %5$s adds a "new" icon.
			__('%5$s%1$sConnect to the WPCode Library%2$s to get access to %3$s%6$s FREE snippets%4$s!', 'insert-headers-and-footers'),
			'<a href="' . $settings_url . '" class="wpcode-start-auth">',
			'</a>',
			'<strong>',
			'</strong>',
			'<span class="wpcode-icon-new">&nbsp;NEW!</span>',
			$more
		),
		array(
			'dismiss' => WPCode_Notice::DISMISS_GLOBAL,
			'slug' => 'wpcode-library-connect-lite',
		)
	);
}

/**
 * Add a notice to consider more features with offer.
 *
 * @return void
 */
function wpcode_maybe_add_lite_top_bar_notice()
{
	// Only add this to the WPCode pages.
	if (!isset($_GET['page']) || 0 !== strpos($_GET['page'], 'wpcode')) {
		return;
	}
	// Don't show in H&F mode.
	if (wpcode()->settings->get_option('headers_footers_mode')) {
		return;
	}

	$screen = get_current_screen();
	if (isset($screen->id) && false !== strpos($screen->id, 'code-snippets_page_wpcode-')) {
		$screen = str_replace('code-snippets_page_wpcode-', '', $screen->id);
	} else {
		$screen = 'snippets-list';
	}

	$upgrade_url = wpcode_utm_url(
		'https://wpcode.com/lite',
		$screen,
		'top-notice'
	);

	WPCode_Notice::top(
		sprintf(
			// Translators: %1$s and %2$s add a link to the upgrade page. %3$s and %4$s make the text bold.
			__('%3$sYou\'re using WPCode Lite%4$s. To unlock more features consider %1$supgrading to Pro%2$s.', 'insert-headers-and-footers'),
			'<a href="' . $upgrade_url . '" target="_blank" rel="noopener noreferrer">',
			'</a>',
			'<strong>',
			'</strong>'
		),
		array(
			'dismiss' => WPCode_Notice::DISMISS_USER,
			'slug' => 'consider-upgrading',
		)
	);
}

/**
 * Show a notice with more features at the bottom of the Headers & Footers page.
 *
 * @return void
 */
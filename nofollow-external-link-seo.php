<?php
/*
Plugin Name: Nofollow External Links (SEO)
Plugin URI: https://viitorcloud.com/blog/
Description: It automatically set all external links to "nofollow" in website content.
Version: 1.0.0
Author: Mitali, Viitorcloud
Author URI:https://viitorcloud.com/
*/    

add_filter('the_content', 'vc_nofollow');
add_filter('the_excerpt', 'vc_nofollow');

function vc_nofollow($content) {
return preg_replace_callback('/<a[^>]+/', 'vc_nofollow_callback', $content);
}
function vc_nofollow_callback($matches) {
$link = $matches[0];
$site_link = get_bloginfo('url');

if (strpos($link, 'rel') === false) {
    $link = preg_replace("%(href=\S(?!$site_link))%i", 'rel="nofollow" $1', $link);
} elseif (preg_match("%href=\S(?!$site_link)%i", $link)) {
    $link = preg_replace('/rel=\S(?!nofollow)\S*/i', 'rel="nofollow"', $link);
}
return $link;
} 
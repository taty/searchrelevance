<?php
/*
Plugin Name: SearchRelevance
Plugin URI: http://www.sabletopia.co.uk/SearchRelevance/
Description: Adjust WordPress search results to order by relevance, not by date.
Version: 1.0.0
Author: Darren Douglas - darren.douglas@gmail.com
Author URI: http://www.sabletopia.co.uk/
License: GPL3
*/

/*
 * SearchRelevance
 * Copyright (C) 2013 Sable Designs - darren.douglas@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

defined('ABSPATH') or die("Cannot access pages directly.");


add_filter('posts_orderby', 'ssrch_posts_orderby');
add_filter('posts_fields', 'ssrch_posts_fields');
add_filter('the_title', 'ssrch_filter_the_title');


function ssrch_filter_the_title( $title ) {
	global $post;
    if (is_search() && in_the_loop()) {
		if (isset($post->ssrch_relevance_percent)){
			return $title . " <span class='ssrch_relevance'>(" . number_format(($post->ssrch_relevance_percent*100),0) ."% relevance)</span>";
		}
	}
	return $title;
}

function ssrch_posts_orderby($orderby) {
	if(is_search()) {
        $orderby = " ssrch_relevance DESC";
    }
    return $orderby;
}

function ssrch_posts_fields($fields){
	if(is_search()) {
        $srch = get_search_query(false);
        $srch_array = ssrch_splitSearch($srch);
		$size = count($srch_array);
		$maxscore = ($size * 100) + ($size * 10) + ($size * 1);
		$sql = ssrch_makerelevanceSql($srch_array);
		$fields .= ", (  " . $sql . "  ) as ssrch_relevance, (" . $sql . "/".$maxscore.") as ssrch_relevance_percent";
	}
	return ($fields);
}

function ssrch_makerelevanceSql($lookfor) {
global $wpdb;
	$tmpsql="(";
	$tmpsql2="(";
	$tmpsql3="(";
    for($i = 0, $size = count($lookfor); $i < $size; ++$i) {
        $tmpsql.="(if(locate('".$lookfor[$i]."',".$wpdb->posts.".post_title),1,0))";
		$tmpsql2.="(if(locate('".$lookfor[$i]."',".$wpdb->posts.".post_excerpt),1,0))";
		$tmpsql3.="(if(locate('".$lookfor[$i]."',".$wpdb->posts.".post_content),1,0))";
		if ($i+1<$size) {
			$tmpsql.="+";
			$tmpsql2.="+";
			$tmpsql3.="+";
		}
	}
	$tmpsql.=")";
	$tmpsql2.=")";
	$tmpsql3.=")";
	$result = "((".$tmpsql."*100)+(".$tmpsql2."*10)+(".$tmpsql3."*1))";
    return $result;
}
 
 function ssrch_splitSearch($srch) {
    $ary = array();
    if (empty($srch)) { return $ary; } 
    $needles = array(",", "+", ".", "-", "_", "/", "\\", '"', "'", "<",">",";","  ");
    $srchcleaned = esc_sql(str_replace($needles, " ", $srch));
    return explode(" ",$srchcleaned);
}




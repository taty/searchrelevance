=== Search Relevance ===
Contributors: SableDnah
Donate link: https://www.paypal.com/cgi-bin/webscr?business=darrendouglas%40gmail.com&bn=PP-DonationsBF%3Abtn_donateCC_LG.gif%3ANonHosted&lc=US&item_name=SearchRelevance%29&cmd=_donations&rm=1&no_shipping=1&currency_code=GBP
Tags: search, relevance, relavence, relevant, relavent, relevanssi, wp-search
Requires at least: 3.6.0
Tested up to: 3.6.1
Stable tag: 2.0.0

Adjust WordPress search results to order by relevance, not by date.


== Description ==

Adjust WordPress search results to order by relevance, not by date.

Just install in the typical WordPress plugin way and it will adjust searches automatically, no settings needed.

Also adds a relevance score to the title of search results, which you can style via CSS (see FAQ).

Version 2.0 gives you more control, including:

* Hide relevance scores in results titles and/or admin
* Auto style relavence scores. So you don't have to add float:right to your CSS!
* Highlight search terms 
* Custom excerpt centered on the search terms found


== Installation ==

1. Upload the SearchRelevance folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Adjust CSS for span.ssrch_relevance and b.ssrch_highlight if required.


== Frequently Asked Questions ==

Q: How do I style the relevance and results.

A: You can style the results with your own css.

Try  
`span.ssrch_relevance { float:right; }`  
or  
`span.ssrch_relevance { display: none; }`  
to hide it.

The "Style relevance" option in settings will add `float:right;` direct to the relavence - useful if you can`t get into edit your themes css.

The highlights are styles via `b.ssrch_highlight`.


== Screenshots ==

1. Settings Page.

== Changelog ==

= 2.0 =
Fixes html in admin media search results.   

Adds new options to contol search display including:

1. Hidie relevance info in result titles
2. Hide relevance info in admin
3. Attempt to auto style relavence in results
4. Highlight search terms in results.  
5. Optional custom excerpt centeres on search terms (configurable length)

= 1.0 =
* Initial Release.

== Upgrade Notice ==

= 2.0 =
Fixes html in admin media search results.   
Adds new options to contol search display.

= 1.0 =
* Initial Release.


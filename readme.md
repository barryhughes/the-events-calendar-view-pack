## View Pack for The Events Calendar

> Experimental [WordPress plugin](https://wordpress.org) that aims to explore the provision of additional, lightweight 
views for [The Events Calendar](wordpress.org/plugins/the-events-calendar/). 

In this context, lightweight means the implementation is as lean as possible and reuses as much existing view and 
template code as it can. It _doesn't_ mean that less CSS or JS assets are sent to the browser (in fact, the opposite 
is true as views added by this plugin will build on existing assets by adding more of its own), that's simply not the
objective here.   

* It's experimental, unsupported and not recommended for production use
* It requires a modern/supported version of PHP, otherwise it may die ungracefully (under a PHP 5.2 runtime for example) 
* It was lasted tested with WordPress 4.9.1, The Events Calendar 4.6.1 and a default theme ... your mileage may vary 
if you use different versions and other plugins or themes are active

#### What views does it add?

Only one additional view ("grid") is currently added by this plugin. 

Grid view is a very basic reimagining of list view and does little more than use some CSS flexibile box layout code to 
turn list view into a "rigid" grid - rigid in the sense of maintaining clear rows, as opposed to a loser "poster view" 
sort of grid such as might be generated with the help of a library like [Masonry](https://masonry.desandro.com) or that 
The Event Calendar's big brother [Events Calendar PRO](https://theeventscalendar.com/product/wordpress-events-calendar-pro/) 
provides.

#### Todo items, known shortcomings and other notes

* *Known issue* &mdash; when paging forward/backward URLs follow the format used for traditional list view and so aren't 
fully reusable
* *Known issue* &mdash; activating and deactivating combinations of this plugin and The Events Calendar and/or Events
Calendar PRO (which also registers additional views) can result in weird effects such as view settings being rendered
useless which in turn can stop various views from working: strategm to fix this if it happens is a) visit the _Events
&rarr; Settings &rarr; Display_ screen, confirm the enabled view settings and (re-save) then b) visit _Settings &rarr;
Permalinks_ to flush the rewrite rules
* *Todo* &mdash; add an icon for grid view in the list view selector  
* *Todo* &mdash; add a date-range based view, such as a "next 4 weeks" view that goes a little further than offering a
restyled list view



 


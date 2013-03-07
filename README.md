# PICTURE PERFECT

Genesis child theme by Agent Evolution


## NOTES

Decide on method for loading background image...
Probably use jQuery and load a background-image with a smaller size
on smaller screen sizes. This method will avoid loading giant images
on smart phones.

Make sure that background is fixed on smart phones as the layout will be
extremely verticle causing a terrible stretch of the background image.


## TODO
* listing-search page - list of recommended IDX providers
* Some kind of "Setup Theme" function
* Add gravity forms form to contact page


## Genesis-child TODO

* Remove .related-posts css
* Go through all CSS and rip out AE Client site specific stuff
* home.php


## A note on coding style
As far as coding style goes, genesis-child leans more toward [FIG Standards](http://www.php-fig.org/) (with some exceptions) over WordPress coding standards. This is because the majority of popular PHP frameworks and CMS's compyl entirely or more closely to FIG standards. WordPress coding standards seem a little outdated and the spacing between every function call is annoying. It makes more sense to adhere to the PHP community at large. That way you don't have to change the way you code on a per project basis.
# Landing Categories

This module adds the ability to have a different page layout for landing categories.

It also adds the ability to add widgets to specific landing category pages.


## How to use

### Set a category as landing

In the admin panel, on the category create/edit page, under display settings, set the Display Mode to "Landing Category"

A custom handle `jh_category_landing` will be loaded on that category page. Add your customizations to category landing page in that layout handle.

### Add Widgets to a specific category page or to all of them

In the admin panel, on the add/edit a widget page, under Layout Updates, set Display on as "Landing Categories", then choose a specific category or check the "all" radio button.

### Installation

Add the following to your `repositories` key in your `composer.json` file:

```
{
	"type": "vcs",
	"url": "git@github.com:WeareJH/m2-module-landing-categories.git"
}        
```

Run `composer require wearejh/m2-module-landing-categories`


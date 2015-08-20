# _bar
* Contributors:      Caspar Hübinger
* Tags:              admin, adminbar, adminmenu, developer, toolbar
* Requires at least: 4.0
* Tested up to:      4.3
* Stable tag:        0.4
* License:           GNU General Public License v3
* License URI:       http://www.gnu.org/licenses/gpl-3.0.html


Handy toolbar menus for the lazy WordPress developer.


## Description
Yet another admin bar menu plugin. This one has modules.


### Modules
* [Site Language](#user-content-site-language)
* [Plugins](#user-content-plugins)
* [Icons](#user-content-icons)


#### Site Language
Update your site’s core language setting in WordPress via toolbar (aka admin bar).

> **This is not a plugin for multilingual WordPress, translating content and the like!**
> If you’re interested in running a WordPress site in multiple languages, check out [MultilingualPress](https://wordpress.org/plugins/multilingual-press/).

![Update Site Language Option via toolbar](https://github.com/glueckpress/_bar/raw/master/modules/site-language/screenshot.gif)

In order to switch your site’s language, you would usually need to navigate to _Settings → General_ and pick one of your previously installed translations (or a new one even) from the dropdown menu _Site Language_. After saving your selection, the page would reload and you would see your WordPress back-end UI (and front-end if translations available for your active theme) in said language.

Particularly when working on a translated plugin or theme UI copy navigating to the _General Settings_ page and switch the site language all the time in order to check whether translated strings are correct can become pretty annoying.

This module simply provides a shortcut for all of the above.

After having activated the plugin, you’ll see a new menu item _Site Language_ in your admin bar. Its submenu will list all core translations you have previously installed. (It will not offer you the option to install a new one.)

**Clicking on a language link will update the site language option and reload the current page. Voilá, site language updated!** :boom:


#### Plugins
The Plugins Menu provides simple shortcuts to the plugins page in the back-end, filtered by plugin status. Links open in a new tab/window. Link URLs in the menu read from top to bottom:

* __Plugins__: `[admin_url]/plugins.php`
* __All__: `[admin_url]/plugins.php?plugin_status=all`
* __Inactive__: `[admin_url]/plugins.php?plugin_status=inactive`
* __Recently Active__: `[admin_url]/plugins.php?plugin_status=recently_activated`
* __Update Available__: `[admin_url]/plugins.php?plugin_status=upgrade`

![Go to plugins page (filtered by status) via toolbar](https://github.com/glueckpress/_bar/raw/master/modules/plugins/screenshot.png)


### Icons
Trim top-level menu items in the toolbar to just display a dashicon. Save some space for more modules!

![Trim top-level menu items in the toolbar to display only icons](https://github.com/glueckpress/_bar/raw/master/modules/icons/screenshot.png)


### Languages
* English (en_US) _(default)_
* German (de_DE)
* German formal (de_DE_formal)


## Installation
### Upload
1. Download the latest [tagged archive](https://github.com/glueckpress/_bar/releases) (choose the “zip” option).
2. Go to the __Plugins → Add New__ screen and click the __Upload__ tab.
3. Upload the zipped archive directly.
4. Go to the Plugins screen and click __Activate__.

### Manual
1. Download the latest [tagged archive](https://github.com/glueckpress/_bar/releases) (choose the “zip” option).
2. Unzip the archive.
3. Copy the folder to your `/wp-content/plugins/` directory.
4. Go to the Plugins screen and click __Activate__.

Check out the Codex for more information about [installing plugins manually](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

### GitHub Updater Plugin
Install the [GitHub Updater Plugin](https://github.com/afragen/github-updater) by [Andy Fragen](https://github.com/afragen) in order to be able to update this plugin from your WordPress back-end.


## Changelog
### 0.4
* added valid README header
* module|plugins: fixed broken i18n + l10n
* module|icons: minor css fix

### 0.3
* simplified module names and css classes.
* added trim-to-icon support for existing modules.
* new module: trim parent menu items to display only a dashicon.
* added support for [GitHub updater plugin](https://github.com/afragen/github-updater) by @afragen.

### 0.2
* new module: plugins menu.
* minor enhancements: added settings page url to parent item. mo’ better code styling.

### 0.1
* Hello world! My pleasure. :bouquet:

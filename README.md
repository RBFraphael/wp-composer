# Wordpress Boilerplate with Composer

![Composer and Wordpress](https://i.imgur.com/xpgqGlX.png)

Git-ready version of Composer-based Wordpress. Very useful for development, easy deployment and CI/CD configurations. With a compact, easy-to-understand and easy-to-maintain file structure.

## 0. Requirements

- PHP 7.2+ installed on your machine
- ```php``` command enabled on terminal/cmd (PHP's path added to your PATH env. var)

## 1. Installing

### If you have Composer 1.x installed

Just clone this repository and run ```php composer install``` inside this folder. After that, jump to next step.

## 2. Configure

The configuration process is simple. You only need to duplicate and rename ```local-config.example.php``` to ```local-config.php```, then edit that file, inserting your site's database configuration, URL and salt keys (that you can generate at [WordPress.org secret-key service](https://api.wordpress.org/secret-key/1.1/salt/)). After that, all configuration can be done from your web browser, accessing your site's URL and following normal Wordpress installation process.

**Note:** To access Wordpress admin panel, you need to access your site's URL followed by ```/cms/wp-admin``` or ```/cms/wp-login.php``` (for example, http://mywebsite.com/cms/wp-admin or http://mywebsite.com/cms/wp-login.php).

## 3. Adding plugins

To add plugins, you need to edit the ```composer.json``` file, adding your required plugins into the "require" section. This boilerplate comes with [WP Optimize](https://wordpress.org/plugins/wp-optimize/), [All In One WP Security & Firewall](https://wordpress.org/plugins/all-in-one-wp-security-and-firewall/), [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) and [Contact Form 7 Database Addon](https://wordpress.org/plugins/contact-form-cfdb7/) plugins, so you can follow these examples to add all plugins you'll need. Also, you can install plugins in normal way, by adding them to ```/content/plugins``` or via Wordpress panel, **but be advised** that plugins added this way will be ignored by Composer and by Git (since you don't add them into ```.gitignore```) and you'll not be able to update them with Composer. So, be careful.

**Note:** Custom plugins (plugins that aren't on Wordpress/WPackagist repository) can't be added to ```composer.json``` file, or it will cause errors while running Composer. To add custom plugins (or your own developed plugins), follow instructions on step 5.

## 4. Adding themes

Adding themes is done the same way you add plugins. Just edit ```composer.json``` file and add your themes into the "require" section. Also, this boilerplate comes with [Twenty Twenty-One](https://wordpress.org/themes/twentytwentyone/) theme, so you can follow this example to add your themes. As plugins, you can add new themes in normal way, extracting them to ```/content/themes``` or installing via Wordpress panel. Themes added in normal way will not be updated or installed with Composer, but, unlike plugins, they will not be removed from your Git repository and will not cause problems when running Composer, because they aren't ignored in ```.gitignore``` file (only the "Twenty something" themes are ignored).

**Note:** Custom themes (themes that aren't on Wordpress/WPackagist repository) can't be added to ```composer.json``` file, or it will cause errors while running Composer.

## 5. Adding or developing custom plugins

At some moment, you will need to add or create custom plugins. Since this boilerplate uses Composer to manage plugins that resides on Wordpress' repository, custom plugins will not work properly while using Composer. To add custom plugins, you'll need to add them to your ```.gitignore``` file, and be sure the custom plugins aren't on your ```composer.json``` file.
# Wordpress Boilerplate with Composer

![Composer and Wordpress](https://i.imgur.com/xpgqGlX.png)

Git-ready version of Composer-based Wordpress. Very useful for development, easy deployment and CI/CD configurations. With a compact, easy-to-understand and easy-to-maintain file structure.

## 0. Requirements

- PHP 7.2+ installed on your machine
- ```php``` command enabled on terminal/cmd (PHP's path added to your PATH env. var)

## 1. Installing

Just clone this repository and run ```php composer install``` inside this folder. After that, jump to next step.

## 2. Configure

The configuration process is simple. You only need to duplicate and rename ```.env.example``` to ```.env```, then edit that file, inserting your site's database configuration, URL and salt keys (that you can generate at [WordPress.org secret-key service](https://api.wordpress.org/secret-key/1.1/salt/) or at [my own Salt generator](https://rbfraphael.github.io/wordpress/salt_generator.html) which outputs in .env format). After that, all configuration can be done from your web browser, accessing your site's URL and following normal Wordpress installation process.

**Note:** To access Wordpress admin panel, you need to access your site's URL followed by ```/cms/wp-admin``` or ```/cms/wp-login.php``` (for example, http://mywebsite.com/cms/wp-admin or http://mywebsite.com/cms/wp-login.php).

## 3. Adding plugins

To add plugins, you need to edit the ```composer.json``` file, adding your required plugins into the "require" section, or run ```composer require wpackagist-plugin/<plugin-slug>``` to require plugins through Composer. Also, you can install plugins in normal way, by adding them to ```/app/plugins``` or via Wordpress panel, **but be advised** that plugins added this way will be ignored by Composer and by Git (since you don't add them into ```.gitignore```) and you'll not be able to update them with Composer. So, be careful.

**Note:** Custom plugins (plugins that aren't on Wordpress/WPackagist repository) can't be added to ```composer.json``` file or required by Composer, or it will cause errors while running Composer. To add custom plugins (or your own developed plugins), follow instructions on step 5.

## 4. Adding themes

Adding themes is done the same way you add plugins. Just edit ```composer.json``` file and add your themes into the "require" section, or run ```composer require wpackagist-theme/<theme-slug>``` to require them with Composer. Also, this boilerplate comes with [Twenty Twenty-Two](https://wordpress.org/themes/twentytwentytwo/) theme, so you can follow this example to add your themes. As plugins, you can add new themes in normal way, extracting them to ```/app/themes``` or installing via Wordpress panel. Themes added in normal way will not be updated or installed with Composer, but, unlike plugins, they will not be removed from your Git repository and will not cause problems when running Composer, because they aren't ignored in ```.gitignore``` file (only the "Twenty something" themes are ignored).

**Note:** Custom themes (themes that aren't on Wordpress/WPackagist repository) can't be added to ```composer.json``` file, or it will cause errors while running Composer.

## 5. Adding or developing custom plugins

At some moment, you will need to add or create custom plugins. Since this boilerplate uses Composer to manage plugins that resides on Wordpress' repository, custom plugins will not work properly while using Composer. To add custom plugins, you'll need to add them to your ```.gitignore``` file, and be sure the custom plugins aren't on your ```composer.json``` file.

## 6. Versioning environments

Although not recommended, you can version development, testing and production environments. To do this, you just need to edit the corresponding file at ```/config/environments/<environment>.php```, and all settings set on ```.env``` file will be overridden by settings on respective environment script.

## 7. Languages

To add a language to your Wordpress, you need to require the desired language from [wp-languages.github.io](https://wp-languages.github.io) repository. For example, to install Brazillian portuguese (codenamed "pt_br"), run ```composer require koodimonni-language/pt_br``` in your project's root, or add ```koodimonni-language/pt_br: "*"``` to **require** section of your ```composer.json``` file.
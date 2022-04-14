# XAMPP WordPress Installer

Install WP in XAMPP with a few clicks

### Usage:

1. Copy / Symlink app folder to XAMPP's htdocs folder.
2. Duplicate _config-sample.php_, rename it to _config.php_ and add your database user credentials to it.
3. Load installer by visiting the root folder of the app (ie. _localhost/xampp-wp-installer_).
4. Fill in the name of the new installation.
5. WordPress will be installed in a folder with the given name. A databse will be created with the same name for the WP instance.
6. Enjoy!

### Status:

The app creates a database in the MySQL server that's shipped with XAMPP. A new folder in XAMPP's htdocs directory will be created with the given name (same for the database and the new folder). WP-CLI downloads the installer of the latest WordPress version into this new folder.

### Next:

Creating a new wp-config.php with WP-CLI then installing a new WordPres instance with the settings.

### Prerequisites and Known Issues:

1. You need an installed XAMPP for this to Work. Obviously.
2. You need to have your PHP's path in the Environment Variables PATH settings.
3. Some WP-CLI commands are not working with PHP 8.x, so you need to use 7.x.

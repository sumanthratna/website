# @sumanthratna's Website

## Setting up the files

    .
    ├── private
    │   ├── keys.ini
    │   ├── php.error.log
    │   └── smarty
    │       ├── cache
    │       │   └── ...
    │       ├── configs
    │       │   └── <EMPTY>
    │       └── templates_c
    │           └── ...
    └── public
        ├── admin.php
        ├── assets
        │   └── ...
        ├── auth.php
        ├── clear
        ├── compile
        ├── composer.json
        ├── composer.lock
        ├── contact.php
        ├── css
        │   ├── animate.css
        │   ├── bootstrap
        │   │   ├── ...
        │   │   ├── mixins
        │   │   │   └── ...
        │   │   ├── utilities
        │   │   │   └── ...
        │   │   └── vendor
        │   │       └── ...
        │   ├── bootstrap.css
        │   ├── bootstrap.css.map
        │   ├── icomoon.css
        │   ├── icomoon.eot
        │   ├── icomoon.svg
        │   ├── icomoon.ttf
        │   ├── icomoon.woff
        │   ├── magnific-popup.min.css
        │   ├── normalize.min.css
        │   ├── owl.carousel.min.css
        │   ├── owl.theme.default.min.css
        │   └── style.scss
        ├── custom_smarty.php
        ├── favicon.ico
        ├── images
        │   ├── ...
        │   ├── blog
        │   │   └── ...
        │   ├── favicon.studio
        │   ├── gh-social-preview.png
        │   ├── gh-social-preview.studio
        │   ├── ogp.png
        │   └── ogp.studio
        ├── index.json
        ├── index.php
        ├── js
        │   ├── bootstrap.min.js
        │   ├── jquery.easing.1.3.js
        │   ├── jquery.magnific-popup.min.js
        │   ├── jquery.min.js
        │   ├── jquery.waypoints.min.js
        │   ├── main.js
        │   ├── modernizr-2.6.2.min.js
        │   ├── owl.carousel.min.js
        │   ├── phone.js
        │   └── respond.min.js
        ├── keybase.txt
        ├── README.md
        ├── robots.txt
        ├── style.css
        ├── style.css.map
        ├── templates
        │   ├── footer.tpl
        │   ├── header.tpl
        │   ├── pages
        │   │   ├── 404.tpl
        │   │   ├── about.tpl
        │   │   ├── admin
        │   │   │   ├── login.tpl
        │   │   │   └── manage.tpl
        │   │   ├── blog
        │   │   │   ├── index.tpl
        │   │   │   ├── playground.tpl
        │   │   │   └── post.tpl
        │   │   ├── contact.tpl
        │   │   ├── home.tpl
        │   │   └── search.tpl
        │   └── socials.tpl
        └── vendor
            └── ...

Note: the `public` directory contains the contents of this repo. Here's a script to set everything up (run this in an empty folder):

```sh
mkdir private
touch keys.ini
git clone git@github.com:sumanthratna/website.git public
cd public
composer install
```

## Preparing the MySQL Database

Note: there must be at least one user with the username `"admin"` in order for the admin panel to work.

```sql
-- Create the table:
CREATE TABLE users(id INT NOT NULL AUTO_INCREMENT, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))

-- Create a login account:
INSERT INTO users(username, password) VALUES("admin", SHA2("MySecurePassword!", 512))

-- Show login info (username and SHA-512 of password) of a certain user:
SELECT username,password FROM users WHERE username="admin"

-- Show login info (username and SHA-512 of password) of all login accounts:
SELECT * FROM users

-- Remove a certain user's login account:
DELETE FROM users WHERE username="admin"

-- Remove the table:
DROP TABLE users
```

## Configuring Nginx

On Director, this should be the only change made:

```nginx
server {
    ...
    location / {
        ...
        try_files $uri $uri/ /index.php?$args;
    }
    ...
}
```

This allows routing from [`index.php`](./index.php).

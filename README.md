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
        └── <THIS REPOSITORY>

Note: the `public` is this repository itself—it doesn't exactly contain this repository. Here's a script to set everything up (run this in an empty folder):

```sh
mkdir private
touch keys.ini
git clone git@github.com:sumanthratna/website.git public
cd public
composer install
```

## Creating `keys.ini`
Here's what `keys.ini` should look like:
```ini
neverbounce_key=<NEVERBOUNCE API KEY>***REMOVED***
sendgrid_key=<SENDGRID API KEY>***REMOVED***
secret=<SITE SECRET>

[recaptcha]
secret=<RECAPTCHA SECRET>
site_key=<RECAPTCHA SITE KEY>

[database]
name='site_2022sratna'
host='mysql1.csl.tjhsst.edu'
port='3306'
username=<DATABASE USERNAME>
password=<DATABASE PASSWORD>
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

# @sumanthratna's Website

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

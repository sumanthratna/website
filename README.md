# @sumanthratna's Website

## Preparing the MySQL Database

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

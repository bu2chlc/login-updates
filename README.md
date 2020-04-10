# login-updates
This code base has TONS of bugs, it was pushed only to show how to update "last login time" in a MYSQL database.
This was created for XAMPP and all dev was done on LOCALHOST.

To use this code create a MYSQL db called "testdb" (or configure your own db name in the config.php).
Navigate to http://localhost/loginupdates/install.php and it will create all the tables (3 so far) with the proper structure.

Navigate to http://localhost/loginupdates and create a new user. You need to provide an "auth password" in order to sign up. 
I chose "tortoise" as a play on the youtube video "I like turtles".
The goal will be TWO passwords, one known by users to create a USER level login and an ADMIN auth password that signs you up
as an ADMIN level user.
That will be set up soon, maybe the next push.

The code that updates the "last_login" field is in "class_login.php" around lines 50-55.
ENJOY!
(and enjoy all the bugs, this is version 0.000001)

# login-updates
This was created for XAMPP and all dev was done on LOCALHOST.

To use this code create a MYSQL db called "testdb" (or configure your own db name in the config.php).
Navigate to http://localhost/loginupdates/install.php and it will create all the tables (3 so far) with the proper structure.

Navigate to http://localhost/loginupdates and create a new user. You need to provide an "auth password" in order to sign up. 
You have a choice of TWO passwords, one known by users to create a USER level login and an ADMIN auth password that signs you up as an ADMIN level user.
Those two passwords are configured in the config.php as $user_auth and $admin_auth variables.

The code that updates the "last_login" field is in "class_login.php" around lines 50-55.
ENJOY!
(and enjoy all the bugs, this is version 0.000001)

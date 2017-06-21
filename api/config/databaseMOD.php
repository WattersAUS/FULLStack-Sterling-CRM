<?php


/**
*
* Modern method of connecting to a MySQL database and keeping it simple.
*
* If you would like to learn more about PDO,
* please visit http://php.net/manual/en/book.pdo.php
* 
*/

//Set up database connection constants, so they cannot be changed.
define('DBHOST','localhost'); //Change this to the ip address of your database
define('DBNAME','c2SS_Data'); // Change this to the database name you are trying to connect to.
define('DBUSER','c2ssdbuser'); // Insure this user is not the root user!!!!
define('DBPASS','IgG2q3RQYa'); // Insure this is not the root password!!!!

//Let's try to connect to the database first.
try {
//Initiate a new PDO object called $MYDB and pass it the proper information to make
//the connection
$MYDB = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);

//If we are successful show it :D for the test page, if this is for production you should not show this.
echo "Database connection was successful.";

//If this does not worth catch the exception thrown by PDO so we can use it.
} catch(PDOException $e) {
//Show that there was an issue connecting to the database.  Do not be specific because,
//user's do not need to know the specific error that is causing a problem for security
//reasons.
echo "Oh, sorry there was an issue with your request please try again.";

//Since we had an issue connecting to the database we should log it, so we can review it.
error_log("Database Error" . $e->getMessage());
}

//Since this is 100% php code we do not need to add a closing php tag
//Visit http://php.net/manual/en/language.basic-syntax.phptags.php for more information.
?>

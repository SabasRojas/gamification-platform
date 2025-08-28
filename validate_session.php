<!--
/**
 * CS 4342 Database Management
 * @author Sabas Rojas and Erik LaNeave
 * @version 2.0
 * Description: The purpose of these file is to provide access to either a user or an admin to the system and database.
 *
 */
-->

<?php

if (!isset($_SESSION['logged_in']) || empty($_SESSION['logged_in'])) { 
     //header('Location: ../index.php'); 
	 die("::Access restricted to users logged in::");
} 

?>
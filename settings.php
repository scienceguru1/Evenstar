<?php
if (realpath($_SERVER['SCRIPT_FILENAME']) == realpath(__FILE__)) { die('This page is not meant to be accessed directly.'); }
// Set variables here
$sitename = "Evenstar"; // Your site name here
$motto = "Evenstar CMS"; // Your motto/slogan/tagline
$email = ""; // Your email here - leave blank to ignore
$sidebar = false; // true/false - Do you want sidebar enabled?
$jsLoc = "header"; // Set to "header" or "footer" for where you want to load JavaScript on page
$navbar = true; // Set to true/false - Enable/Disable navbar
$defaultPage = "home"; // Page to load when no page specified
$theme = "evenstar-navy"; // Set theme directory
$headerOnHomeOnly = false; // Load header.php in the inc folder only on the home page
?>

<?php 
/*
 *
 *	This file is for GIT storage only. 
 *
 *	It's purpose: 
 *  + To let a developer know how to setup the unique "environment.php" file for each environment
 *  + To show how to override environment variables
 *	+ To keep a backup inside GIT of this very important file and information.
 *
 * * * * */
 	
// Local - saved in Git
include_once 'local_conf.php';

/**
 * Optional overrides, ignored by Git
 */
$GLOBALS['config']['log_js'] = false; // Optional
$GLOBALS['config']['log_calls_to_db'] = false; // Optional
$GLOBALS['config']['is_combine_enabled'] = false; // Optional

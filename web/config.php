<?php

session_set_cookie_params(60 * 60);	// 30 minutes
session_start();

$SITE_ROOT = '/mnt/nfs/netapp1/webdev/user/' . $LOCAL_DIR;
$INCLUDES_DIR = $SITE_ROOT . 'includes/';
$TEMPLATES_DIR = $SITE_ROOT . 'templates/';
$CSS_DIR = $SITE_ROOT . 'styles/';
$FAVICON_DIR = $SITE_ROOT . 'images/';
$IMAGES_DIR = $SITE_ROOT . 'images/';

$PROTOCOL = 'http://';
$SITE_URL = $PROTOCOL . $_SERVER['HTTP_HOST'] . '/~' . $LOCAL_DIR;
$JAVASCRIPT_URL = $SITE_URL . 'scripts/';
$AUTHOR_URL = $SITE_URL . 'author/';
$REVIEWER_URL = $SITE_URL . 'reviewer/';
$EBM_URL = $SITE_URL . 'ebm/';
$ADMIN_URL = $SITE_URL . 'admin/';
$USERS_URL = $SITE_URL . 'users/';
$LOGIN_URL = $SITE_URL . 'authentication/';
$REGISTER_URL = $SITE_URL . 'register/';
$IMAGES_URL = $SITE_URL . 'images/';
$LIBRARY_URL = $SITE_URL . 'libraryDocs/html/';
$FAVICON_URL = $SITE_URL . 'images/';
$CSS_URL = $SITE_URL . 'styles/';
$STYLES_FILE = 'default.css';

$SITE_TITLE = "Notebook";
$KEY_WORDS = 'journal, academic journal, computer science, academics';

$HARDNESS_ENUM = array('soft', 'medium', 'hard', 'very hard');
$DIFFICULTY_ENUM = array('easy', 'moderate', 'difficult', 'very difficult');

$ADMIN_ROLE = 0;
$MEMBER_ROLE = 1;

?>

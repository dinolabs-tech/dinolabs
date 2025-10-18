<?php
/**
 * Auto Deployment Script for Edupack
 * ----------------------------------
 * Triggered by a GitHub webhook on each push event.
 * Automatically runs `git pull` in the /edupack folder.
 * 
 * Secure key: foxtrot2november
 */
// asdakjshldn aksdlkasldhkjasdhlkj
// deploy.php (place this in /home/dinolabs/public_html/site)
$secret = 'foxtrot2november';
if (!isset($_GET['key']) || $_GET['key'] !== $secret) {
    http_response_code(403);
    exit('Unauthorized');
}

$repoDir = '/home/dinolabs/public_html/site';
$webRoot = '/home/dinolabs/public_html';

$output = [];

// Step 1: Pull latest code from GitHub
exec("cd $repoDir && git pull 2>&1", $output);

// Step 2: Copy files from /site to root (excluding .git folder)
exec("rsync -av --exclude='.git' $repoDir/ $webRoot/ 2>&1", $output);

echo "<pre>" . implode("\n", $output) . "</pre>";
echo "\n✅ Deployment completed successfully.";


?>

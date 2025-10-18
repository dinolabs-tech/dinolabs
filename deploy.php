<?php
$secret = 'foxtrot2november';
if (!isset($_GET['key']) || $_GET['key'] !== $secret) {
    http_response_code(403);
    exit('Invalid key');
}

$repoDir = '/home/dinolabs/public_html/site';
$webDir  = '/home/dinolabs/public_html';
$logFile = '/home/dinolabs/deploy.log';

chdir($repoDir);
exec('git pull 2>&1', $output);

$copy = "rsync -av --delete $repoDir/ $webDir/";
exec($copy, $output2);

file_put_contents($logFile, date('Y-m-d H:i:s') . ":\n" . implode("\n", array_merge($output, $output2)) . "\n\n", FILE_APPEND);

echo "Deployment completed successfully!";
?>

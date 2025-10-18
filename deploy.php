<?php
// === Secure Access ===
$secret = 'foxtrot2november';
if (!isset($_GET['key']) || $_GET['key'] !== $secret) {
    http_response_code(403);
    exit('Invalid key');
}

// === Paths ===
$repoDir = '/home/dinolabs/public_html/site';
$webDir  = '/home/dinolabs/public_html/';
$logFile = '/home/dinolabs/deploy.log';

// === Step 1: Pull latest changes from Git ===
chdir($repoDir);
exec('git pull 2>&1', $output);

// === Step 2: Recursive Copy (pure PHP) ===
function recurse_copy($src, $dst) {
    $dir = opendir($src);
    @mkdir($dst, 0755, true);

    while(false !== ($file = readdir($dir))) {
        if ($file == '.' || $file == '..' || $file == '.git' || $file == 'deploy.php') continue;

        $srcPath = "$src/$file";
        $dstPath = "$dst/$file";

        if (is_dir($srcPath)) {
            recurse_copy($srcPath, $dstPath);
        } else {
            copy($srcPath, $dstPath);
        }
    }
    closedir($dir);
}

// === Step 3: Remove files not in repo ===
function clean_extra_files($src, $dst) {
    $srcFiles = scandir($src);
    $dstFiles = scandir($dst);

    foreach ($dstFiles as $file) {
        if ($file == '.' || $file == '..' || $file == '.git' || $file == 'deploy.php') continue;

        $srcPath = "$src/$file";
        $dstPath = "$dst/$file";

        if (!file_exists($srcPath)) {
            if (is_dir($dstPath)) {
                remove_dir($dstPath);
            } else {
                unlink($dstPath);
            }
        } elseif (is_dir($srcPath)) {
            clean_extra_files($srcPath, $dstPath);
        }
    }
}

function remove_dir($dir) {
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        $path = "$dir/$item";
        if (is_dir($path)) remove_dir($path);
        else unlink($path);
    }
    rmdir($dir);
}

// Run sync
recurse_copy($repoDir, $webDir);
clean_extra_files($repoDir, $webDir);

// === Step 4: Log the deployment ===
file_put_contents($logFile,
    date('Y-m-d H:i:s') . " Deployment completed\n" .
    implode("\n", $output) . "\n\n",
    FILE_APPEND
);

echo "Deployment completed successfully!";
?>

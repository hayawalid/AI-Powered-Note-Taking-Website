<?php
// router.php - handles routing and static files
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve static files from assets
if (preg_match('/^\/assets\/.*\.(css|js|png|jpg|jpeg|gif|ico|svg)$/', $uri)) {
    $file = __DIR__ . $uri;
    if (file_exists($file)) {
        $ext = pathinfo($uri, PATHINFO_EXTENSION);
        $content_types = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'ico' => 'image/x-icon',
            'svg' => 'image/svg+xml'
        ];
        
        if (isset($content_types[$ext])) {
            header('Content-Type: ' . $content_types[$ext]);
        }
        
        readfile($file);
        exit;
    }
}

// Route root to pages/index.php
if ($uri === '/') {
    include __DIR__ . '/pages/index.php';
    exit;
}

// Route other requests to pages directory
$page_file = __DIR__ . '/pages' . $uri;
if (file_exists($page_file)) {
    include $page_file;
    exit;
}

// For PHP files, try adding .php extension
if (file_exists($page_file . '.php')) {
    include $page_file . '.php';
    exit;
}

// 404 for everything else
http_response_code(404);
echo "404 Not Found";
?>

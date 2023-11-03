<?php
require 'vendor/autoload.php';

// 引入 Facebook SDK for PHP
use Facebook\Facebook;
Dotenv\Dotenv::createImmutable(__DIR__)->load();


// 定義應用程式的設定
$app_id = $_ENV['FACEBOOK_API_ID'];
$app_secret = $_ENV['FACEBOOK_API_SECRET'];
$access_token = $_ENV['FACEBOOK_ACCESS_TOKEN']; // 這是粉絲頁的存取權杖
$page_id = $_ENV['FACEBOOK_PAGE_ID']; // 粉絲頁的 ID

// 初始化 Facebook 客戶端
$fb = new Facebook([
    'app_id' => $app_id,
    'app_secret' => $app_secret,
    'default_graph_version' => 'v18.0', // 根據需要更改 API 版本
]);

// 建立貼文內容
$message = "這是第二個自動發布的測試貼文。";
$link = "https://www.example.com"; // 可選的連結
$picture = "https://images.pexels.com/photos/2521620/pexels-photo-2521620.jpeg"; // 可選的圖片連結

// 建立要發布的貼文陣列
$postData = [
    'message' => $message,
];

try {
    // 發布貼文到粉絲頁
    $response = $fb->post("/$page_id/feed", $postData, $access_token);
    $graphNode = $response->getGraphNode();
    echo '貼文已成功發布，ID：' . $graphNode['id'];
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Facebook API 錯誤：' . $e->getMessage();
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK 錯誤：' . $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}

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

// 建立要發布的貼文陣列
$postData = [
    'message' => '🚴‍♂️🔌 我來跟大家聊聊最新的電動自行車 - Heybike Tyson！這是一輛瘋狂好玩，有時候會讓你刺激不已的摺疊電動自行車！ 🤪

📰 這款酷炫的車子由 Eric Bangeman 介紹，他在 Ars Technica 上發表了一篇詳盡的文章，分享他的體驗。想看完整的評測內容？點擊這裡：https://arstechnica.com/cars/2023/10/the-heybike-tyson-e-bike-is-janky-fun-and-sometimes-dangerous

🚀 Heybike Tyson 有著一個令人驚嘆的外觀，但 Eric 表示這輛車雖然很酷，卻有時候有點傷腦筋。有沒有人也遇到過這樣的情況呢？ 😅

總結來說，Heybike Tyson 是一款充滿各種令人讚嘆的電動自行車功能的好車，但有時也會帶來一些小麻煩。如果你對電動自行車感興趣，不妨點擊上面的連結，了解更多詳情吧！ 🚲💨',
    'url' => 'https://cdn.arstechnica.net/wp-content/uploads/2023/10/tyson-list-760x380.jpg',
];

try {
    // 發布貼文到粉絲頁
    $response = $fb->post("/$page_id/photos", $postData, $access_token);
    $graphNode = $response->getGraphNode();
    echo '貼文已成功發布，ID：' . $graphNode['id'];
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Facebook API 錯誤：' . $e->getMessage();
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK 錯誤：' . $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}

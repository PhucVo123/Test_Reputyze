<?php
require_once('simple_html_dom.php');
$html = file_get_html('https://dantri.com.vn/giao-duc/vu-lo-de-thi-sinh-8-thi-sinh-duoc-mom-de-can-xu-ly-the-nao-20230620004656478.htm');
// Mảng để lưu trữ thông tin bài viết
$articles = [];

// Lặp qua các thẻ chứa bài viết
foreach ($html->find('.article-lot .article-item') as $articleElement) {
    // Lấy tiêu đề
    $title = $articleElement->find('h3', 0)->plaintext;

    // Lấy hình thu nhỏ
    $thumbnail = $articleElement->find('img', 0)->getAttribute('data-src');

    // Lấy đường dẫn
    $url = $articleElement->find('a', 0)->href;

    // Kiểm tra xem bài viết đã tồn tại trong mảng chưa
    $exists = array_search($title, array_column($articles, 'title'));

    // Nếu chưa tồn tại, thêm vào mảng
    if ($exists === false) {
        $articles_lot[] = [
            'title' => $title,
            'thumbnail' => $thumbnail,
            'url' => $url,
        ];
    }
}

foreach ($html->find('.article-related .article-item') as $articleElement) {
    // Lấy tiêu đề
    $title = $articleElement->find('h3', 0)->plaintext;

    // Lấy hình thu nhỏ
    $thumbnail = $articleElement->find('img', 0)->getAttribute('data-src');
    
    // Lấy mô tả
    $description = $articleElement->find('div[class="article-excerpt"]', 0)->plaintext;

    // Lấy đường dẫn
    $url = $articleElement->find('a', 0)->href;

    // Kiểm tra xem bài viết đã tồn tại trong mảng chưa
    $exists = array_search($title, array_column($articles, 'title'));

    // Nếu chưa tồn tại, thêm vào mảng
    if ($exists === false) {
        $articles_related[] = [
            'title' => $title,
            'description' => $description,
            'thumbnail' => $thumbnail,
            'url' => $url,
        ];
    }
}

// Hiển thị thông tin bài viết
echo var_dump($articles_lot);
echo "<br>";
echo var_dump($articles_related);

// Giải phóng bộ nhớ
$html->clear();
unset($html);
?>

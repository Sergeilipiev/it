<?php
$post = $_POST;
if (!empty($post)) {
    $post['link'] = trim($post['link'], 'http://');
    $postlink = "http://" . $post['link'];
    $fp = fopen('file.csv', 'a+');
    if ($post['link2']) {
        if (!checkSameLink('file.csv', $post['link2'])) {
            $shortLink = $post['link2'];
        } else {
            die ("Такая ссылка уже существует");
        };
    } else {
        $alphabyte = range("a", "z");
        $shortLink = '';
        $flag = false;

        while (!$flag) {
            for ($i = 0; $i < 5; $i++) {
                $shortLink .= $alphabyte[rand(0, 25)];
            };
            if (!checkSameLink('file.csv', $shortLink)) $flag = true;
        }
    }
    $list = [$shortLink, $postlink];
    fputcsv($fp, $list);
    fclose($fp);
    echo "<a href=http://" . $_SERVER['SERVER_NAME'] . '/' . $shortLink . ">" . $_SERVER['SERVER_NAME'] . '/' . $shortLink . "</a>";
}
function checkSameLink($csvFile, $link)
{
    $csv = array_map('str_getcsv', file($csvFile));
    foreach ($csv as $val) {
        if ($val[0] == $link) {
            return true;
        }
    }
}



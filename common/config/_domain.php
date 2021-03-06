<?php
//conf
$dsn      = getenv('DB_DSN') . ';charset=utf8';
$username = getenv('DB_USERNAME');
$passwd   = getenv('DB_PASSWORD');

//connect
try {
    $db = new PDO($dsn, $username, $passwd);
} catch (PDOException $ex) {
    echo $ex->getMessage();
    die();
}

$sql = 'SELECT * FROM domain';

$stm = $db->prepare($sql);
$stm->execute();

try {
    $host = $_SERVER['HTTP_HOST'];
    $host = preg_replace('/^www./', '', $host);

    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $key => $value) {
        Yii::setAlias('@frontendUrls', Yii::getAlias('@frontendUrls') . ',http://' . $value['title']);
        Yii::setAlias('@frontendUrls', Yii::getAlias('@frontendUrls') . ',http://www.' . $value['title']);

        if (!empty($host) and $host == $value['title']) {
            Yii::setAlias('@domainId', $value['id']);
            Yii::setAlias('@dealerId', $value['dealer_id']);
            Yii::setAlias('@frontendUrl', 'http://' . $value['title']);
            Yii::setAlias('@dealerLocale', $value['locale']);
            Yii::setAlias('@dealerAvLocale', $value['av_locale']);

        }
    }

    /* echo '<pre>';
      print_r(Yii::getAlias('@frontendUrls'));
      die(); */
} catch (PDOException $ex) {
    die('Rows fetch fail.' . $ex->getMessage());
}

if (preg_match('/^www./', $_SERVER['HTTP_HOST'])) {
    $url = str_replace('http://', 'http://www.', Yii::getAlias('@frontendUrl'));
    Yii::setAlias('@frontendUrl', $url);
}
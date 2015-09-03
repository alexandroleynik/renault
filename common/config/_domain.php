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
    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $key => $value) {
        Yii::setAlias('@frontendUrls', Yii::getAlias('@frontendUrls') . ',http://' . $value['title']);

        if (!empty($_SERVER['HTTP_HOST']) and $_SERVER['HTTP_HOST'] == $value['title']) {
            Yii::setAlias('@domainId', $value['id']);
            Yii::setAlias('@frontendUrl', 'http://' . $value['title']);
        }
    }

    /* echo '<pre>';
      print_r(Yii::getAlias('@frontendUrls'));
      die(); */
} catch (PDOException $ex) {
    die('Rows fetch fail.' . $ex->getMessage());
}


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$data['title']?></title>
    <meta name="description" content="<?=$data['title']?>">

    <link rel="stylesheet" href="/public/css/main.css" charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" crossorigin="anonymous">
</head>
<body>
<?php require 'public/blocks/header.php' ?>

<div class="container main">
    <h1><?=$data['title']?></h1>
    <div class="products">
        <?php for($i = 0; $i < count($data['products']); $i++): ?>
            <div class="product">
                <div class="image">
                    <img src="/public/img/<?=$data['products'][$i]['img']?>" alt="<?=$data['products'][$i]['title']?>">
                </div>
                <h3><?=$data['products'][$i]['title']?></h3>
                <p><?=$data['products'][$i]['anons']?></p>
                <a href="/product/<?=$data['products'][$i]['id']?>"><button class="btn">Детальнее</button></a>
            </div>
        <?php endfor; ?>
    </div>

    <!-- Проверяем больше ли одной страницы для создания пагинации-->
    <?php if($data['pages'] > 1): ?>
        <br><br>
        <!-- Перебираем страницы для отображения пагинации-->
        <?php for($i = 0; $i < $data['pages']; $i++): ?>
            <?php
            $url = $i == 0 ? '/categories' : '/categories/'.($i + 1);
            ?>
            <a href="<?=$url?>"><span class="pagination-btn"><?=($i + 1)?></span></a>
        <?php endfor; ?>
    <?php endif; ?>

</div>

<?php require 'public/blocks/footer.php' ?>
</body>
</html>
<?php
        require '../models/DB.php';
        $_db = DB::getInstence();

        $sql = 'INSERT INTO products(title, anons, text,img,price, category)
                    VALUES (:title, :anons, :text, :img, :price, :category )';

        $query = $_db->prepare($sql);
        $query->execute([
            'title' => 'Новый продукт',
            'anons' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi non quis exercitationem
                     culpa nesciunt nihil aut nostrum explicabo.',
            'text' => 'It is a long established fact that a reader will be distracted by the readable content 
                    of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less
                    normal distribution of letters, as opposed to using Content here, content here,
                    making it look like readable English. Many desktop publishing packages and web page editors now
                    use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many
                    web sites still in their infancy.',
            'img' => 'watch.jpg',
            'price' => 1025,
            'category' => 'watches'
        ]);
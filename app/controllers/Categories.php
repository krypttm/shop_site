<?php
class Categories extends Controller {
    // В функцию можно передать дополнительный параметр,
    // если он не передается, то значение у него будет как 1
    public function index($page = 1) {
        $per_page = 3; // Здесь указываем сколько элементов будет отображаться на странице

        // Высчитываем начиная с какого элемента надо отобразить записи из БД
        // К примеру, если мы на первой странице, то начинаем выводить записи с первой
        // чтобы указать первую запись прописываем значение 0
        // Иначе мы от страницы отнимаем 1 и умножаем на количество отображаемых записей на странице
        // Например: страница 2, значит 2 - 1 * 3, получаем что выводить записи нужно будет начиная с 3
        $page = $page == 1 ? 0 : ($page - 1) * $per_page;

        // Устанавливаем параметр limit. Первое значение с какой записи выбираем,
        // второе значение сколько записей будет выбрано
        $limit = $page.','.$per_page;

        $products = $this->model('Products');

        // Считаем сколько у нас должно быть страниц
        // Например у нас 7 статей, тогда получаем:
        // 7 / 3 и округляем к больше: 7 / 3 = 2,33, ceil(2,33) => 3.
        // Получаем что у нас запишется число 3 в переменную и именно столько страниц и нужно для пагинации
        // чтобы отобразить все записи
        $pagesForPagination = ceil($products->countProducts() / $per_page);

        $data = [
            // Вызываем другую функцию с передачей limit
            'products' => $products->getProductsLimited('id', $limit),
            'title' => 'Все товары на сайте',
            'pages' => $pagesForPagination // Передаем также количество страниц
        ];
        $this->view('categories/index', $data);
    }

    public function shoes() {
        $products = $this->model('Products');
        $data = ['products' => $products->getProductsCategory('shoes'), 'title' => 'Категория обувь'];
        $this->view('categories/index', $data);
    }

    public function hats() {
        $products = $this->model('Products');
        $data = ['products' => $products->getProductsCategory('hats'), 'title' => 'Категория кепки'];
        $this->view('categories/index', $data);
    }

    public function tishirt() {
        $products = $this->model('Products');
        $data = ['products' => $products->getProductsCategory('tishirt'), 'title' => 'Категория футболки'];
        $this->view('categories/index', $data);
    }

    public function watches() {
        $products = $this->model('Products');
        $data = ['products' => $products->getProductsCategory('watches'), 'title' => 'Категория часы'];
        $this->view('categories/index', $data);
    }
}
<?php
class Basket extends Controller {
    public function index() {
        // Была нажата кнопка удалить товар из корзины
        // Соответсвенно удаляем запись из сессии
        if(isset($_POST['item_id_delete'])) {
            // Создаем объект
            $cart = $this->model('BasketModel');
            // Вызываем функцию что удаляет один элемент из сессии
            $cart->deleteOneFromSession($_POST['item_id_delete']);

            // После удаления элемента у нас произойдет вызов сессии еще раз
            // и будут выведены все товары кроме того, что уже удален
        }

        // Если нажата кнопка удалить все товары
        if(isset($_POST['delete_all'])) {
            // Создаем объект
            $cart = $this->model('BasketModel');
            // Вызываем функцию для удаляения всей сессии целиком
            $cart->deleteSession();
        }

        $data = [];
        $cart = $this->model('BasketModel');
        if(isset($_POST['item_id']))
            $cart->addToCart($_POST['item_id']);

        if(!$cart->isSetSession())
            $data['empty'] = 'Пустая корзина';
        else {
            $products = $this->model('Products');
            $data['products'] = $products->getProductsCart($cart->getSession());
        }

        $this->view('basket/index', $data);
    }
}
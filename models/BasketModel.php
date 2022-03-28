<?php
session_start();
class BasketModel {
    private $session_name = 'cart';

    public function isSetSession() {
        return isset($_SESSION[$this->session_name]);
    }

    public function deleteSession() {
        unset($_SESSION[$this->session_name]);
    }

    public function deleteOneFromSession($id) {
        // Сначала разделяем все элементы и получаем массив из них
        $items = explode(",", $_SESSION[$this->session_name]);

        // Если всего один товар и мы его удаляем, то лучше удалить просто всю сессию
        if(count($items) == 1) {
            $this->deleteSession();
            return; // Указываем return, чтобы код внутри функции дальше не обрабатывался
        }

        $new_items = []; // Создаем новый пустой массив
        foreach ($items as $el) { // Перебираем все элементы
            if($el != $id) // Есил сейчас элемент не равен тому что был передан в качестве параметра в функцию
                array_push($new_items, $el); // то добавляем его в новый массив
        }

        // По итогу у нас будет массив, который будет состоять из всех элементов, кроме того, что удаляется
        // Объединяем все в строку (каждый элемент через запятую)
        // Устанавливаем эту строку в сессию
        $_SESSION[$this->session_name] = implode($new_items, ",");
    }

    public function getSession() {
        return $_SESSION[$this->session_name];
    }

    public function addToCart($itemID) {
        if(!$this->isSetSession())
            $_SESSION[$this->session_name] = $itemID;
        else {
            $items = explode(",", $_SESSION[$this->session_name]);

            $itemExist = false;
            foreach ($items as $el) {
                if($el == $itemID)
                    $itemExist = true;
            }

            if(!$itemExist)
                $_SESSION[$this->session_name] = $_SESSION[$this->session_name].','.$itemID;
        }
    }

    public function countItems() {
        if(!$this->isSetSession())
            return 0;
        else {
            $items = explode(",", $_SESSION[$this->session_name]);
            return count($items);
        }
    }
}
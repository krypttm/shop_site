<?php
    class Home extends Controller {
        public function index() {
            $products = $this->model('Products');

            $this->view('home/index', $products->getProductsLimited("id", 5));
            //5 это максимально число записей которое мы хотим вывести
        }
    }
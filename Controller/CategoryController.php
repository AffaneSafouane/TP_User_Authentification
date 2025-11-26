<?php 

class CategoryController {
    public function display() {
        $title = 'Shop';

        ob_start();
        require 'View/pages/home.php';
        $content = ob_get_clean();

        require 'View/layout.php';
    }

    public function unauthorized() {
        $title = 'Unauthorized';
        ob_start();
        require 'View/unauthorized.php';
        $content = ob_get_clean();

        require 'View/layout.php';
    }
}
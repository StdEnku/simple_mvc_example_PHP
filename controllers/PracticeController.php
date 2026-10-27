<?php //通常のコントローラ

namespace controllers;

class PracticeController {
    public function Form() {
        require_once __DIR__ . '/../views/form.phtml';
    }

    public function Result() {
        $Message = $_GET['sendText'];
        require_once __DIR__ . '/../views/result.phtml';
    }
}
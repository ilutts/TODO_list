<?php

namespace App\View;

class View implements Renderable
{
    private string $page;
    private $data;

    public function __construct(string $page, $data = [])
    {
        $this->page = $page;
        $this->data = $data;
    }

    public function render()
    {
        $path = explode('.', $this->page);

        if (count($path) === 0) {
            return false;
        }

        $path[count($path) - 1] = $path[count($path) - 1] . '.php';
        $file = implode('/', $path);

        require($_SERVER['DOCUMENT_ROOT'] . '/view/templates/header.php');

        includeView($file, $this->data);

        require($_SERVER['DOCUMENT_ROOT'] . '/view/templates/footer.php');
    }
}

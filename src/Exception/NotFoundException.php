<?php

namespace App\Exception;

use App\Model\Menu;
use \App\View\Renderable;

class NotFoundException extends HttpException implements Renderable
{
    public function render()
    {
        $file = '404.php';
        
        $data = $this->getMessage();

        require($_SERVER['DOCUMENT_ROOT'] . '/view/templates/header.php');

        includeView($file, $data);

        require($_SERVER['DOCUMENT_ROOT'] . '/view/templates/footer.php');
    }
}

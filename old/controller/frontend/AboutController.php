<?php

namespace controller\frontend;

class AboutController extends MainController
{
    public function about()
    {
        require('view/frontend/template_about.php');
    }
}

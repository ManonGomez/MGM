<?php

namespace controller\backend;

use controller\frontend\MainController;

class AdminController extends MainController
{


   public function dashboard()
   {

      require('view/backend/template_admin.php');
   }
}

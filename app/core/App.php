<?php

class App
{

   protected $controller = "NotFound";
   protected $method = "index";
   protected $params = [];

   function __construct()
   {

      $url = $this->parseURL();

      //  Controller
      if (isset($url[0]) && file_exists('app/controllers/' . $url[0] . '.php')) {

         $this->controller = $url[0];
         unset($url[0]);
      }

      require_once 'app/controllers/' . $this->controller . '.php';
      $this->controller = new $this->controller;


      //  Method
      if (isset($url[1])) {

         if (method_exists($this->controller, $url[1])) {

            $this->method = $url[1];
            unset($url[1]);
         }
      }

      //  Params
      if (!empty($url)) {

         $this->params = array_values($url);
      }

      call_user_func([$this->controller, $this->method], $this->params);
   }

   function parseURL()
   {

      if (isset($_GET['url'])) {

         $url = rtrim($_GET['url'], '/');
         $url = filter_var($url, FILTER_SANITIZE_URL);
         $url = explode('/', $url);
         return $url;
      }
   }

   // public static function view($view, $data = [])
   // {
   //     // Menyusun path tampilan dengan benar
   //     $viewPath = 'public/views/' . $view . '.php';

   //     // Memastikan file tampilan ada sebelum dimuat
   //     if (file_exists($viewPath)) {
   //         require_once $viewPath;
   //         return $data;
   //     } else {
   //         die("View file '$view' not found.");
   //     }
   // }

   public static function model($model)
   {
      // Menyusun path model dengan benar
      $modelPath = 'app/models/' . $model . '.php';

      // Memastikan file model ada sebelum dimuat
      if (file_exists($modelPath)) {
         require_once $modelPath;
         return new $model;
      } else {
         die("Model file '$model' not found.");
      }
   }

   public static function view($view, $data = [], $layout = 'layouts/main')
   {
      // Ekstrak data array ke dalam variabel individual yang bisa digunakan di view dan layout
      extract($data);

      // Path untuk file view
      $viewPath = 'public/views/' . $view . '.php';

      // Path untuk layout, jika disediakan
      $layoutPath = 'public/views/' . $layout . '.php';

      // Cek apakah file view tersedia
      if (!file_exists($viewPath)) {
         die("View file '$viewPath' not found.");
      }

      // Jika layout digunakan, include layout
      if (file_exists($layoutPath)) {
         ob_start();
         require_once $viewPath;  // Mulai tampilan view
         $content = ob_get_clean();  // Simpan konten view ke dalam variabel $content

         // Di layout, $content bisa digunakan untuk menampilkan view
         require_once $layoutPath;
      } else {
         // Jika tidak ada layout, langsung tampilkan view
         require_once $viewPath;
      }
   }




   public static function component($component, $data = [])
   {
      // Extract data array into individual variables
      extract($data);

      // Path ke komponen
      $componentPath = 'public/views/' . $component . '.php';

      // Memastikan file komponen ada sebelum dimuat
      if (file_exists($componentPath)) {
         // Mulai output buffering
         ob_start();

         // Muat file komponen
         require $componentPath;

         // Ambil konten dari output buffer dan bersihkan buffer
         return ob_get_clean();
      } else {
         die("Component file '$component' not found.");
      }
   }


   public static function extends($path, $data = [])
   {
      // Extract data array into individual variables
      extract($data);

      // Compose the path for the file to be extended
      $extends = "public/views/$path.php";

      // Check if the file exists
      if (file_exists($extends)) {
         // Start output buffering
         ob_start();

         // Include the file
         require_once $extends;

         // Return the output buffer content and clean it
         return ob_get_clean();
      } else {
         // Display an error message if the file is not found
         die("Component file '$path' not found.");
      }
   }
}

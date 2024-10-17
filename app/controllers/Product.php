<?php

class Product
{
    public function index()
    {
        Session::checkSession("Admin");

        $_SESSION['gagal'] = "Access denied.";

        header("Location: " . Routes::base('admin/product'));
        exit();
    }

    public function form($params = null)
    {
        Session::checkSession("Admin");

        if ($params != null && in_array($params[0], ['add', 'update'])) {
            $action  = $params[0];
            $product = '';
            $slug       = $params[1] ?? null;

            if ($action == 'update') {
                if ($slug == null) {
                    $_SESSION['gagal'] = "Invalid request.";
                    header("Location: " . Routes::base('admin/product'));
                    exit();
                }
                $product    = ProductModel::getBySlug($slug);
                $user       = UserModel::getById($product['user_id']);
                $frame      = FrameModel::getById($product['frame_id']);
                $category   = CategoryModel::getById($product['category_id']);
            }

            $data = [
                'title'      => "Form $action product",
                'link'       => 'Form',
                'input'      => $_SESSION['form_data'] ?? '',
                'data'       => [
                    "product"   => $product ?? '',
                    "user"      => $user ?? '',
                    "frame"     => $frame ?? '',
                    "category"  => $category ?? '',
                ]
            ];

            App::view("admin/product/actions/$action", $data, 'admin/layouts/app');
        } else {
            $_SESSION['gagal'] = "Invalid action.";
            header("Location: " . Routes::base('admin/product'));
            exit();
        }
    }

    public function detail($params)
    {
        Session::checkSession("Admin");

        $slug = htmlspecialchars($params[0]) ?? '';
        $product = ProductModel::getBySlug($slug);

        if (!$product) {
            $_SESSION['gagal'] = "Product not found.";
            header("Location: " . Routes::base('admin/product'));
            exit();
        }

        $user = UserModel::getById($product['id_user']);
        $category = CategoryModel::getById($product['category_id']);
        $frame = FrameModel::getById($product['frame_id']);
        $data = [
            'title'      => "Detail " . $product['name'],
            'link'       => 'Master Data',
            'data'   => [
                "product" => $product,
                "user" => $user,
                "frame" => $frame,
                "category" => $category,

            ]
        ];

        App::view("admin/product/detail", $data, 'admin/layouts/app');
    }

    //  Store

    public function status($params = null)
    {

        Session::checkSession("Admin");

        $slug = $params[0] ?? null;
        $status = $params[1] ?? null;

        if ($slug && $status) {
            $product = ProductModel::getBySlug($slug);
            $status = $status == 'active' ? '1' : '0';

            if ($product) {
                if (ProductModel::updateStatus($slug, $status)) {
                    $_SESSION['berhasil'] = "Product status updated successfully.";
                } else {
                    $_SESSION['gagal'] = "Failed to update Product status.";
                }
            } else {
                $_SESSION['gagal'] = "Product not found.";
            }
        } else {
            $_SESSION['gagal'] = "Invalid request.";
        }
        header("Location: " . Routes::base('admin/product'));
        exit();
    }

    public function add()
    {
        Session::checkSession("Admin");

        if (isset($_POST['add'])) {

            // Sanitize and process input
            $input = [
                'id_user' => htmlspecialchars($_SESSION['user']['id']),
                'name' => htmlspecialchars($_POST['name']),
                'description' => htmlspecialchars($_POST['description']),
                'price' => htmlspecialchars($_POST['price']),
                'category' => htmlspecialchars($_POST['category']),
                'frame' => htmlspecialchars($_POST['frame']),
                'slug' => ProductModel::generateSlug(htmlspecialchars($_POST['name']))
            ];

            $input['photo'] = self::upload($_FILES['photo'], htmlspecialchars($input['slug']));

            // Validation
            $errors = self::validateInput($input);
            if (!empty($errors)) {
                $_SESSION['warning'] = implode('<br>', $errors);
                $_SESSION['form_data'] = $input;
                header("Location: " . Routes::base('product/form/add'));
                exit();
            }

            if (ProductModel::insert($input)) {
                $_SESSION['berhasil'] = "product " . $input['name'] . " added successfully.";
                header("Location: " . Routes::base('admin/product'));
            } else {
                $_SESSION['gagal'] = "Failed to add product.";
                header("Location: " . Routes::base('product/form/add'));
            }
            exit();
        }
        $_SESSION['info'] = "You are redirected to the add form.";
        header("Location: " . Routes::base('product/form/add'));
    }

    public function update($params)
    {
        Session::checkSession("Admin");

        $slug = $params[0] ?? null;

        if ($slug == null) {
            $_SESSION['gagal'] = "Invalid request.";
            header("Location: " . Routes::base('admin/product'));
            exit();
        }

        if (isset($_POST['update'])) {
            $input = [
                'id_user' => htmlspecialchars($_SESSION['user']['id']),
                'name' => htmlspecialchars($_POST['name']),
                'description' => htmlspecialchars($_POST['description']),
                'price' => htmlspecialchars($_POST['price']),
                'category' => htmlspecialchars($_POST['category']),
                'frame' => htmlspecialchars($_POST['frame']),
                'slug' => ProductModel::generateSlug(htmlspecialchars($_POST['name']))
            ];

            $record = ProductModel::getBySlug($slug);
            $photo = $record['product_photo'];

            if (!empty($_FILES['photo']['name'])) {
                unlink(Routes::upload("product/$photo"));
                $input['photo'] = self::upload($_FILES['photo'], $input['slug']);
            } else {
                $input['photo'] = $record['product_photo'];
            }

            $errors = self::validateInput($input, $isUpdate = true, $slug);
            if (!empty($errors)) {
                $_SESSION['warning'] = implode('<br>', $errors);
                $_SESSION['form_data'] = $input;
                header("Location: " . Routes::base('product/form/update/' . $input['slug']));
                exit();
            }


            if (ProductModel::update($input, $slug)) {
                $_SESSION['berhasil'] = "Product " . $input['name'] . " updated successfully.";
                header("Location: " . Routes::base('admin/product'));
            } else {
                $_SESSION['gagal'] = "Failed to update product.";
                header("Location: " . Routes::base('product/form/update/' . $input['slug']));
            }
            exit();
        }
        $_SESSION['info'] = "You are redirected to the update form.";
        header("Location: " . Routes::base('product/form/update/' . $params[1]));
    }

    public function delete($params)
    {
        Session::checkSession("Admin");


        $slug = $params[0];
        $product = ProductModel::getBySlug($slug);
        $name = $product['product_name'];
        $photo = $product['product_photo'];

        if (ProductModel::delete($slug)) {
            unlink(Routes::upload("product/$photo"));
            $_SESSION['berhasil'] = "Product $name deleted successfully.";
        } else {
            $_SESSION['gagal'] = "Failed to delete product.";
        }
        header("Location: " . Routes::base('admin/product'));
        exit();
    }

    private static function upload($file, $product)
    {
        $baseDir = Routes::upload('product/');

        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0777, true);
        }

        $allowedExtensions = ['jpeg', 'jpg', 'png'];
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExt, $allowedExtensions)) {
            $fileExt = 'png';
        }

        $randomName = bin2hex(random_bytes(8));
        $date = date('Ymd_His');
        $newFileName = 'Product-' . $product . '_' . $randomName . '_' . $date . '.' . $fileExt;
        $targetFile = $baseDir . $newFileName;

        return move_uploaded_file($file['tmp_name'], $targetFile) ? $newFileName : null;
    }

    private static function validateInput($input, $isUpdate = false, $slug = null)
    {
        $errors = [];

        // Jika mode update, ambil data kategori lama berdasarkan slug
        if ($isUpdate) {
            $record = ProductModel::getBySlug($slug);

            // Jika nama diubah, maka cek apakah ada kategori lain dengan nama yang sama
            if ($input['name'] !== $record['product_name']) {
                if (ProductModel::exists($input['name'])) {
                    $errors[] = "The product name already exists.";
                }
            }
        } else {
            // Jika mode tambah, cek apakah nama kategori sudah ada
            if (ProductModel::exists($input['name'])) {
                $errors[] = "The product name already exists.";
            }
        }

        // Validasi nama kategori harus diisi
        if (empty($input['name'])) {
            $errors[] = "The name field is required.";
        }

        // Validasi deskripsi harus diisi
        if (empty($input['description'])) {
            $errors[] = "The description field is required.";
        }

        // Validasi foto hanya pada penambahan kategori baru atau jika ada upload foto baru
        if (!$isUpdate && empty($input['photo'])) {
            $errors[] = "A photo is required.";
        }

        return $errors;
    }
}

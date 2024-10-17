<?php 

class Slide
{
    public function index()
    {
        Session::checkSession('Admin');
        $_SESSION['gagal'] = "Access denied.";
        header("Location: " . Routes::base('admin/slide'));
        exit();
    }
    
    public function detail($params)
    {
        Session::checkSession('Admin');
        
        $slug = htmlspecialchars($params[0] ?? '');
        
        $slide = SlideModel::getBySlug($slug);

        $user = UserModel::getById($slide['id_user']);
        $data = [
            'title'      => "Detail " . $slide['name'],
            'link'       => 'Master Data',
            'slide'   => $slide,
            'user'       => $user
        ];

        App::view("admin/slide/detail", $data, "admin/layouts/app");
        
    }

    public function status($params = null)
    {
        $slug = $params[0] ?? null;
        $status = $params[1] ?? null;

        if ($slug && $status) {
            $slide = slideModel::getBySlug($slug);
            $status = $status == 'active' ? '1' : '0';

            if ($slide) {
                if (slideModel::updateStatus($slug, $status)) {
                    $_SESSION['berhasil'] = "slide status updated successfully.";
                } else {
                    $_SESSION['gagal'] = "Failed to update slide status.";
                }
            } else {
                $_SESSION['gagal'] = "slide not found.";
            }
        } else {
            $_SESSION['gagal'] = "Invalid request.";
        }
        header("Location: " . Routes::base('admin/slide'));
        exit();
    }

    

}

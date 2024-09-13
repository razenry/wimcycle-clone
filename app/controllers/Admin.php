<?php

class Admin extends Controller
{
    // Menyimpan lokasi layout untuk tampilan backend dan admin
    private $layouts = "backend/layouts/";
    private $admin = "backend/admin/";
    private $petugas = "backend/admin/petugas/";

    // Fungsi utama untuk menampilkan halaman dashboard admin atau petugas
    public function index()
    {
        session_start();

        // Memeriksa apakah pengguna sudah login, jika belum, arahkan ke halaman login
        if (!isset($_SESSION['login']) || $_SESSION['login'] !== "berhasil") {
            header("Location: " . Routes::base("admin/auth"));
            exit();
        }

        // Mengambil data statistik untuk dashboard
        $data['title'] = 'Dashboard';
        $data['user'] = $_SESSION['user'];
        $data['motivation'] = $this->model("Motivasi_model")->getMotivation();
        $data['jml_pengguna'] = $this->model("User_model")->countUsers();
        $data['jml_petugas'] = $this->model("User_model")->countPetugas();
        $data['jml_laporan'] = $this->model("Laporan_model")->countLaporan();
        $data['status_laporan'] = [
           "Tuntas" => $this->model("Laporan_model")->countLaporanByStatus("Tuntas")['total'],
           "Menunggu" => $this->model("Laporan_model")->countLaporanByStatus("Menunggu tanggapan")['total'],
           "Diverifikasi" => $this->model("Laporan_model")->countLaporanByStatus("Diverifikasi")['total'],
           "Tindakan" => $this->model("Laporan_model")->countLaporanByStatus("Dalam tindakan")['total'],
           "Ditolak" => $this->model("Laporan_model")->countLaporanByStatus("Ditolak")['total'],
        ];

        // Breadcrumb navigasi untuk halaman dashboard
        $data['breadcrumb'] = [
            'Dashboard' => ""
        ];

        // Memuat tampilan sesuai dengan level pengguna (Admin atau Petugas)
        if (isset($_SESSION['user']['level']) == "Admin") {
            $this->view($this->layouts . 'header', $data);
            $this->view($this->layouts . 'loader');
            $this->view($this->layouts . 'navbar', $data);
            $this->view($this->admin . 'index', $data);
            $this->view($this->layouts . 'footer');
        } elseif (isset($_SESSION['user']['level']) == "Petugas") {
            $this->view($this->layouts . 'header', $data);
            $this->view($this->layouts . 'loader');
            $this->view($this->layouts . 'navbar', $data);
            $this->view($this->petugas . 'index', $data);
            $this->view($this->layouts . 'footer');
        } 
    }
    
    // Fungsi untuk menampilkan halaman login
    public function auth()
    {
        session_start();

        $data['title'] = 'Login';

        $this->view($this->layouts . 'header', $data);
        $this->view($this->layouts . 'loader');
        $this->view($this->admin . 'auth/login');
        $this->view($this->layouts . 'footer');
    }

    // Fungsi untuk menampilkan halaman profil pengguna
    public function profile()
    {
        session_start();

        // Memeriksa apakah pengguna sudah login, jika belum, arahkan ke halaman login
        if (!isset($_SESSION['login']) || $_SESSION['login'] !== "berhasil") {
            header("Location: " . Routes::base("admin/auth"));
            exit();
        }

        $data['user'] = $_SESSION['user'];
        $data['title'] = "Profil";
        $data['motivation'] = $this->model("Motivasi_model")->getMotivation();

        // Breadcrumb navigasi untuk halaman profil
        $data['breadcrumb'] = [
            'Dashboard' => $_SESSION['user']['level'] == "Admin" ? "admin" : "admin/petugas",
            'Profil' => "",
        ];

        // Memuat tampilan profil pengguna
        $this->view($this->layouts . 'header', $data);
        $this->view($this->layouts . 'loader');
        $this->view($this->layouts . 'navbar', $data);

        $this->view($this->admin . 'detailUser', $data);

        $this->view($this->layouts . 'setting', $data);
        $this->view($this->layouts . 'footer');
    }

    // Fungsi untuk menangani login pengguna
    public function login()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = $this->model('User_model');
            $user = $userModel->getPetugas($email);

            // Memeriksa apakah pengguna dan password valid
            if ($user && password_verify($password, $user['password'])) {

                // Memeriksa status akun, hanya akun aktif yang dapat login
                if ($user['status'] == 1) {
                    $_SESSION['login'] = "berhasil";
                    $_SESSION['user'] = $user;
                    $_SESSION['berhasil_login'] = "Selamat datang $email";

                    header("Location: " . Routes::base('admin'));
                    exit();
                } else {
                    $_SESSION['gagal'] = "Akun Anda tidak aktif. Hubungi administrator.";
                    header("Location: " . Routes::base("admin/auth"));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "Gagal login. Email atau password salah.";
                header("Location: " . Routes::base("admin/auth") . "?error=Invalid");
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Gagal login. Harap coba lagi.";
            header("Location: " . Routes::base("admin/auth"));
            exit();
        }
    }

    // Fungsi untuk logout dan mengakhiri sesi pengguna
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: " . Routes::base("admin/auth"));
        exit();
    }

    // Fungsi untuk menampilkan halaman error
    public function error()
    {
        session_start();

        $data['title'] = $_SESSION['pesan']['judul'];

        $this->view($this->layouts . 'header', $data);
        $this->view($this->admin . 'error/index');
        $this->view($this->layouts . 'footer');
    }
}

<?php 
    $product = $data['product'];
    $user = $data['user'];
    $category = $data['category'];
    $frame = $data['frame'];
?>

<!-- Page Body -->
<div class="page-body">
    <div class="container-xl">
        <!-- Detail Card -->
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <!-- Header Section -->
            <div class="card-header fs-1 fw-bold text-center py-4">
                <h3 class="mb-0">Product Details</h3>
            </div>

            <!-- Body Section -->
            <?= App::extends('admin/product/ui/table.detail', [
                'username' => $user['name'],
                'level' => $user['level'],
                'email' => $user['email'],
                'slug' => $product['slug'],
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'frame' => $frame['name'],
                'category' => $category['name'],
                'price' => $product['price'],
                'status' => $product['status'],
                'photo' => $product['photo'],
                'created_at' => $product['created_at'],
                'updated_at' => $product['updated_at'] ?? '',
            ]) ?>

            <!-- Footer Section -->
            <div class="card-footer text-end py-4 px-5">
                <div class="d-flex justify-content-between gap-3">
                    <a href="<?= Routes::base('admin/product') ?>" class="btn btn-primary text-white border shadow-sm" style="transition: background-color 0.3s;">Back</a>
                    <div class="d-flex gap-3">
                        <a href="<?= Routes::base('product/form/update/' . $product['slug']) ?>" class="btn btn-warning text-white" style="transition: background-color 0.3s;">Update</a>
                        <a href="<?= Routes::base('product/delete/' . $product['slug']) ?>" class="btn btn-danger text-white delete-btn" style="transition: background-color 0.3s;">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS for Image Responsiveness -->
<style>
    .image-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%; /* Aspect ratio 16:9 */
    }

    .image-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }

        .card-header {
            font-size: 1.5rem;
        }
    }
</style>

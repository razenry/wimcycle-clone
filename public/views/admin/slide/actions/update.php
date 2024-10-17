<?php

// die(var_dump($category));


if (isset($category)) {
    $slug = $category['slug'];
    $name = $category['name'];
    $description = $category['description'];



    $data['input'] = [
        'name' => $name,
        'description' => $description,
    ];


    $photo = $category['photo'];
    $status = $category['status'];
    $id = $category['id'];
}

?>
<div class="page-body">
    <div class="container-xl">
        <form action="<?= Routes::base('category/update/' . $slug) ?>" method="post" class="card" enctype="multipart/form-data">
            <div class="card-header">
                <h4 class="card-title text-center">Edit Category Form</h4>
            </div>
            <div class="card-body">

                <!-- Name Input -->
                <div class="mb-3">
                    <label for="name" class="form-label required">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                        value="<?= isset($data['input']['name']) ? htmlspecialchars($data['input']['name']) : ''; ?>">
                </div>

                <!-- Description Input -->
                <div class="mb-3">
                    <label for="description" class="form-label required">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4"
                        placeholder="Enter description"
                        maxlength="255"><?= isset($data['input']['description']) ? htmlspecialchars($data['input']['description']) : ''; ?></textarea>
                </div>


                <!-- Photo Upload with Preview and Cancel -->
                <div class="mb-3">
                    <label for="photo" class="form-label required">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*"
                        onchange="previewImage(event)">
                    <div class="mt-3 d-flex justify-content-center position-relative">
                        <img id="imagePreview" src="" alt="Image Preview"
                            style="display: none; max-width: 50%; height: auto; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <button type="button" id="cancelButton" class="btn btn-danger position-absolute"
                            style="display: none; top: 10px; right: 10px;" onclick="cancelImage()">Cancel</button>
                    </div>
                </div>

            </div>
            <div class="card-footer text-end">
                <div class="d-flex">
                    <a href="<?= Routes::base('admin/category') ?>" class="btn btn-primary">Cancel</a>
                    <button type="submit" name="update" class="btn btn-warning ms-auto">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const cancelButton = document.getElementById('cancelButton');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                cancelButton.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
            cancelButton.style.display = 'none';
        }
    }

    function cancelImage() {
        const imagePreview = document.getElementById('imagePreview');
        const cancelButton = document.getElementById('cancelButton');
        const fileInput = document.getElementById('photo');

        fileInput.value = '';
        imagePreview.style.display = 'none';
        cancelButton.style.display = 'none';
    }
</script>
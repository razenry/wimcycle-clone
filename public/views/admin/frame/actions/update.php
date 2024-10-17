<?php

// die(var_dump($frame));


if (isset($frame)) {
    $slug = $frame['slug'];
    $name = $frame['name'];
    $description = $frame['description'];



    $data['input'] = [
        'name' => $name,
        'description' => $description,
    ];

    $status = $frame['status'];
    $id = $frame['id'];
}

?>
<div class="page-body">
    <div class="container-xl">
        <form action="<?= Routes::base('frame/update/' . $slug) ?>" method="post" class="card" enctype="multipart/form-data">
            <div class="card-header">
                <h4 class="card-title text-center">Edit Frame Form</h4>
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

            </div>
            <div class="card-footer text-end">
                <div class="d-flex">
                    <a href="<?= Routes::base('admin/frame') ?>" class="btn btn-primary">Cancel</a>
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
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">

        

        <div class="d-flex justify-content-start mb-3 mt-3">
            <a href="<?= Routes::base('slide/form/add') ?>" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
                Create New Slide
            </a>
        </div>
        
        <!-- Datatables -->
        <div id="table-default" class="table-responsive">
            <table class="table table-bordered mt-3" id="datatable">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th><button class="table-sort" data-sort="sort-name">Name</button></th>
                        <th class="text-center">image</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    <?php $i = 1;
                    foreach ($slides as $slide) : ?>
                        <tr>
                            <td class="sort-name text-center"><?= $i++ ?></td>
                            <td class="sort-name"><?= $slide['name'] ?></td>
                            <td class="sort-name text-center">
                                <a href="<?= Routes::storage('categories/' . $slide['image']) ?>" class="text-primary" data-bs-toggle="modal" data-bs-target="#imagePreviewModal" data-image-url="<?= Routes::storage('categories/' . $slide['image']) ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-image">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M15 8h.01" />
                                        <path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" />
                                        <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                                        <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                                    </svg>
                                </a>
                            </td>
                            <td class="sort-name text-center">

                                <?php if ($slide['status'] == 1) : ?>
                                    <a href="<?= Routes::base('slide/status/' . $slide['slug'] . '/non-active') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00ff40" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-toggle-right">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M16 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M2 6m0 6a6 6 0 0 1 6 -6h8a6 6 0 0 1 6 6v0a6 6 0 0 1 -6 6h-8a6 6 0 0 1 -6 -6z" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <?php if ($slide['status'] == 0) : ?>
                                    <a href="<?= Routes::base('slide/status/' . $slide['slug'] . '/active') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-toggle-left">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                            <path d="M2 6m0 6a6 6 0 0 1 6 -6h8a6 6 0 0 1 6 6v0a6 6 0 0 1 -6 6h-8a6 6 0 0 1 -6 -6z" />
                                        </svg>
                                    </a>
                                <?php endif; ?>

                            </td>

                            <td class="sort-type d-flex gap-3 justify-content-center align-item-center">
                                <a href="<?= Routes::base('slide/detail/' . $slide['slug']) ?>" class="text-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                    </svg>
                                </a>
                                <!-- Edit -->
                                <a href="<?= Routes::base('slide/form/update/' . $slide['slug']) ?>" class="text-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </a>
                                <a href="<?= Routes::base('slide/delete/' . $slide['slug']) ?>" class="text-danger delete-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <!-- Repeat the rows for other entries -->
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagePreviewModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Image Preview">
            </div>
        </div>
    </div>
</div>

<!-- Js -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bootstrap's modal event handling
        var imagePreviewModal = document.getElementById('imagePreviewModal');
        imagePreviewModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var imageUrl = button.getAttribute('data-image-url'); // Extract info from data-* attributes
            var modalImage = imagePreviewModal.querySelector('#modalImage'); // Find the image element in the modal
            modalImage.src = imageUrl; // Update the image source
        });
    });
</script>
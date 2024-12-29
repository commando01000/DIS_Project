<!-- Edit Modal -->
<div class="modal fade" id="{{ $modal_name }}" tabindex="-1" aria-labelledby="{{ $modal_name }}_ModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="{{ $form_name }}" action="{{ $route }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($type == 'update')
                    @method('PUT')
                    <input type="hidden" id="user_id" name="user_id" >
                    <input type="hidden" id="index" name="index" >
                @endif
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $modal_name }}_ModalLabel">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" >
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" >
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" >
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                        <img id="photoPreview" class="rounded-circle mt-3" width="100" height="100"
                        src="">
  
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_admin_checkbox" name="is_admin"
                            value="1" >
                        <label class="form-check-label" for="is_admin_checkbox">Not Admin</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


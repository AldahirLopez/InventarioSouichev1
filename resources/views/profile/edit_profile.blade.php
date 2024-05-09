<div id="EditProfileModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            <form method="POST" action="{{ route('usuarios.updateProfile', \Illuminate\Support\Facades\Auth::user()->id) }}" id="editProfileForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-danger d-none" id="editProfileValidationErrorsBox"></div>
                    <input type="hidden" name="user_id" id="pfUserId">
                    <input type="hidden" name="is_active" value="1">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Name:</label><span class="required">*</span>
                            <input type="text" name="name" id="pfName" class="form-control" required autofocus tabindex="1">
                        </div>
                        <div class="form-group col-sm-6 d-flex">
                            <div class="col-sm-4 col-md-6 pl-0 form-group">
                                <label>Profile Image:</label>
                                <br>
                                <label class="image__file-upload btn btn-primary text-white" tabindex="2"> Choose
                                    <input type="file" name="photo" id="pfImage" class="d-none">
                                </label>
                            </div>
                            <div class="col-sm-3 preview-image-video-container float-right mt-1">
                                <img id='edit_preview_photo' class="img-thumbnail user-img user-profile-img profilePicture" src="{{asset('img/logo.png')}}" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>Email:</label><span class="required">*</span>
                            <input type="text" name="email" id="pfEmail" class="form-control" required tabindex="3">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" id="btnPrEditSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing..." tabindex="5">Save
                        </button>
                        <button type="button" class="btn btn-light ml-1 edit-cancel-margin margin-left-5" data-dismiss="modal">Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('editProfileForm');

        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Evitar el envío convencional del formulario
            
            var formData = new FormData(form); // Crear un objeto FormData con los datos del formulario

            // Realizar una petición POST utilizando fetch
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Agregar el token CSRF a los encabezados
                }
            })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(function (data) {
                // Manejar la respuesta del servidor si es necesario
                console.log(data);
                alert('Perfil Actualizado Correctamente!');
                // Aquí puedes agregar más acciones si lo necesitas, como actualizar la interfaz de usuario, etc.
                $('#EditProfileModal').modal('hide'); // Cerrar el modal después de actualizar el perfil
            })
            .catch(function (error) {
                console.error('There has been a problem with your fetch operation:', error);
                // Manejar cualquier error que ocurra durante la petición
            });
        });
    });
</script>

    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <div class="row">
    <div class="col-md-8">
        <form action="{{ isset($setting) ? route('admin.setting.update', ['setting' => $setting->id]) : route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($setting))
            @method('PUT')
        @endif    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text"  placeholder="Name ..."  name="name" value="{{ old('name', isset($setting) ? $setting->name : '') }}" class="form-control" id="name" aria-describedby="nameHelp" required/>

        @error('name')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text"  placeholder="Description ..."  name="description" value="{{ old('description', isset($setting) ? $setting->description : '') }}" class="form-control" id="description" aria-describedby="descriptionHelp" required/>

        @error('description')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="currency" class="form-label">Currency</label>
        <input type="text"  placeholder="Currency ..."  name="currency" value="{{ old('currency', isset($setting) ? $setting->currency : '') }}" class="form-control" id="currency" aria-describedby="currencyHelp" required/>

        @error('currency')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="taxeRate" class="form-label">TaxeRate</label>
        <input type="text"  placeholder="TaxeRate ..."  name="taxeRate" value="{{ old('taxeRate', isset($setting) ? $setting->taxeRate : '') }}" class="form-control" id="taxeRate" aria-describedby="taxeRateHelp" required/>

        @error('taxeRate')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <button type="button" class="btn btn-success btn-file my-1" onclick="triggerFileInput('imageUrl')">
            Add file :  (ImageUrl)
        </button>
        <input type="file" name="imageUrl" value="{{ old('imageUrl', isset($setting) ? $setting->imageUrl : '') }}" class="visually-hidden form-control imageUpload" id="imageUrl" aria-describedby="imageUrlHelp"/>

        <div class="form-group d-flex" id="preview_imageUrl" style="max-width: 100%;">
        </div>
        @error('imageUrl')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="street" class="form-label">Street</label>
        <input type="text"  placeholder="Street ..."  name="street" value="{{ old('street', isset($setting) ? $setting->street : '') }}" class="form-control" id="street" aria-describedby="streetHelp" required/>

        @error('street')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="city" class="form-label">City</label>
        <input type="text"  placeholder="City ..."  name="city" value="{{ old('city', isset($setting) ? $setting->city : '') }}" class="form-control" id="city" aria-describedby="cityHelp" required/>

        @error('city')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="state" class="form-label">State</label>
        <input type="text"  placeholder="State ..."  name="state" value="{{ old('state', isset($setting) ? $setting->state : '') }}" class="form-control" id="state" aria-describedby="stateHelp" required/>

        @error('state')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text"  placeholder="Email ..."  name="email" value="{{ old('email', isset($setting) ? $setting->email : '') }}" class="form-control" id="email" aria-describedby="emailHelp" required/>

        @error('email')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text"  placeholder="Phone ..."  name="phone" value="{{ old('phone', isset($setting) ? $setting->phone : '') }}" class="form-control" id="phone" aria-describedby="phoneHelp" required/>

        @error('phone')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="codePostal" class="form-label">CodePostal</label>
        <input type="text"  placeholder="CodePostal ..."  name="codePostal" value="{{ old('codePostal', isset($setting) ? $setting->codePostal : '') }}" class="form-control" id="codePostal" aria-describedby="codePostalHelp" required/>

        @error('codePostal')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="copyright" class="form-label">Copyright</label>
        <input type="text"  placeholder="Copyright ..."  name="copyright" value="{{ old('copyright', isset($setting) ? $setting->copyright : '') }}" class="form-control" id="copyright" aria-describedby="copyrightHelp" required/>

        @error('copyright')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <a href="{{ route('admin.setting.index') }}" class="btn btn-danger mt-1">
        Cancel
    </a>
    <button class="btn btn-primary mt-1"> {{ isset($setting) ? 'Update' : 'Create' }}</button>
 </form>
    </div>
    <div class="col-md-4">
    <a  class="btn btn-danger mt-1" href="{{ route('admin.setting.index') }}">
    Cancel
</a>
<button class="btn btn-primary mt-1"> {{ isset($setting) ? 'Update' : 'Create' }}</button>
    </div>
    </div>

    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <script>
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach((textarea) => {
            ClassicEditor
                .create(textarea)
                .catch(error => {
                    console.error(error);
                });
        });

        $(document).ready(function() {
            $('select').select2();
        });
        function triggerFileInput(fieldId) {
            const fileInput = document.getElementById(fieldId);
            if (fileInput) {
                fileInput.click();
            }
        }

        const imageUploads = document.querySelectorAll('.imageUpload');
        imageUploads.forEach(function(imageUpload) {
            imageUpload.addEventListener('change', function(event) {
                event.preventDefault()
                const files = this.files; // Récupérer tous les fichiers sélectionnés
                console.log(files)
                if (files && files.length > 0) {
                    const previewContainer = document.getElementById('preview_' + this.id);
                    previewContainer.innerHTML = ''; // Effacer le contenu précédent

                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        if (file) {
                            const reader = new FileReader();
                            const img = document.createElement('img'); // Créer un élément img pour chaque image

                            reader.onload = function(event) {
                                img.src = event.target.result;
                                img.alt = "Prévisualisation de l'image"
                                img.style.maxWidth = '100px';
                                img.style.display = 'block';
                            }

                            reader.readAsDataURL(file);
                            previewContainer.appendChild(img); // Ajouter l'image à la prévisualisation
                            console.log({img})
                            console.log({previewContainer})
                        }
                    }
                    console.log({previewContainer})
                }
            });
        });
    </script>
    @endsection
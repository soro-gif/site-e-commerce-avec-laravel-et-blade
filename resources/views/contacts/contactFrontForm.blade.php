    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <div class="row">
    <div class="col-md-12">
        <form class="row" action="{{ isset($contact) ? route('admin.contact.update', ['contact' => $contact->id]) : route('admin.contact.store') }}" method="POST" >
        @csrf
        @if(isset($contact))
            @method('PUT')
        @endif 
        <div class="mb-3 col-md-6">
            {{-- <label for="name" class="form-label">Name</label> --}}
            <input type="text"  placeholder="Name ..."  name="name" value="{{ old('name', isset($contact) ? $contact->name : '') }}" class="form-control" id="name" aria-describedby="nameHelp" required/>

            @error('name')
                <div class="error text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3 col-md-6">
                {{-- <label for="email" class="form-label">Email</label> --}}
                <input type="text"  placeholder="Email ..."  name="email" value="{{ old('email', isset($contact) ? $contact->email : '') }}" class="form-control" id="email" aria-describedby="emailHelp" required/>

                @error('email')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
        </div>
        <div class="mb-3 col-md-6">
            {{-- <label for="subject" class="form-label">Subject</label> --}}
            <input type="text"  placeholder="Subject ..."  name="subject" value="{{ old('subject', isset($contact) ? $contact->subject : '') }}" class="form-control" id="subject" aria-describedby="subjectHelp" required/>
            @error('subject')
                <div class="error text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div> 
        <div class="mb-3 col-md-6">
                {{-- <label for="phone" class="form-label">Phone</label> --}}
                <input type="text"  placeholder="Phone ..."  name="phone" value="{{ old('phone', isset($contact) ? $contact->phone : '') }}" class="form-control" id="phone" aria-describedby="phoneHelp" required/>

                @error('phone')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
        </div>      
    
            <div class="mb-3 ">
                {{-- <label for="content" class="form-label">Content</label> --}}
                <textarea name="content" class="form-control" id="content" aria-describedby="contentHelp">{{ old('content', isset($contact) ? $contact->content : '') }}</textarea>

                @error('content')
                    <div class="error text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>    
    
    
    {{-- <a href="{{ route('admin.contact.index') }}" class="btn btn-danger mt-1">
        Cancel
    </a> --}}
    <div class="col-md-12 mb-3">
        <button class="btn btn-primary"> {{ isset($contact) ? 'Update' : 'Create' }}</button>
    </div>
 </form>
    </div>
    {{-- <div class="col-md-4">
    <a  class="btn btn-danger mt-1" href="{{ route('admin.contact.index') }}">
    Cancel
</a>
<button class="btn btn-primary mt-1"> {{ isset($contact) ? 'Update' : 'Create' }}</button>
    </div> --}}
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
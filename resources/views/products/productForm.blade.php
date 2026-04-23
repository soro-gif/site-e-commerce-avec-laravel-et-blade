    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endsection
    <div class="row">
    <div class="col-md-8">
        <form action="{{ isset($product) ? route('admin.product.update', ['product' => $product->id]) : route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product))
            @method('PUT')
        @endif    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text"  placeholder="Name ..."  name="name" value="{{ old('name', isset($product) ? $product->name : '') }}" class="form-control" id="name" aria-describedby="nameHelp" required/>

        @error('name')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text"  placeholder="Description ..."  name="description" value="{{ old('description', isset($product) ? $product->description : '') }}" class="form-control" id="description" aria-describedby="descriptionHelp" required/>

        @error('description')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
        <div class="mb-3">
        <label for="categories" class="form-label">Categories</label>
        <select name="categories[]" id="categories" class="form-control" multiple>
            <option disabled value="null">Select Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    value="{{$category->id}}" 
                    @if (in_array($category->id, old('categories', isset($product) ? $product->categories->pluck('id')->toArray() : []))) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        @error('categories')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    
    <div class="mb-3">
        <label for="moreDescription" class="form-label">MoreDescription</label>
        <textarea name="moreDescription" class="form-control" id="moreDescription" aria-describedby="moreDescriptionHelp">{{ old('moreDescription', isset($product) ? $product->moreDescription : '') }}</textarea>

        @error('moreDescription')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="additionalInfos" class="form-label">AdditionalInfos</label>
        <textarea name="additionalInfos" class="form-control" id="additionalInfos" aria-describedby="additionalInfosHelp">{{ old('additionalInfos', isset($product) ? $product->additionalInfos : '') }}</textarea>

        @error('additionalInfos')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="text"  placeholder="Stock ..."  name="stock" value="{{ old('stock', isset($product) ? $product->stock : '') }}" class="form-control" id="stock" aria-describedby="stockHelp" required/>

        @error('stock')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="soldePrice" class="form-label">SoldePrice</label>
        <input type="text"  placeholder="SoldePrice ..."  name="soldePrice" value="{{ old('soldePrice', isset($product) ? $product->soldePrice : '') }}" class="form-control" id="soldePrice" aria-describedby="soldePriceHelp" required/>

        @error('soldePrice')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <label for="regularPrice" class="form-label">RegularPrice</label>
        <input type="text"  placeholder="RegularPrice ..."  name="regularPrice" value="{{ old('regularPrice', isset($product) ? $product->regularPrice : '') }}" class="form-control" id="regularPrice" aria-describedby="regularPriceHelp" required/>

        @error('regularPrice')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3">
        <button type="button" class="btn btn-success btn-file my-1" onclick="triggerFileInput('imageUrls')">
            Add files :  (ImageUrls)
        </button>
        <input type="file" name="imageUrls[]" class="form-control imageUpload visually-hidden" id="imageUrls" aria-describedby="imageUrlsHelp" multiple />
        <div class="form-group  hstack gap-3" id="preview_imageUrls" style="max-width: 100%;"></div>
        @error('imageUrls')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>    <div class="mb-3">
        <label for="brand" class="form-label">Brand</label>
        <input type="text"  placeholder="Brand ..."  name="brand" value="{{ old('brand', isset($product) ? $product->brand : '') }}" class="form-control" id="brand" aria-describedby="brandHelp" required/>

        @error('brand')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3 d-flex gap-2">
        <label for="isAvailable" class="form-label">IsAvailable</label>
        <div class="form-check form-switch">
            <input name="isAvailable" id="isAvailable" value="true" data-bs-toggle="toggle"  {{ old('isAvailable', isset($product) && $product->isAvailable == 'true' ? 'checked' : '') }} class="form-check-input" type="checkbox" role="switch" />
        </div>
        {{-- <select class="form-control" name="isAvailable" id="isAvailable">
            <option value="true" {{ old('isAvailable', isset($product) && $product->isAvailable == 'true' ? 'selected' : '') }}>Yes</option>
            <option value="false" {{ old('isAvailable', isset($product) && $product->isAvailable == 'false' ? 'selected' : '') }}>No</option>
        </select> --}}

        @error('isAvailable')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3 d-flex gap-2">
        <label for="isBestSeller" class="form-label">IsBestSeller</label>
        <div class="form-check form-switch">
            <input name="isBestSeller" id="isBestSeller" value="true" data-bs-toggle="toggle"  {{ old('isBestSeller', isset($product) && $product->isBestSeller == 'true' ? 'checked' : '') }} class="form-check-input" type="checkbox" role="switch" />
        </div>
        {{-- <select class="form-control" name="isBestSeller" id="isBestSeller">
            <option value="true" {{ old('isBestSeller', isset($product) && $product->isBestSeller == 'true' ? 'selected' : '') }}>Yes</option>
            <option value="false" {{ old('isBestSeller', isset($product) && $product->isBestSeller == 'false' ? 'selected' : '') }}>No</option>
        </select> --}}

        @error('isBestSeller')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3 d-flex gap-2">
        <label for="isNewArrival" class="form-label">IsNewArrival</label>
        <div class="form-check form-switch">
            <input name="isNewArrival" id="isNewArrival" value="true" data-bs-toggle="toggle"  {{ old('isNewArrival', isset($product) && $product->isNewArrival == 'true' ? 'checked' : '') }} class="form-check-input" type="checkbox" role="switch" />
        </div>
        {{-- <select class="form-control" name="isNewArrival" id="isNewArrival">
            <option value="true" {{ old('isNewArrival', isset($product) && $product->isNewArrival == 'true' ? 'selected' : '') }}>Yes</option>
            <option value="false" {{ old('isNewArrival', isset($product) && $product->isNewArrival == 'false' ? 'selected' : '') }}>No</option>
        </select> --}}

        @error('isNewArrival')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3 d-flex gap-2">
        <label for="isFeatured" class="form-label">IsFeatured</label>
        <div class="form-check form-switch">
            <input name="isFeatured" id="isFeatured" value="true" data-bs-toggle="toggle"  {{ old('isFeatured', isset($product) && $product->isFeatured == 'true' ? 'checked' : '') }} class="form-check-input" type="checkbox" role="switch" />
        </div>
        {{-- <select class="form-control" name="isFeatured" id="isFeatured">
            <option value="true" {{ old('isFeatured', isset($product) && $product->isFeatured == 'true' ? 'selected' : '') }}>Yes</option>
            <option value="false" {{ old('isFeatured', isset($product) && $product->isFeatured == 'false' ? 'selected' : '') }}>No</option>
        </select> --}}

        @error('isFeatured')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <div class="mb-3 d-flex gap-2">
        <label for="isSpecialOffer" class="form-label">IsSpecialOffer</label>
        <div class="form-check form-switch">
            <input name="isSpecialOffer" id="isSpecialOffer" value="true" data-bs-toggle="toggle"  {{ old('isSpecialOffer', isset($product) && $product->isSpecialOffer == 'true' ? 'checked' : '') }} class="form-check-input" type="checkbox" role="switch" />
        </div>
        {{-- <select class="form-control" name="isSpecialOffer" id="isSpecialOffer">
            <option value="true" {{ old('isSpecialOffer', isset($product) && $product->isSpecialOffer == 'true' ? 'selected' : '') }}>Yes</option>
            <option value="false" {{ old('isSpecialOffer', isset($product) && $product->isSpecialOffer == 'false' ? 'selected' : '') }}>No</option>
        </select> --}}

        @error('isSpecialOffer')
            <div class="error text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>    <a href="{{ route('admin.product.index') }}" class="btn btn-danger mt-1">
        Cancel
    </a>
    <button class="btn btn-primary mt-1"> {{ isset($product) ? 'Update' : 'Create' }}</button>
 </form>
    </div>
    <div class="col-md-4">
    <a  class="btn btn-danger mt-1" href="{{ route('admin.product.index') }}">
    Cancel
</a>
<button class="btn btn-primary mt-1"> {{ isset($product) ? 'Update' : 'Create' }}</button>
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
@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div >
        <h3>Show Product</h3>

        <a href="{{ route('admin.product.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                    <tr>
        <th>Name</th> 
        <td>{{ $product->name }}</td>
</tr>
    <tr>
        <th>Slug</th> 
        <td>{{ $product->slug }}</td>
</tr>
    <tr>
        <th>Description</th> 
        <td>{{ $product->description }}</td>
</tr>
    <tr>
        <th>MoreDescription</th> 
        <td>{!! $product->moreDescription !!}</td>
</tr>
    <tr>
        <th>AdditionalInfos</th> 
        <td>{!! $product->additionalInfos !!}</td>
</tr>
    <tr>
        <th>Stock</th> 
        <td>{{ $product->stock }}</td>
</tr>
    <tr>
        <th>SoldePrice</th> 
        <td>{{ $product->soldePrice }}</td>
</tr>
    <tr>
        <th>RegularPrice</th> 
        <td>{{ $product->regularPrice }}</td>
</tr>
    <tr>
        <th>ImageUrls</th>
        <td>
            <div class="form-group d-flex" id="preview_imageUrls" style="max-width: 100%;">
               @foreach ($product->imageUrlsArray() as $url)
                    <img src="{{ Storage::url($url) }}"
                         alt="Product image"
                         style="max-width: 100px; display: block;"
                         />
                @endforeach
            </div>

        </td>
    </tr>
    <tr>
        <th>Brand</th> 
        <td>{{ $product->brand }}</td>
</tr>
    <tr>
        <th>IsAvailable</th> 
        <td>
            <div class="form-check form-switch">
                <input name="isAvailable" disabled id="isAvailable" value="true" data-bs-toggle="toggle"  {{ $product->isAvailable == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
            </div>
        </td>
    </tr>
    <tr>
        <th>IsBestSeller</th> 
        <td>
            <div class="form-check form-switch">
                <input name="isBestSeller" disabled id="isBestSeller" value="true" data-bs-toggle="toggle"  {{ $product->isBestSeller == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
            </div>
        </td>
    </tr>
    <tr>
        <th>IsNewArrival</th> 
        <td>
            <div class="form-check form-switch">
                <input name="isNewArrival" disabled id="isNewArrival" value="true" data-bs-toggle="toggle"  {{ $product->isNewArrival == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
            </div>
        </td>
    </tr>
    <tr>
        <th>IsFeatured</th> 
        <td>
            <div class="form-check form-switch">
                <input name="isFeatured" disabled id="isFeatured" value="true" data-bs-toggle="toggle"  {{ $product->isFeatured == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
            </div>
        </td>
    </tr>
    <tr>
        <th>IsSpecialOffer</th> 
        <td>
            <div class="form-check form-switch">
                <input name="isSpecialOffer" disabled id="isSpecialOffer" value="true" data-bs-toggle="toggle"  {{ $product->isSpecialOffer == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
            </div>
        </td>
    </tr>
	
            </tbody>
        </table>

        <div>
            <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}" class="btn btn-primary my-1">
                <i class="fa-solid fa-pen-to-square"></i>  Edit
            </a>
        </div>
    </div>
@endsection
@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div >
        <h3>Show Setting</h3>

        <a href="{{ route('admin.setting.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                    <tr>
        <th>Name</th> 
        <td>{{ $setting->name }}</td>
</tr>
    <tr>
        <th>Description</th> 
        <td>{{ $setting->description }}</td>
</tr>
    <tr>
        <th>Currency</th> 
        <td>{{ $setting->currency }}</td>
</tr>
    <tr>
        <th>TaxeRate</th> 
        <td>{{ $setting->taxeRate }}</td>
</tr>
    <tr>
        <th>ImageUrl</strong></th>
        <td>
            <div class="form-group d-flex" id="preview_imageUrl" style="max-width: 100%;">
                <img src="{{ Str::startsWith($setting->imageUrl, 'http') ? $setting->imageUrl : Storage::url($setting->imageUrl) }}"
                     alt="Prévisualisation de l'image"
                     style="max-width: 100px; display: block;">
            </div>
        </td>
     </tr>
    <tr>
        <th>Street</th> 
        <td>{{ $setting->street }}</td>
</tr>
    <tr>
        <th>City</th> 
        <td>{{ $setting->city }}</td>
</tr>
    <tr>
        <th>State</th> 
        <td>{{ $setting->state }}</td>
</tr>
    <tr>
        <th>Email</th> 
        <td>{{ $setting->email }}</td>
</tr>
    <tr>
        <th>Phone</th> 
        <td>{{ $setting->phone }}</td>
</tr>
    <tr>
        <th>CodePostal</th> 
        <td>{{ $setting->codePostal }}</td>
</tr>
    <tr>
        <th>Copyright</th> 
        <td>{{ $setting->copyright }}</td>
</tr>
	
            </tbody>
        </table>

        <div>
            <a href="{{ route('admin.setting.edit', ['id' => $setting->id]) }}" class="btn btn-primary my-1">
                <i class="fa-solid fa-pen-to-square"></i>  Edit
            </a>
        </div>
    </div>
@endsection
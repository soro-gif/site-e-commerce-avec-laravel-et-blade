@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div >
        <h3>Show Page</h3>

        <a href="{{ route('admin.page.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                    <tr>
        <th>Title</th> 
        <td>{{ $page->title }}</td>
</tr>
    <tr>
        <th>Slug</th> 
        <td>{{ $page->slug }}</td>
</tr>
    <tr>
        <th>Content</th> 
        <td>{!! $page->content !!}</td>
</tr>
    <tr>
        <th>IsHead</th> 
        <td>
            <div class="form-check form-switch">
                <input name="isHead" disabled id="isHead" value="true" data-bs-toggle="toggle"  {{ $page->isHead == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
            </div>
        </td>
    </tr>
    <tr>
        <th>IsFoot</th> 
        <td>
            <div class="form-check form-switch">
                <input name="isFoot" disabled id="isFoot" value="true" data-bs-toggle="toggle"  {{ $page->isFoot == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
            </div>
        </td>
    </tr>
	
            </tbody>
        </table>

        <div>
            <a href="{{ route('admin.page.edit', ['id' => $page->id]) }}" class="btn btn-primary my-1">
                <i class="fa-solid fa-pen-to-square"></i>  Edit
            </a>
        </div>
    </div>
@endsection
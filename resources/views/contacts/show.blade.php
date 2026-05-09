@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div >
        <h3>Show Contact</h3>

        <a href="{{ route('admin.contact.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                    <tr>
        <th>Subject</th> 
        <td>{{ $contact->subject }}</td>
</tr>
    <tr>
        <th>Email</th> 
        <td>{{ $contact->email }}</td>
</tr>
    <tr>
        <th>Content</th> 
        <td>{!! $contact->content !!}</td>
</tr>
    <tr>
        <th>Phone</th> 
        <td>{{ $contact->phone }}</td>
</tr>
    <tr>
        <th>Name</th> 
        <td>{{ $contact->name }}</td>
</tr>
	
            </tbody>
        </table>

        <div>
            <a href="{{ route('admin.contact.edit', ['id' => $contact->id]) }}" class="btn btn-primary my-1">
                <i class="fa-solid fa-pen-to-square"></i>  Edit
            </a>
        </div>
    </div>
@endsection
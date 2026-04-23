@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div >
        <h3>Show User</h3>

        <a href="{{ route('admin.user.index') }}" class="btn btn-success my-1">
            Home
        </a>
        <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                    <tr>
        <th>Name</th> 
        <td>{{ $user->name }}</td>
</tr>
    <tr>
        <th>Email</th> 
        <td>{{ $user->email }}</td>
</tr>
    <tr>
        <th>Email_verified_at</th> 
        <td>{{ $user->email_verified_at }}</td>
</tr>
    <tr>
        <th>Password</th> 
        <td>{{ $user->password }}</td>
</tr>
	
            </tbody>
        </table>

        <div>
            <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}" class="btn btn-primary my-1">
                <i class="fa-solid fa-pen-to-square"></i>  Edit
            </a>
        </div>
    </div>
@endsection
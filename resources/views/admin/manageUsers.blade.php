@include('/templates/app')
<div class="container">
    <div class="card-body shadow" style="margin-bottom: 3vh">
        <h3>Shto user:</h3>
        <form action="/admin/adduser" method="POST">
            @csrf
            <div class="form-group col-md-3 d-inline-block">
                <label for="name">Emri:</label>
                <input type="text" class="form-control" name="name" placeholder="Emri">
            </div>
            <div class="form-group col-md-3 d-inline-block">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group col-md-3 d-inline-block">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group col-md-2 d-inline-block">
                <label for="role">Roli:</label>
                <select class="form-control" name="role_id">
                    <option value="1">User</option>
                    <option value="2">Admin</option>
                    @if(Auth::user()->role_id==3)<option value="3">Superadmin</option>@endif
                </select>
            </div>
            <button type="submit" class="btn btn-success">Krijo</button>

        </form>
    </div>
<table class="table table-striped">
    <tr>
        <th>Id</th>
        <th>Emri</th>
        <th>Email</th>
        <th>Roli</th>
        <th>Veprim</th>
    </tr>
@foreach($users as $user)
        <form action="/admin/updateuser" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$user['id']}}">
    <tr>
        <td>{{$user['id']}}</td>
        <td><input type="text" name="name" class="form-control" value="{{$user['name']}}"></td>
        <td><input type="email" name="email" class="form-control" value="{{$user['email']}}"></td>
{{--        <td>{{$user['role_id']}}</td>--}}
        <td>
            @if($user['role_id']!=3)
                <select class="form-control" name="role_id">
                    <option value="1" @if($user['role_id']==1) selected @endif>User</option>
                    <option value="2" @if($user['role_id']==2) selected @endif>Admin</option>
                    <option value="3">Superadmin</option>
                </select>
            @else
                Superadmin
            @endif
        </td>
        <td><button type="submit" class="btn btn-success">Ruaje</button></td>
    </tr>
        </form>
@endforeach

</table>
</div>

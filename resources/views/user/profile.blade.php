@include('templates.app')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">
    <form action="/updateprofile" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" value="<?=$name?>" name="name">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" value="<?=$email?>" name="email">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" placeholder="********" class="form-control" name="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" class="form-control" placeholder="********" name="password_confirmation">
        </div>
        <button type="submit">Update</button>
    </form>
</div>

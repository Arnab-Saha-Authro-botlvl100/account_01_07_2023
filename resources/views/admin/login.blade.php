{{-- <x-app-layout> --}}
    @include('layouts.head')<div class="container">
    <h1>Admin Login</h1>
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
{{-- </x-app-layout> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
<div>
    <form wire:submit="login" method="post" class="flex justify-center min-h-screen items-center">
        @csrf
    <div class="flex  w-full max-w-sm flex-col gap-6">
        <div class="flex flex-col items-center">
            <h1 class="text-3xl font-semibold">Sign In</h1>
            <p class="text-sm">Sign in to access your account</p>
        </div>
        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $item )
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <div class="form-field">
                <label class="form-label" >Email address</label>
    
                <input placeholder="Type here" name="email" type="email" value="{{ old('email') }}" wire:model="email" class="input max-w-full" />
                <label class="form-label">
                    <span class="form-label-alt">Please enter a valid email.</span>
                </label>
            </div>
            <div class="form-field">
                <label class="form-label">Password</label>
                <div class="form-control">
                    <input placeholder="Type here" name="password" type="password" wire:model="password" class="input max-w-full" />
                </div>
            </div>
            <div class="form-field">
                <div class="form-control justify-between">
                    <div class="flex gap-2">
                        <input type="checkbox" class="checkbox" />
                        <a href="#">Remember me</a>
                    </div>
                    <label class="form-label">
                        <a class="link link-underline-hover link-primary text-sm">Forgot your password?</a>
                    </label>
                </div>
            </div>
            <div class="form-field pt-5">
                <div class="form-control justify-between">
                    <button type="submit" class="btn btn-primary w-full">Sign in</button>
                </div>
            </div>
    
            <div class="form-field">
                <div class="form-control justify-center">
                    <a wire:navigate href="/register" class="link link-underline-hover link-primary text-sm">Don't have an account yet? Sign up.</a>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
</body>
</html>
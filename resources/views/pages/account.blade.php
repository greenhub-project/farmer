@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 md:px-0">
  <div class="w-full max-w-md md:mx-auto">
      <div class="text-blue-darker text-2xl font-sans mb-6">Update Your Account</div>
      <div class="bg-white p-8 rounded shadow">
          <form class="form-horizontal" method="POST" action="{{ route('account.update') }}">
              @csrf
              @method('PUT')

              <input type="hidden" name="user_id" value="{{ $user->id }}">
    
              <div class="flex items-stretch mb-3">
                  <label for="name" class="text-right font-semibold text-grey-dark text-sm pt-2 pr-3 align-middle w-1/4">Name</label>
                  <div class="flex flex-col w-3/4">
                      <input id="name" type="text" class="flex-grow h-8 px-2 border rounded {{ $errors->has('name') ? 'border-red-dark' : 'border-grey-light' }}" name="name" value="{{ $errors->has('name') ? old('name') : $user->name }}">
                      {!! $errors->first('name', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                  </div>
              </div>
    
              <div class="flex items-stretch mb-3">
                  <label for="email" class="text-right font-semibold text-grey-dark text-sm pt-2 pr-3 align-middle w-1/4">E-Mail Address</label>
                  <div class="flex flex-col w-3/4">
                      <input id="email" type="email" class="flex-grow h-8 px-2 border rounded {{ $errors->has('email') ? 'border-red-dark' : 'border-grey-light' }}" name="email" value="{{ $errors->has('email') ? old('email') : $user->email }}" required>
                      {!! $errors->first('email', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                  </div>
              </div>

              <div class="flex items-stretch mb-4">
                  <label for="password" class="text-right font-semibold text-grey-dark text-sm pt-2 pr-3 align-middle w-1/4">Password</label>
                  <div class="flex flex-col w-3/4">
                      <input id="password" type="password" class="flex-grow h-8 px-2 rounded border {{ $errors->has('password') ? 'border-red-dark' : 'border-grey-light' }}" name="password">
                      {!! $errors->first('password', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                  </div>
              </div>
    
              <div class="flex items-stretch mb-6">
                  <label for="password_confirmation" class="text-right font-semibold text-grey-dark text-sm pt-2 pr-3 align-middle w-1/4">Confirm Password</label>
                  <div class="flex flex-col w-3/4">
                      <input id="password_confirmation" type="password" class="flex-grow h-8 px-2 rounded border {{ $errors->has('password_confirmation') ? 'border-red-dark' : 'border-grey-light' }}" name="password_confirmation">
                      {!! $errors->first('password_confirmation', '<span class="text-red-dark text-sm mt-2">:message</span>') !!}
                  </div>
              </div>
    
              <div class="flex">
                  <div class="w-3/4 ml-auto">
                      <button type="submit" class="bg-blue-darker hover:bg-blue-darkest text-blue-lightest text-sm font-sans font-semibold py-2 px-4 rounded mr-3">
                          Update profile
                      </button>
                  </div>
              </div>
          </form>
      </div>
  </div>
</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($users as $user)
                            <a href="#" class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $user->name }} (<small class="text-dark">{{ $user->roles[0]->title ?? '' }}</small>)</h5>
                                    <small class="text-center">
                                        @if($user->avatar)
                                            <img src="{{ $user->avatar }}" height="42px" width="42px" alt="{{ $user->name }}"/>
                                        @endif
                                        <br>
                                        {{ $user->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="mb-1">Email Address: {{ $user->email ?? '' }}</p>
                                    <small>
                                        Phone: {{ $user->phone ?? '' }}
                                    </small>
                                </div>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

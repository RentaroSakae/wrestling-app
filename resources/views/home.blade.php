@extends('layouts.wrestlingapp')

@section('content')
    <div class="container" style="min-height: 100vh;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('ログインしました!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

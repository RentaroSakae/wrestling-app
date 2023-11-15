{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h3 class="text-center">会員登録ありがとうございます！</h3>

                <p class="text-center">
                    現在、仮会員の状態です。
                </p>

                <p class="text-center">
                    ただいま、ご入力いただいたメールアドレス宛に、ご本人様確認用のメールをお送りしました。
                </p>

                <p class="text-center">
                    メール本文内のURLをクリックすると本会員登録が完了となります。
                </p>
                <div class="text-center">
                    <a href="{{ url('/') }}" class="btn samuraimart-submit-button w-50 text-white">トップページへ</a>
                </div>
            </div>
        </div>
    </div>
@endsection

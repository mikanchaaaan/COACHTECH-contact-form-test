@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <div class="thanks__heading">
        <h2>お問い合わせありがとうございました</h2>
    </div>
</div>
<div class="thanks__button">
    <form action="/" method="get">
    <button class="home">HOME</button>
    </form>
</div>
@endsection
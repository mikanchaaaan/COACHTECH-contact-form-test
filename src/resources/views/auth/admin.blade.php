@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('button')
@if (Auth::check())
<form class="logout-form" action="/logout" method="POST">
    @csrf
    <button class="button_inner">logout</button>
</form>
@endif
@endsection

@section('content')
<div class="search-form__content">
    <div class="search-form__inner">
        <div class="search-form__heading">
            <h2>Admin</h2>
        </div>
        <form action="/admin/search" class="search-form" method="get">
            @csrf
            <!-- 検索フォーム -->
            <div class="search-form__item">
                <!-- メールアドレス/名前入力 -->
                <input type="text" class="search-form__item-input" placeholder="名前やメールアドレスを入力してください" name="keyword" value="{{ old('keyword') }}">
                <!-- 性別選択 -->
                <select name="gender" class="search-form__item-select">
                    <option value="">性別</option>
                    <option value="男性">男性</option>
                    <option value="女性">女性</option>
                    <option value="その他">その他</option>
                </select>
                <!-- お問い合わせの種類選択 -->
                <select name="category_id" class="search-form__item-select">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">{{$category['content'] }}</option>
                    @endforeach
                </select>
                <!-- 日付選択 -->
                <input type="date" class="search-form__item-input" name="date" value="{{ old('date') }}">
                <!-- 検索ボタン -->
                <button class="search-button">検索</button>
        </form>
        <!-- リセットボタン -->
        <form action="" class="reset-form">
            <button class="reset-button">リセット</button>
        </form>
    </div>
    <div class="export-and-pagination">
        <!-- エクスポートボタン -->
        <div class="export__inner">
            <button class="export-button">エクスポート</button>
        </div>
        <!-- ページネーション -->
        <div class="pagination">
            {{ $contacts->links() }}
        </div>
    </div>
    <!-- 情報の出力 -->
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-table__header">お名前</th>
                <th class="contact-table__header">性別</th>
                <th class="contact-table__header">メールアドレス</th>
                <th class="contact-table__header">お問い合わせの種類</th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="contact-table__row">
                <td class="contact-table__item">{{ $contact['last_name'] .  " " . $contact['first_name']}}</td>
                <td class="contact-table__item">{{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : ($contact['gender'] == 3 ? 'その他' : '')) }}</td>
                <td class="contact-table__item">{{ $contact['email'] }}</td>
                <td class="contact-table__item">{{ $contact->category->content }}</td>
                <td class="contact-table__item">
                    <button class="detail-button">詳細</button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    @endsection
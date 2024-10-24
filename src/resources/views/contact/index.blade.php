@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>FashionablyLate</h2>
    </div>
    <form action="/confirm" class="form" method="post">
        @csrf
        <!-- 名前行 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--name">
                    <!-- 苗字（lastname) 入力-->
                    <div class="form__input--name--last_name">
                        <input type="text" name="last_name" placeholder="例：山田" value="{{old ('last_name') }}" />
                    </div>
                    <!-- 名前（firstname)入力 -->
                    <div class="form__input--name--first_name">
                        <input type="text" name="first_name" placeholder="例：太郎" value="{{old ('first_name') }}" />
                    </div>
                    <!-- バリデーション -->
                    <div class="form__error">
                    </div>
                </div>
            </div>
        </div>
        <!-- 性別行 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--gender">
                    <!-- 選択肢（男性） -->
                    <div class="form__input--gender--male">
                        <input type="radio" id="gender__male" name="gender" value="1" checked />
                        <label for="gender__male">男性</label>
                    </div>
                    <!-- 選択肢（女性） -->
                    <div class="form__input--gender--female">
                        <input type="radio" id="gender__female" name="gender" value="2" />
                        <label for="gender__female">女性</label>
                    </div>
                    <!-- 選択肢（その他） -->
                    <div class="form__input--gender--other">
                        <input type="radio" id="gender__other" name="gender" value="3" />
                        <label for="gender__other">その他</label>
                    </div>
                    <!-- バリデーション -->
                    <div class="form__error">
                    </div>
                </div>
            </div>
        </div>
        <!-- メールアドレス行 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text--email">
                    <!-- メールアドレス入力-->
                    <div class="form__input--email">
                        <input type="text" name="email" placeholder="test@example.com" value="{{old ('email') }}" />
                    </div>
                    <!-- バリデーション -->
                    <div class="form__error">
                    </div>
                </div>
            </div>
        </div>
        <!-- 電話番号行 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--tel">
                    <!-- 電話番号1(市外局番) -->
                    <div class="form__input--tel--high">
                        <input type="text" name="tel_high" placeholder="090" value="{{old ('tel_high') }}" />
                    </div>
                    <!-- 電話番号（ハイフン）-->
                    <div class="form__input--tel--hyphen">
                        <p>-</p>
                    </div>
                    <!-- 電話番号2(真ん中) -->
                    <div class="form__input--tel--middle">
                        <input type="text" name="tel_middle" placeholder="1234" value="{{old ('tel_middle') }}" />
                    </div>
                    <!-- 電話番号（ハイフン）-->
                    <div class="form__input--tel--hyphen">
                        <p>-</p>
                    </div>
                    <!-- 電話番号3(下4桁) -->
                    <div class="form__input--tel--low">
                        <input type="text" name="tel_low" placeholder="5678" value="{{old ('tel_low') }}" />
                    </div>
                    <!-- バリデーション -->
                    <div class="form__error">
                    </div>
                </div>
            </div>
        </div>
        <!-- 住所行 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text--address">
                    <!-- 住所入力 -->
                    <div class="form__input--address">
                        <input type="text" name="address" placeholder="例:東京都千駄ヶ谷1-2-3" value="{{old ('address') }}" />
                    </div>
                    <!-- バリデーション -->
                    <div class="form__error">
                    </div>
                </div>
            </div>
        </div>
        <!-- 建物名行 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text--building">
                    <!-- 建物名入力 -->
                    <div class="form__input--building">
                        <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{old ('building') }}" />
                    </div>
                    <!-- バリデーション -->
                    <div class="form__error">
                    </div>
                </div>
            </div>
        </div>
        <!-- お問い合わせの種類行 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <!-- お問い合わせの種類選択 -->
                <div class="form__select--content">
                    <select class="form__select--content--item" name="category_id">
                        <option value="">確認してください</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->content }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- バリデーション -->
                <div class="form__error">
                </div>

            </div>
        </div>
        <!-- お問い合わせ内容行 -->
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <!-- お問い合わせ内容の記載 -->
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください。">{{ old('detail') }}</textarea>
                </div>
                <!-- バリデーション -->
                <div class="form__error">
                </div>
            </div>
        </div>
        <!-- 送信ボタン -->
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection
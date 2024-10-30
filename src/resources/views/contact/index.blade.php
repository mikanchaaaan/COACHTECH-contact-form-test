@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
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
                    <!-- 苗字（last_name) 入力-->
                    <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name', $contactData['last_name'] ?? '') }}" />
                    <!-- 名前（first_name)入力 -->
                    <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name', $contactData['first_name'] ?? '') }}" />
                </div>
                <!-- バリデーション(last_name) -->
                <div class="form__error">
                    @error('last_name')
                    {{ $message }}
                    @enderror
                </div>
                <!-- バリデーション(first_name) -->
                <div class="form__error">
                    @error('first_name')
                    {{ $message }}
                    @enderror
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
                        <label for="gender__male">
                            <input type="radio" id="gender__male" name="gender" value="1" {{ old('gender', $contactData['gender'] ?? 1) == 1 ? 'checked' : '' }} />
                            <span class="radio-mark"></span>
                            男性
                        </label>
                    </div>
                    <!-- 選択肢（女性） -->
                    <div class="form__input--gender--female">
                        <label for="gender__female">
                            <input type="radio" id="gender__female" name="gender" value="2" {{ old('gender', $contactData['gender'] ?? 1) == 2 ? 'checked' : '' }} />
                            <span class="radio-mark"></span>
                            女性
                        </label>
                    </div>
                    <!-- 選択肢（その他） -->
                    <div class="form__input--gender--other">
                        <label for="gender__other">
                            <input type="radio" id="gender__other" name="gender" value="3" {{ old('gender', $contactData['gender'] ?? 1) == 3 ? 'checked' : '' }} />
                            <span class="radio-mark"></span>
                            その他
                        </label>
                    </div>
                    <!-- バリデーション(gender) -->
                    <div class="form__error">
                        @error('gender')
                        {{ $message }}
                        @enderror
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
                        <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email', $contactData['email'] ?? '') }}" />
                    </div>
                    <!-- バリデーション(email) -->
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
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
                    <div class="form__input--tel--number">
                        <input type="text" name="tel_high" placeholder="090" value="{{ old('tel_high', $contactData['tel_high'] ?? '') }}" />
                    </div>
                    <!-- 電話番号（ハイフン）-->
                    <div class="form__input--tel--hyphen">
                        <p>-</p>
                    </div>
                    <!-- 電話番号2(真ん中) -->
                    <div class="form__input--tel--number">
                        <input type="text" name="tel_middle" placeholder="1234" value="{{ old('tel_middle', $contactData['tel_middle'] ?? '') }}" />
                    </div>
                    <!-- 電話番号（ハイフン）-->
                    <div class=" form__input--tel--hyphen">
                        <p>-</p>
                    </div>
                    <!-- 電話番号3(下4桁) -->
                    <div class="form__input--tel--number">
                        <input type="text" name="tel_low" placeholder="5678" value="{{ old('tel_low', $contactData['tel_low'] ?? '') }}" />
                    </div>
                </div>
                <!-- バリデーション(tel) -->
                <div class="form__error">
                    @if ($errors->has('tel'))
                    {{ $errors->first('tel') }}
                    @endif
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
                        <input type="text" name="address" placeholder="例:東京都千駄ヶ谷1-2-3" value="{{ old('address', $contactData['address'] ?? '') }}" />
                    </div>
                    <!-- バリデーション(address) -->
                    <div class=" form__error">
                        @error('address')
                        {{ $message }}
                        @enderror
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
                        <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building', $contactData['building'] ?? '') }}" />
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
                        <option value="{{ $category->id }}" {{ old('category_id', $contactData['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <!-- バリデーション(category_id) -->
                <div class="form__error">
                    @error('category_id')
                    {{ $message }}
                    @enderror
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
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください。">{{ old('detail', $contactData['detail'] ?? '') }}</textarea>
                </div>
                <!-- バリデーション(detail) -->
                <div class="form__error">
                    @error('detail')
                    {{ $message }}
                    @enderror
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
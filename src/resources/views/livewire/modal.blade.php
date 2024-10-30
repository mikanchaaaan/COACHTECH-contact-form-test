<div>
    <div class="export-and-pagination">
        <!-- エクスポートボタン -->
        <div class="export__inner">
            <button class="export-button">エクスポート</button>
        </div>
        <!-- ページネーション -->
        <div class="pagination">
            @if($contacts)
            {{ $contacts->appends(request()->query())->links('vendor.pagination.custom') }}
            @endif
        </div>
    </div>
    <!-- 情報の出力 -->
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-table__header">お名前</th>
                <th class="contact-table__header">性別</th>
                <th class="contact-table__header">メールアドレス</th>
                <th class="contact-table__header" colspan="2">お問い合わせの種類</th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="contact-table__row">
                <td class="contact-table__item">{{ $contact->last_name .  " " . $contact->first_name}}</td>
                <td class="contact-table__item">{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : ($contact->gender == 3 ? 'その他' : '')) }}</td>
                <td class="contact-table__item">{{ $contact->email }}</td>
                <td class="contact-table__item">{{ $contact->category->content }}</td>
                <td class="contact-table__item">
                    <button wire:click="openModal('{{ $contact->id }}')" type="button" class="detail-button">詳細</button>
                    <!-- モーダルウインドウの表示 -->
                    @if($showModal && $contact)
                    <div class="modal-wrapper">
                        <div class="modal-window">
                            <div class="modal-header">
                                <button wire:click="closeModal()" type="button" class="modal-close">
                                ×
                                </button>
                            </div>
                            <table class="modal__content">
                                <tr class="modal-inner">
                                    <th class="modal-ttl">お名前</th>
                                    <td class="modal-data">
                                        {{$this->contact->last_name .  " " . $this->contact->first_name}}
                                    </td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl">性別</th>
                                    <td class="modal-data">
                                        {{ $this->genderLabel()}}
                                    </td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl">メールアドレス</th>
                                    <td class="modal-data">{{ $this->contact->email }}</td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl">電話番号</th>
                                    <td class="modal-data">{{ $this->contact->tel }}</td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl">住所</th>
                                    <td class="modal-data">{{ $this->contact->address }}</td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl">建物名</th>
                                    <td class="modal-data">{{ $this->contact->building }}</td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl">お問い合わせの種類</th>
                                    <td class="modal-data">{{ $this->contact->category ? $this->contact->category->content : 'カテゴリ情報がありません' }}</td>
                                </tr>
                                <tr class="modal-inner">
                                    <th class="modal-ttl--last">お問い合わせ内容</th>
                                    <td class="modal-data--last">
                                        {{ $this->contact->detail}}
                                    </td>
                                </tr>
                            </table>
                            <!-- お問い合わせの削除 -->
                            <form class="delete-form" action="/delete" method="post">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="id" value="{{ $this->contact->id }}" />
                                <button class="delete-btn" type="submit">削除</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    // お問い合わせフォームの表示
    public function index()
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    // お問い合わせフォーム確認画面の表示
    public function confirm(Request $request)
    {
        // フォームから値の取得
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel_high', 'tel_middle', 'tel_low', 'address', 'building', 'category_id','detail']);

        // 名前の結合
        $contact['name'] = $contact['last_name'] . " " . $contact['first_name'];

        // 電話番号の結合
        $contact['tel'] = $contact['tel_high'] . $contact['tel_middle'] . $contact['tel_low'];

        // 結合元の配列（電話番号）を削除
        unset($contact['tel_high'], $contact['tel_middle'], $contact['tel_low']);

        // viewにデータを渡す
        return view('contact.confirm', compact('contact'));
    }

    // Thanks画面の表示
    public function store(Request $request)
    {
        // フォームから値の取得
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);

        // データベースへの値の保存
        Contact::create($contact);

        // Thanks画面の表示
        return view('contact.thanks');
    }


}

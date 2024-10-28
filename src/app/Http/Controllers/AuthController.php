<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class AuthController extends Controller
{
    // Admin画面の表示
    public function index()
    {
        $categories = Category::all();
        // ページネーションの設定
        $contacts = Contact::Paginate(7);

        // カテゴリ名の取得
        foreach ($contacts as $contact) {
            $contact['category_name'] = Category::where('id', $contact['category_id'])->value('content');
        }

        // Viewにデータを渡す（categories, contacts)
        return view('auth.admin', compact('categories', 'contacts'));
    }

    // 検索機能の実装
    public function search(Request $request)
    {
        $query = Contact::with('category');

        // 名前とメールアドレスの検索
        if(!empty($request->keyword)) {
            $query->KeywordSearch($request->keyword);
        }


        // 性別の検索
        if(!empty($request->gender)) {
            $query->GenderSearch($request->gender);
        }


        // お問い合わせの種類の検索
        if(!empty($request->category_id)) {
            $query->CategoryIdSearch($request->category_id);
        }

        // 日付の検索
        if(!empty($request->date)) {
            $query->DateSearch($request->date);
        }

        // 検索結果の取得
        $contacts = $query->get();
        $categories = Category::all();

        // 検索結果の表示
        return view('auth.admin', compact('contacts', 'categories'));
    }

    // お問い合わせの削除
    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin')->with('message', 'Contactを削除しました');
    }

}

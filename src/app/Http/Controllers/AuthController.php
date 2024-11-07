<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Support\Facades\Response;

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
        if (!empty($request->keyword)) {
            $query->KeywordSearch($request->keyword);
        }


        // 性別の検索
        if (!empty($request->gender)) {
            $query->GenderSearch($request->gender);
        }


        // お問い合わせの種類の検索
        if (!empty($request->category_id)) {
            $query->CategoryIdSearch($request->category_id);
        }

        // 日付の検索
        if (!empty($request->date)) {
            $query->DateSearch($request->date);
        }

        // 検索結果の取得してセッションに保存
        $contacts = $query->paginate(7);
        $categories = Category::all();
        session(['contacts' => $contacts]);

        // 検索結果の表示
        return view('auth.admin', compact('contacts', 'categories'));
    }

    // お問い合わせの削除
    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin')->with('message', 'Contactを削除しました');
    }

    // CSVへのエクスポート機能
    public function exportCsv(Request $request)
    {
        $query = Contact::with('category');

        // 名前とメールアドレスの検索
        if (!empty($request->keyword)) {
            $query->KeywordSearch($request->keyword);
        }

        // 性別の検索
        if (!empty($request->gender)) {
            $query->GenderSearch($request->gender);
        }

        // お問い合わせの種類の検索
        if (!empty($request->category_id)) {
            $query->CategoryIdSearch($request->category_id);
        }

        // 日付の検索
        if (!empty($request->date)) {
            $query->DateSearch($request->date);
        }

        $contacts = $query->get();

        // 一時的なメモリ上にファイルを作成
        $csvContent = fopen('php://temp', 'w');

        // CSVのヘッダー行を書き込み
        $headers = ['名前', 'メールアドレス', '性別', 'カテゴリー'];
        fputcsv($csvContent, array_map(function ($header) {
            return mb_convert_encoding($header, 'SJIS-win', 'UTF-8');  // Shift-JISに変換
        }, $headers));

        // データ行を書き込み
        foreach ($contacts as $contact) {
            $row = [
                $contact->last_name . " " . $contact->first_name,
                $contact->email,
                $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : ($contact->gender == 3 ? 'その他' : '')),
                $contact->category->content ?? '',
            ];

            // 各フィールドをShift-JISに変換してからCSVに書き込む
            fputcsv($csvContent, array_map(function ($field) {
                return mb_convert_encoding($field, 'SJIS-win', 'UTF-8');
            }, $row));
        }

        rewind($csvContent);  // ファイルの先頭にポインタを戻す

        // レスポンスを作成してCSVを返す
        return Response::stream(function () use ($csvContent) {
            fpassthru($csvContent);
        }, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=\"export_" . date('Ymd_His') . ".csv\"",
        ]);
    }
}

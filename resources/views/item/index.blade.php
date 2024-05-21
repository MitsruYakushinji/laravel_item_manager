<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品一覧ページ</title>
</head>
<body>
    <h1>商品一覧ページ</h1>
    <div class="main">
        {{-- サイドメニュー --}}
        <nav class="side-menu">
            <ul class="menu-list">
                <a href="{{ url('item') }}">
                    <li>商品一覧</li>
                </a>
                <a href="{{ url('item/add') }}">
                    <li>商品新規登録</li>
                </a>
                <a href="{{ url('profile') }}">
                    {{-- ログインユーザー --}}
                    <li>{{ Auth::user()->name }}</li>
                </a>
                <li>
                    <form action="{{ url('logout') }}" method="post">
                        @csrf
                        <input class="link-style-btn" type="submit" name="logout" value="ログアウト">
                    </form>
                </li>
            </ul>
        </nav>
    </div>
    <h2>商品検索</h2>
        <form action="{{ url('item') }}" method="get">
            <div>
                <input type="text" name="name" placeholder="商品名">
                <input type="text" name="price" placeholder="価格">
                <input type="submit" value="検索">
            </div>
            <div>
                <a href="{{ url('item') }}">リセット</a>
            </div>
        </form>
    <h2>商品一覧</h2>
    <div>
        <table>
            <thead>
                <tr>
                    <td>id</td>
                    <td>商品名</td>
                    <td>価格</td>
                    <td>在庫数</td>
                    <td>カテゴリ</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $key => $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ number_format($item->price) }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>
                            <form action="{{ url('item/stock/'. $item->id) }}" method="post">
                                @csrf
                                <input type="number" name="stock[{{ $key }}]" value={{ old("stock.$key") }}>
                                <input type="submit" name="in" value="入荷">
                                <input type="submit" name="out" value="出荷">
                            </form>
                            @error('stock.'.$key)
                                <div style="color:red">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <form action="{{ url('item/edit/'. $item->id) }}" method="get">
                                <input type="submit" value="編集">
                            </form>
                        </td>
                        <td>
                            <form action="{{ url('item/delete/'. $item->id) }}" method="post">
                                @csrf
                                <input type="submit" value="削除">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品編集ページ</title>
</head>
<body>
    <h1>商品編集ページ</h1>
    <form action="{{ url('item/edit/'. $item->id) }}" method="post">
        @csrf
        <div>
            <label>商品名</label>
        </div>
        <div>
            <input
                type="text"
                name="name"
                value="{{ $item->name }}"
                placeholder="商品名を入力">
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>価格</label>
        </div>
        <div>
            <input
                type="number"
                name="price"
                value="{{ $item->price }}"
                placeholder="価格を入力">
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label>カテゴリ</label>
        </div>
        <div>
            <select name="category_id">
                @foreach ($categories as $category)
                    @if ($category->id === $item->category_id)
                        <option value="{{ $category->id }}" selected>
                            {{ $category->name }}
                        </option>
                    @else
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endif
                @endforeach
                @error('category_id')
                    <div>{{ $message }}</div>
                @enderror
            </select>
        </div>
        <div>
            <input type="submit" name="send" value="更新">
        </div>
    </form>
    <div>
        <a href="{{ url('item') }}">戻る</a>
    </div>
</body>
</html>

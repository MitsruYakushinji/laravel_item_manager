<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理者新規登録ページ</title>
</head>
<body>
    <h1>管理者新規登録ページ</h1>
    <form action="{{ url('admins/add') }}" method="post">
        @csrf
        <div>
            <label>管理者名</label>
        </div>
        <div>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="管理者名を入力してください">
        </div>
        @error('name')
            {{ $message }}
        @enderror
        <div>
            <label>所属部署</label>
        </div>
        <div>
            <select name="department_id">
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ (int)old('category_id')===$category_id->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id')
                {{ $message }}
            @enderror
        </div>
        <div>
            <input type="submit" name="send" value="登録">
        </div>
    </form>
    <div>
        <a href="{{ url('admins') }}">戻る</a>
    </div>
</body>
</html>

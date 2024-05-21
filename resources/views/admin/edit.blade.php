<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理者編集ページ</title>
</head>
<body>
    <h1>管理者編集ページ</h1>
    <form action="{{ url('admins/edit/'. $admin->id) }}" method="post">
        @csrf
        <div>
            <label>管理者名</label>
        </div>
        <div>
            <input type="text" name="name" value="{{ $admin->name }}" placeholder="管理者名を入力">
        </div>
        <div>
            <label>所属部署</label>
        </div>
        <div>
            <select name="department_id">
                @foreach($departments as $department)
                    @if($department->id === $admin->department_id)
                        <option value="{{ $department->id }}" selected>
                            {{ $department->name }}
                        </option>
                    @else
                        <option value="{{ $department->id }}">
                            {{ $department->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
        <div>
            <input type="submit" name="send" value="更新">
        </div>
    </form>
    <a href="{{ url('admins') }}">戻る</a>
</body>
</html>

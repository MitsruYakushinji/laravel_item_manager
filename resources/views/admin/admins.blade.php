<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理者一覧ページ</title>
</head>
<body>
    <h1>管理者一覧ページ</h1>
    <div>
        <table>
            <thead>
                <tr>
                    <td>id</td>
                    <td>管理者名</td>
                    <td>所属部署</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->department->name }}</td>
                        <td>
                            <form action="{{ url('admins/edit/'. $admin->id) }}" method="get">
                                <input type="submit" value="編集">
                            </form>
                        </td>
                        <td>
                            <form action="{{ url('admins/delete/'. $admin->id) }}" method="post">
                                @csrf
                                <input type="submit" value="削除">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ url('admins/add') }}">新規登録</a>
    </div>
</body>
</html>

@section('sidebar')
<div class="sidebar">
    <h2>管理メニュー</h2>
    <ul class="menu-list">
        <li><a href="{{ url('item') }}"></a>商品一覧</li>
        <li><a href="{{ url('item/add') }}"></a>商品新規登録</li>
    </ul>
</div>
@endsection

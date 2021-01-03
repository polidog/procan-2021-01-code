@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ガチャ結果</div>

                    <div class="card-body">
                        <div style="text-align: center">
                            <img src="https://4.bp.blogspot.com/-F5qE4XwBojQ/V5NDtjF5RzI/AAAAAAAA8d0/2zxTHdEKxlQufC6UkcDc_-cdi7DUfBdwgCLcB/s250/capsule_close1_red.png" />
                        </div>
                        <div style="text-align: center">
                            「{{ $item->name }}」を取得しました!!!!
                        </div>
                        <a href="{{ url('/gacha') }}" class="btn btn-primary btn-block">戻る</a>
                        <a href="{{ url('/itemBox') }}" class="btn btn-primary btn-block">アイテムボックスへ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

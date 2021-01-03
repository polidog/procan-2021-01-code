@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">アイテムボックス</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($items as $item)
                                <div class="col-sm-6" style="margin-top: 14px;">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->item->name }}</h5>
                                            <a href="{{ route('itemBoxRemove', $item->id) }}" class="btn btn-danger">削除する</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/gacha') }}" class="btn btn-primary btn-block">ガチャへ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

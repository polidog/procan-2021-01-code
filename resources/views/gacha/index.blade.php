@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $gacha->name }}</div>

                    <div class="card-body">
                        <div style="width: 100%">
                            <img src="https://1.bp.blogspot.com/-sZbaFXJ4y0A/UnyGKAJjwbI/AAAAAAAAacE/RYDWRq73Hsc/s800/gachagacha.png" style="width: 100%; text-align: center"/>
                        </div>
                        @if ($isFull)
                            <div><a class="btn btn-primary btn-block disabled">ガチャを引く</a></div>
                            <div>
                                <a href="#">アイテムボックスへ</a>
                            </div>
                        @else
                            <a href="{{ url('/gacha', $gacha->id) }}" class="btn btn-primary btn-block">ガチャを引く</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

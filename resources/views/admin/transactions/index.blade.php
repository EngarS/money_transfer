@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Список транзакций</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Номер</th>
                                <th scope="col">Сумма</th>
                                <th scope="col">Дата транзакции</th>
                                <th scope="col">Перевёл</th>
                                <th scope="col">Получатель</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($transactions->count() > 0)
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td scope="row">{{$loop->iteration}}</td>
                                        <td>{{$transaction->id}}</td>
                                        <td>{{$transaction->money}}</td>
                                        <td>{{$transaction->date_start}}</td>
                                        <td>{{$transaction->recipient_user_id}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">
                                        <div class="text-center">
                                            <h3>Пока транзакций не было</h3>
                                        </div>

                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

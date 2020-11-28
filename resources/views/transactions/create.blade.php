@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Создать транзацию</div>

                    <div class="card-body">
                        <form action="{{route('transactions.store')}}">
                            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                            <div class="form-group">
                                <label for="inputMoney">Сумма перевода:</label>
                                <input type="number" class="form-control" id="inputMoney" name="money" required value="{{old('money')}}">
                            </div>
                            <div class="form-group">
                                <label for="userSelect">Кому:</label>
                                <select class="form-control" id="userSelect" name="recipient_user_id">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" @if($user->id == old('recipient_user_id')) selected @endif>{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" name="delay" value="0">
                                        <input type="checkbox" id="changeDelay" name="delay" value="1">
                                        Отложенный перевод
                                    </label>
                                </div>
                                <div id="dateTransfer" style="display: none;">
                                    <label for="dateStart">Когда выполнить перевод:</label>
                                    <input type="datetime-local" class="form-control" id="dateStart" name="date_start" value="{{old('date_start')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message">Комментарий</label>
                                <textarea class="form-control" id="message" rows="3" name="message" maxlength="255">{{old('message')}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Перевести</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        $(document).ready(function() {
            const checkbox = $('#changeDelay');
            const dateBlock = $('#dateTransfer');
            checkbox.on('click', function () {
                if ($(this).is(':checked')) {
                    dateBlock.show();
                    dateBlock.find('input').attr('required', true);
                } else {
                    dateBlock.hide();
                    dateBlock.find('input').attr('required', false);
                }
            })
        });
    </script>

@endsection

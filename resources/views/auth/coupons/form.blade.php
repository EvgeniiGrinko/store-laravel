@extends('auth.master')

@isset($coupon)
    @section('title', 'Редактировать купон № ' . $coupon->code)
@else
    @section('title', 'Создать купон')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($coupon)
            <h1>Редактировать купон N <b>{{ $coupon->code }}</b></h1>
        @else
            <h1>Добавить купон</h1>
        @endisset
        <form method="POST"
              @isset($coupon)
              action="{{ route('coupons.update', $coupon) }}"
              @else
              action="{{ route('coupons.store') }}"
            @endisset
        >
            <div>
                @isset($coupon)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="code" class="col-sm-2 col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'code'])
                        <input type="text" class="form-control" name="code" id="code"
                               value="@isset($coupon){{ $coupon->code }}@endisset">
                    </div>
                </div>
                    <br>
                    <div class="input-group row">
                        <label for="expired_at" class="col-sm-2 col-form-label">Истекат: </label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['fieldName' => 'expired_at'])
                            <input type="date" class="form-control" name="expired_at" id="expired_at"
                                   value="@isset($coupon->expired_at){{ $coupon->expired_at->format('Y-m-d') }}@endisset">
                        </div>
                    </div>
                <br>
                    <div class="input-group row">
                        <label for="value" class="col-sm-2 col-form-label">Номинал: </label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['fieldName' => 'value'])
                            <input type="text" class="form-control" name="value" id="value"
                                   value="@isset($coupon){{ $coupon->value }}@endisset">
                        </div>
                    </div>
                    <br>
                @foreach ([
                'only_once' => 'Купон используется только 1 раз',
                'type' => 'Абсолютное значение',
                ] as $field => $title)
                    <div class="form-group row">
                        <label for="code" class="col-sm-2 col-form-label">{{ $title }}: </label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="{{$field}}" id="{{$field}}"
                            @if(isset($coupon) && $coupon->$field === 1)
                                   checked="'checked"
                                @endif
                            >
                        </div>
                    </div>
                    <br>

                @endforeach
                    <div class="input-group row">
                        <label for="currency_id" class="col-sm-2 col-form-label">Валюта: </label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['fieldName' => 'currency_id'])
                            <select name="currency_id" id="currency_id" class="form-control">
                                <option value="">Без валюты</option>
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->id }}"
                                            @isset($coupon)
                                            @if($coupon->currency_id == $currency->id)
                                            selected
                                        @endif
                                        @endisset
                                    >{{ $currency->code }}</option>

                                @endforeach

                            </select>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="input-group row">
                        <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                        <div class="col-sm-6">
                            @include('auth.layouts.error', ['fieldName' => 'description'])
                            <textarea name="description" id="description" cols="72"
                                      rows="7">@isset($coupon){{ $coupon->description }}@endisset</textarea>
                        </div>
                    </div>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection

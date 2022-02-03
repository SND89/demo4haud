@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Products') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            @foreach ($invoices as $inv)
                                <div class="row">
                                    <hr>
                                    <h2>Invoice ID: {{ $inv->id }}</h2>
                                    <p>
                                    <div class="col-sm-2">
                                        <b>Invoice number:</b>
                                    </div>
                                    <div class="col-sm-10">
                                        {{ $inv->number }}
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Date:</b>
                                    </div>
                                    <div class="col-sm-10">
                                        {{ date('F j, Y, g:i a', strtotime($inv->date)) }}
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Paid:</b>
                                    </div>
                                    <div class="col-sm-10">
                                        {{ $inv->paid ? 'YES' : 'NO' }}
                                        <?php if ($inv->paid) { ?>
                                        <br>Payment ID: {{ $inv->payment_id }}
                                        <br>Payment Date: {{ $inv->payment_date }}
                                        <?php } ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Customer:</b>
                                    </div>
                                    <div class="col-sm-10">
                                        {{ $inv->customer->name }} ( {{ $inv->customer->email }} )
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Total items:</b>
                                    </div>
                                    <div class="col-sm-10">
                                        {{ $inv->item->count() }}
                                    </div>
                                    <div class="col-sm-2">
                                        <b>Sub Total:</b>
                                    </div>
                                    <div class="col-sm-10">
                                        ${{ $inv->total }}
                                    </div>
                                    <div class="col-sm-2">
                                        <b>TOTAL:</b>
                                    </div>
                                    <div class="col-sm-10">
                                        <b>${{ number_format($inv->discounted, 2) }}</b>
                                    </div>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

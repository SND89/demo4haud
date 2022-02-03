@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <h1>Here should be a nice dashboard :) </h1>
                        <hr>
                        <h4>Customers - everything is working, made with CRUD endpoints located in API (many things can be
                            improved and secured there)</h4>
                        <hr>
                        <h4>Products - Displayed as cards, data from DB and showed at least nicer than it is in DB</h4>
                        <hr>
                        <h4>Invoices - Just displayed after processed (apply discount and manipulate a bit data)</h4>
                        <hr>
                        <h4>DB - a better playground until frontend is ready :))</h4>
                    </div>
                </div>
            </div>
        </div>
    @endsection

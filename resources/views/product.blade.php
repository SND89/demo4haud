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
                            @foreach ($categor as $c)
                                <div class="row">
                                    <h3>{{ $c->name }}</h3>

                                </div>
                                <div class="row">
                                    @foreach ($c->product as $prod)
                                        <div class="card w-25">
                                            <img class="card-img-top" src="{{ $prod->image[0]->path }}"
                                                alt="{{ $prod->slug }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $prod->name }}</h5>
                                                <p class="card-text">{{ $prod->description }}</p>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Price: <b>${{ $prod->price }}</b></li>
                                                <li class="list-group-item">SKU: {{ $prod->sku }}</li>
                                                <li class="list-group-item">Stock: {{ $prod->stock()->sum('qty') }} PCS
                                                </li>
                                            </ul>
                                            <div class="card-body">
                                                <button type="button" class="btn btn-secondary">Check Product</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

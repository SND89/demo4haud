@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Customers') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <button type="button" class="btn btn-primary"
                            id="createCustomerBTN">{{ __('Create new user') }}</button>
                        <div class="row">
                            <form class="row g-3 needs-validation" id="fsearchcustomer" novalidate
                                action={{ route('customers.search-username', '') }}>
                                <input type="text" name="customerEditLink" id="customerEditLink"
                                    value={{ route('customers.update', '') }} hidden />
                                <input type="text" name="customerDeleteLink" id="customerDeleteLink"
                                    value={{ route('customers.destroy', '') }} hidden />
                                <div class="row mb-3">
                                    <label for="customerCodeI" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="customerCodeI" name="customerCodeI"
                                            required>
                                        <div class="invalid-feedback">
                                            Please provide a valid input.
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-primary" type="submit">Search customer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <table id="customersDT" class="display" width="100%"></table>
                        </div>
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODALS -->
    <div class="modal fade" id="editCustomerModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalCenterTitle">Edit customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3 needs-validation" id="fcreatecustomer" novalidate
                        action={{ route('customers.update', '') }}>
                        <input type="text" name="customerCreateLink" id="customerCreateLink"
                            value={{ route('customers.store') }} hidden />
                        <input type="text" name="idCCF" id="idCCF" hidden />
                        <input type="text" name="modeCCF" id="modeCCF" hidden />
                        <div class="row mb-3">
                            <label for="customerCodeI" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">
                                    Please provide a valid input.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="customerCodeI" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">
                                    Please provide a valid input.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="customerCodeI" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="username" name="username" required>
                                <div class="invalid-feedback">
                                    Please provide a valid input.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 form-check">
                            <div class="col-sm-12">
                                <input class="form-check-input" type="checkbox" value="" id="blocked" name="blocked">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Blocked
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="fcreateBTN">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

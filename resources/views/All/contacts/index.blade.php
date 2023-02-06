@extends('layouts.dashboard-master')

@section('title','Manage All Contacts')

@section('content')
    <section class="section">

        <div class="section-header">
            <h1 class="ml-2">Manage All Contacts</h1>
            <h1 class="ml-2">||</h1>
<button class="ml-2 btn btn-primary" onclick="history.back()">Return Back</button>
        <button class="ml-2 btn btn-outline-light" onclick="window.location.reload()"> Reload Page</button>





            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>
        @include('dashboard.common._alert_message')
        <div class="section-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Contacts <span>({{ $total }})</span></h4>
                                <div class="card-header-action">
{{--                                        <a href="{{route('my.accounts.contacts.create')}}"--}}
{{--                                           class="btn btn-primary"><i class="fas fa-plus"></i> Add New Contact</a>--}}

                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    @if(count($contacts)>0)
                                        <table class="table table-responsive-sm table-hover table-outline">
                                            <thead>
                                            <tr>
                                                <th>Contact Id</th>
                                                <th>Contact Name</th>
                                                <th>Contact Age</th>
                                                <th>Created On</th>
                                                <th>Created By</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($contacts as $contact)
                                                <tr>

                                                    <td>{{ $contact->Id }}</td>
                                                    <td>{{ $contact->Name }}</td>
                                                    <td>{{ $contact->AgeId }}</td>
                                                    <td>{{ $contact->CreatedOn }}</td>
                                                    <td>{{ $contact->CreatedBy }}</td>

                                                    <td>

                                                            <a href="{{route('all.accounts.contacts.edit',$contact->Id)}}"
                                                               class="btn btn-primary"><i class="fa fa-edit"> Update Contact</i>
                                                            </a>


                                                            <a href="{{route('accounts.contact.requests',$contact->Id)}}"
                                                               class="btn btn-warning"><i class="fa fa-edit">Service Requests</i>
                                                            </a>


                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="text-center p-3 text-muted">
                                            <h5>No Results</h5>
                                            <p>Looks like you have not added any users yet!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(count($contacts)>0)
                            <div class="text-center">
                                {{ $contacts->links() }}
{{--                                 {{ $contacts->appends(Request::except('page'))->links() }}--}}
                            </div>
                        @endif
                    </div>
                </div>

        </div>
    </section>
@endsection

{{--@section('scripts')--}}
{{--    @include('dashboard.common._modal_delete')--}}
{{--@endsection--}}

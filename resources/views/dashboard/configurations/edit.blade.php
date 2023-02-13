@extends('layouts.dashboard-master')

@section('title','Edit Configuration Value')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Exam Round</h1>
            <div class="section-header-breadcrumb">
                @include('dashboard.common._breadcrumbs')
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('dashboard.common._alert_message')
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Configuration Value</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped text-center">
                                    <tbody>
                                    <tr>
                                        <th>Key</th>
                                        <th>Edit Value</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bolder">{{$configuration->key}}</td>
                                        <td>
                                            <form method="POST"
                                                  action="{{ route('dashboard.configurations.update',$configuration->id) }}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="value"
                                                       value="{{old('value',$configuration->value)}}"
                                                       class="form-control @error('value') is-invalid @enderror">
                                                @error('value')
                                                <div class="invalid-feedback">
                                                    <p>{{ $errors->first('value') }}</p>
                                                </div>
                                            @enderror
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

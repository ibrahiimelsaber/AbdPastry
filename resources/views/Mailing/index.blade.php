@include('layouts.header');
@extends('layouts.left_nav')
<div class='content-wrapper'>
    <section class="content-header">
        <h1>
            Mailing List
        </h1>

    </section>
    <section class="content">
        @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- /.row -->
        <div class="row">
            @include('Mailing.filter')
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{{URL::to('mailing/create')}}" class="btn btn-primary">Create Mailing List</a>
                        <!--<div class=form-group>
                            <a href="{{ URL::to('accounts/create') }}" class="btn btn-primary">Create New Account</a>
                        </div>-->
                        <div class="box-tools">
                                
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-hover" >
                            <thead>
                                             <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Sub Type</th>
                                <th>Sub Type 2</th>
                                <th>Status</th>
                                <th>Brand</th>
                                <th>Service Center</th>
                                <th>mail subject</th>
                            </tr>
                            </thead>
                            @foreach($items as $item)
                            
                            <tr>
                                <td><a href="{{ URL::to('mailing/'.$item->Id.'/edit') }}" class="btn btn-primary" >{{ $item->Id }}</a></td>
                                <td>{{$item->type}}</td>     
                                <td>{{$item->subType}}</td>    
                                <td>{{$item->subType2}}</td>
                                <td>{{$item->status}}</td>
                                <td>{{$item->brand}}</td>
                                <td>{{$item->branch}}</td>
                                <td>{{$item->subject}}</td>

                            </tr>

                            @endforeach



                        </table>
                        <center>{{ $items->links() }}</center>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


            </div>
        </div>
    </section>


</div>

@extends('layouts.footer')
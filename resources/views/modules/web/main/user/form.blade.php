@extends('layouts.master')

@section('title')
Create Users
@endsection

@section('title_content')
Form Users
@endsection

@section('content')
<!--Basic forms-->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-heading panel-heading-divider">Create Form<span class="panel-subtitle">This is the default
                    bootstrap form layout</span></div>
            <div class="panel-body">
                @foreach ($errors->all() as $message)
                        {{$message}}
                @endforeach
                <form action="/store-users" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group xs-pt-10">
                        <label>Name*</label>
                        <input type="text" name="name" placeholder="Enter Name" required class="form-control">
                    </div>
                    <div class="form-group xs-pt-10">
                        <label>Username*</label>
                        <input type="text" placeholder="Enter Username" name="username" required class="form-control">
                    </div>
                    <div class="form-group xs-pt-10">
                        <label>Email address</label>
                        <input type="email" placeholder="Enter email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" placeholder="Phone" required class="form-control">
                    </div>
                    <div class="row xs-pt-15">
                        <div class="col-xs-6">
                            <div class="be-checkbox">
                                <input id="check1" type="checkbox">
                                <label for="check1">Remember me</label>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <p class="text-right">
                                <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                <button class="btn btn-space btn-default">Cancel</button>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

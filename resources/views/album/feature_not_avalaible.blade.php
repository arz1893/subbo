@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">You're accessing from IOS</span>
                        <p>We're deeply sorry, creating album from IOS currently not avalaible, we're working on it soon</p>
                    </div>
                    <div class="card-action">
                        <a href="{{ route('album.index') }}">
                            <i class="fa fa-arrow-left"></i> Go back to my album
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
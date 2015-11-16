@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4 text-center">
                @if (Session::has('status'))
                    <div class="pre">
                        <h4>Whoops!</h4>
                        <p>{{ Session::get('status') }}</p>
                    </div>
                @endif


                    {!! Former::open()->route('entries.update', $instance->id) !!}

                    @include('entries._form')

                    <button class="hive-btn"><i class="fa fa-check-circle"></i> Update entry</button>
                    {!! Former::close() !!}

            </div>
        </div>
    </div>
@stop
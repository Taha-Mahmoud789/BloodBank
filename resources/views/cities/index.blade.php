@extends('adminlte::page')
@inject('governorate','App\Models\Governorate')
@php
    $governorates = $governorate->pluck('name','id')->toArray();
@endphp
@section('content')

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Cities</h3>
                <div class="box-header">
                    {{-- Use Spatie HTML to generate the form --}}
                    {!! html()->form('GET')->open() !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! html()->text('name', request()->input('name'))
                                    ->placeholder('City Name')
                                    ->class('form-control') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! html()->select('governorate_id', $governorates, request()->input('governorate_id'))
                                    ->class('select2 form-control')
                                    ->placeholder('Choose a governorate') !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! html()->submit('Search')
                                    ->class('btn btn-primary btn-block') !!}
                            </div>
                        </div>
                    </div>
                    {!! html()->form()->close() !!}
                </div>
            </div>
            <div class="box-body">
                <div class="box-header mb-3">
                    <a href="{{ route('cities.create') }}" class="btn btn-success">
                        <i class="fa fa-plus"></i> Add City
                    </a>
                </div>
                @include('flash::message')
                @if(count($records))
                    <div class="table table-striped table-bordered">
                        <table class="table table-bordered">
                            <thead style="background-color: #3C8DBC; color:#ffffff;">
                            <tr>
                                <th>#</th>
                                <th class="text-center">City</th>
                                <th class="text-center">governorate</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
                                <tr id="removable{{ $record->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $record->name }}</td>
                                    <td class="text-center">{{ $record->governorate->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('cities.edit', $record->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {{-- Use Spatie HTML for the delete button --}}
                                        <form action="{{ route('cities.destroy', $record->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this governorate?');">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!! $records->links() !!}
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <strong>No Data Found</strong>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

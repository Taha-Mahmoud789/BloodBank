@extends('adminlte::page')
{{--@inject('donation','App\Models\DonationRequest')--}}
@section('title', 'Donations Management')
@section('content_header')
    <h1>Donations</h1>
@stop
@section('content')
    <section class="content">
        <div class="box">
            <div class="box-body">
                @include('flash::message')
                @if(count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>patient_name</th>
                                <th>patient_age</th>
                                <th> bags </th>
                                <th>hospital_name</th>
                                <th>hospital_address</th>
                                <th>patient_phone</th>
                                <th>city</th>
                                <th >bloodType</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($records as $record)
{{--                                @dd($records);--}}
                                <tr id="removable{{$record->id}}">
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td class="text-center">{{$record->patient_name}}</td>
                                    <td class="text-center">{{$record->patient_age}}</td>
                                    <td class="text-center">{{$record->bags}}</td>
                                    <td class="text-center">{{$record->hospital_name}}</td>
                                    <td class="text-center">{{$record->hospital_address}}</td>
                                    <td class="text-center">{{$record->patient_phone}}</td>
                                    <td class="text-center">{{optional($record->city)->name}}</td>
                                    <td class="text-center">{{optional($record->bloodType)->name}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('donations.edit', $record->id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        {{-- Use Spatie HTML for the delete button --}}
                                        <form action="{{ route('donations.destroy', $record->id) }}" method="POST" style="display:inline-block;">
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
                        <div class="pagination-wrapper" style=" display: flex;
                                justify-content: center;
                                margin-top: 20px;">
                            {{ $records->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                @else
                    <p class="text-center">No donations!!</p>
                @endif
            </div>
        </div>
    </section>
@endsection

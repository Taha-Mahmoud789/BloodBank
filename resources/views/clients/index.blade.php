@extends('adminlte::page')
@section('content')
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Clients</h3>
            </div>
            <div class="box-body">
                <div class="filter">
                    <form method="GET" action="">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                                           class="form-control" placeholder="بحث بالاسم ورقم الهاتف والايميل">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <select name="blood_type_id" class="form-control">
                                    <option value="">بحث بفصيلة الدم</option>
                                    @foreach (App\Models\BloodType::pluck('name','id')->toArray() as $id => $name)
                                        <option
                                            value="{{ $id }}" {{ request('blood_type_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">بحث</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @include('flash::message')
                @if (count($records))
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>birth_date</th>
                                <th>Phone</th>
                                <th>Blood Type</th>
                                <th>last_donation_date</th>
                                <th>City</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($records as $record)

                                <tr id="removable{{ $record->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $record->name }}</td>
                                    <td>{{ $record->email }}</td>
                                    <td>{{ $record->d_o_b }}</td>
                                    <td>{{ $record->phone }}</td>
                                    <td class="text-center" style="direction: ltr">
                                        {{optional($record->bloodType)->name}}
                                    </td>
                                    <td>{{ $record->donation_last_date}}</td>
                                    <td>{{ optional($record->city)->name }}</td>
                                    <td class="text-center">
                                        @if ($record->is_active)
                                            <a href="{{ url(route('clients.toggle-activation', $record->id)) }}"
                                               class="btn btn-danger btn-xs">إلغاء التفعيل</a>
                                        @else
                                            <a href="{{ url(route('clients.toggle-activation', $record->id)) }}"
                                               class="btn btn-success btn-xs">تفعيل</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('clients.destroy', $record->id) }}" method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this governorate?');">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <strong>No Clint Found</strong>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

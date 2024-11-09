@extends('adminlte::page')
@section('content')
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit City</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('cities.update', $city->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">City Name</label>
                        <input type="text" name="name" value="{{ $city->name }}" class="form-control" required>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="governorate_id">Governorate</label>
                        <select name="governorate_id" class="form-control" required>
                            <option value="">Select Governorate</option>
                            @foreach($governorates as $id => $name)
                                <option value="{{ $id }}" {{ $city->governorate_id == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('governorate_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update City</button>
                </form>
            </div>
        </div>
    </section>
@endsection

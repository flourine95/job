@extends('layout.master')

@section('content')
    <div class="container-fluid">
        <form id="form-filter">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">Role
                        <select class="custom-select mb-3 select-filter" name="role" id="role">
                            <option selected>All</option>
                            @foreach ($roles as $key => $value)
                                <option value="{{ $value }}" @if ($value == $selectedRole) selected @endif>
                                    {{ ucfirst(strtolower($key)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">Company
                        <select class="custom-select mb-3 select-filter" name="company" id="company">
                            <option selected>All</option>
                            @foreach ($companies as $key => $value)
                                <option value="{{$key }}" @if ($key == $selectedCompany) selected @endif>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">City
                        <select class="custom-select mb-3 select-filter" name="city" id="city">
                            <option selected>All</option>
                            @foreach ($cities as $city)
                                <option value="{{$city}}"
                                        @if ($city == $selectedCity) selected @endif>{{ ucfirst(strtolower($city)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">Clear
                        <br>
                        <button type="button" id="clear-filters" class="btn btn-secondary">Clear Filters</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-striped table-centered mb-0">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Role</th>
            <th>Gender</th>
            <th>City</th>
            <th>Company</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>
                    <a href="{{ route('admin.users.show', $user->id) }}">
                        {{ $user->id }}
                    </a>
                </td>
                <td class="table-user">
                    <img src="{{ $user->avatar }}" alt="table-user" class="mr-2 rounded-circle"/>
                    {{ $user->name }}
                </td>
                <td>
                    <a href="tel:{{ $user->phone }}">
                        {{ $user->phone }}
                    </a>
                </td>
                <td>
                    <a href="mailto:{{ $user->email }}">
                        {{ $user->email }}
                    </a>
                </td>
                <td>
                    @if ($user->role == 0)
                        <span class="badge badge-danger">{{ $user->role_name }}</span>
                    @elseif($user->role == 1)
                        <span class="badge badge-primary">{{ $user->role_name }}</span>
                    @else
                        <span class="badge badge-success">{{ $user->role_name }}</span>
                    @endif
                </td>
                <td>
                    {{ $user->gender_name }}
                </td>
                <td>
                    {{ $user->city }}
                </td>
                <td>
                    {{ optional($user->company)->name }}
                </td>
                <td class="table-action">
                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"><i class="mdi mdi-delete"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <nav>
        <ul class="pagination pagination-rounded mb-0">
            {{ $users->links() }}
        </ul>
    </nav>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(".select-filter").change(function () {
                $("#form-filter").submit();
            });
            $('#clear-filters').click(function () {
                const url = new URL(window.location.href);
                url.searchParams.delete('role');
                url.searchParams.delete('company');
                url.searchParams.delete('city');
                window.location.href = url.toString();
            });
        });
    </script>
@endpush

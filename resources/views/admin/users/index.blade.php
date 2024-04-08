@extends('layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <form class="form-horizontal" id="form-filter">
                    <div class="form-group">Role
                        <select class="custom-select mb-3 select-filter" name="role" id="role">
                            <option selected>All</option>
                            @foreach($roles as $role => $value)
                                <option value="{{ $value }}">{{ucfirst(strtolower($role))}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" id="option3">
                    <label class="form-check-label" for="option3">Option 3</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option" id="option4">
                    <label class="form-check-label" for="option4">Option 4</label>
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="option5">
                    <option value="">All</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                </select>
            </div>
        </div>
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
        @foreach($users as $user)
            <tr>
                <td>
                    <a href="{{route('admin.users.show', $user->id)}}">
                        {{$user->id}}
                    </a>
                </td>
                <td class="table-user">
                    <img src="{{$user->avatar}}" alt="table-user" class="mr-2 rounded-circle"/>
                    {{$user->name}}
                </td>
                <td>
                    <a href="tel:{{$user->phone}}">
                        {{$user->phone}}
                    </a>
                </td>
                <td>
                    <a href="mailto:{{$user->email}}">
                        {{$user->email}}
                    </a>
                </td>
                <td>
                    @if($user->role == 0)
                        <span class="badge badge-danger">{{$user->role_name}}</span>
                    @elseif($user->role == 1)
                        <span class="badge badge-primary">{{$user->role_name}}</span>
                    @else
                        <span class="badge badge-success">{{$user->role_name}}</span>
                    @endif
                </td>
                <td>
                    {{$user->gender_name}}
                </td>
                <td>
                    {{$user->city}}
                </td>
                <td>
                    {{optional($user->company)->name}}
                </td>
                <td class="table-action">
                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                    <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <nav>
        <ul class="pagination pagination-rounded mb-0">
            {{$users->links()}}
        </ul>
    </nav>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(".select-filter").change(function () {
                $("#form-filter").submit();
            });

        });
    </script>
@endpush

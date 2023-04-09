@extends('admin.layouts.main')

@section('title', 'User List')

@section('content')
    <!-- PAGE CONTAINER-->
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                 @if( session('deleteSuccess'))
                    <div class="alert alert-warning alert-dismissible fade show col-3 offset-9" role="alert">
                        <div><i class="fa-solid fa-circle-check"></i>  {{ session('deleteSuccess') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-md-12">
                 <div class="table-responsive table-responsive-data2">
                    <div class="fs-3 my-2">User Total-{{ $users->total() }}</div>
                    <table class="table table-data2" id='dataTable'>
                        <thead>
                            <tr class="">
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($users as $user)
                                <tr>
                                    <input type="hidden" name="userId" id='userId' value="{{ $user->id }}">
                                    <td class="col-2">
                                        @if ($user->image==null)
                                            @if ($user->gender=='male')
                                                <img src="{{ asset('admin/images/icon/user-male.jpg') }}" class=" imgtdumbnail shadow-sm" >
                                            @else
                                                <img src="{{ asset('admin/images/icon/user.webp') }}" class=" imgtdumbnail shadow-sm" >
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.$user->image) }}" class="imgtdumbnail shadow-sm" >
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <select name="role" class="form-control">
                                            <option value="user" @if($user->role=='user') selected @endif>user</option>
                                            <option value="admin" @if($user->role=='admin') selected @endif>admin</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('admin#userAccDelete',$user->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="ban">
                                                     <i class="fa-solid fa-ban"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="mt-3">{{ $users->links() }}</div>
                </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            // change role process
            $('.form-control').change(function(){
                $parentNode=$(this).parents('tr'),
                $role=$parentNode.find('.form-control').val();
                $userId=$parentNode.find('#userId').val();
                $data={
                    'userId':$userId,
                    'role':$role
                }
                console.log($data);

                $.ajax({
                    type:'get',
                    url:'http://127.0.0.1:8000/admin/userList/userRoleChange',
                    data:$data,
                    dataType:'json',
                    success:function(){

                    }
                })
                location.reload();
            })
        })
    </script>
@endsection


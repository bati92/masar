    
@extends('backend.layout.app')

@section('content')

<!-- main page content body part -->
<div id="main-content">
    <div class="container-fluid">
        @if(session()->has('message'))
        <div class="alert alert-success" 
            style="
            position: absolute;
            z-index: 99999;
            top: 10%;
            left: 30%;
            width: 50%;">
        {{ session()->get('message') }}
        </div>
        @endif
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Project Board</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Project Board</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action">
                            <a href="javascript:void(0);" data-toggle="modal" class="btn btn-primary" data-target="#createmodal" ><i class="fa fa-add">إضافة طلب تطبيق جديد</i></a>
                        </div>
                        <div class="p-2 d-flex">
                        </div>
                    </div>
                </div>
            </div>    
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>طلبات التطبيقات</h2>
                        </div>
                        <div class="body project_report">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom mb-0">
                                    <thead>
                                        <tr> 
                                            <th>اسم التطبيق</th>
                                            <th>اسم المستخدم</th>
                                            <th>عدد</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($appOrders as $key => $appOrder)
                                        <tr>
                                            <td class="project-title">
                                                <h6>{{$appOrder->app_id}}</h6>
                                            </td>
                                            <td>{{$appOrder->user_id}}</td>
                                            <td>{{$appOrder->count}}</td>
                                            <td class="project-actions">
                                                <a href="#defaultModal" data-toggle="modal" data-target="#defaultModal">
                                                <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary"><i class="icon-eye"></i></a>
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#editModal{{$appOrder->id}}" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a  href="javascript:void(0);" data-toggle="modal" data-target="#deleteModal{{$appOrder->id}}" class="btn btn-sm btn-outline-danger" ><i class="icon-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-------------create--------->
<div class="modal fade" id="createmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabelcreate">إضافة طلب تطبيق جديد</h4>
            </div>
            <div class="modal-body"> 
                <form method="Post" action="{{ route('app-order.store') }}" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" required placeholder="اسم التطبيق" name="app_id" aria-label="app_id" aria-describedby="basic-addon2">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" required placeholder="اسم المستخدم" name="user_id" aria-label="user_id" aria-describedby="basic-addon2">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" required placeholder="عدد" name="count" aria-label="count" aria-describedby="basic-addon2">
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="app_id" value="1" />
                    <input type="hidden" name="user_id" value="1" />
                    <!-- <input type="hidden" name="transfer_money_firm" value="1" /> -->
                    <div class="modal-footer">   
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="#" class="btn btn-secondary">الغاء الأمر</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--------------delete -------------->
@foreach ($appOrders as $key => $appOrder)
<div class="modal fade" id="deleteModal{{$appOrder->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabeldelete">هل أنت بالتاكيد تريد الحذف </h4>
            </div>
            <div class="modal-body"> 
              <form action="{{ route('app-order.destroy', $appOrder->id) }}" method="POST">
               @csrf
               @method('DELETE')
               <input type="hidden" name="_token" value="{{ csrf_token() }}" />
               <!-- <input type="hidden" name="transfer_money_firm" value="1" /> -->

               <div class="modal-footer">
                   <button type="submit" class="btn btn-primary">نعم</button>
                   <a href="#" class="btn btn-secondary">الغاء الأمر</a>
               </div>
               </form>
            </div> 
        </div>
    </div>
</div>
@endforeach

<!--------------edit -------------->
@foreach ($appOrders as $key => $appOrder)
<div class="modal fade" id="editModal{{$appOrder->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabeledit">تعديل معلومات طلب التطبيق </h4>
            </div>
            <div class="modal-body"> 
                <form method="POST" action="{{ route('app-order.update',  $appOrder->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{$appOrder->app_id}}" required placeholder="اسم التطبيق" name="app_id" aria-label="app_id" aria-describedby="basic-addon2">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{$appOrder->user_id}}" required placeholder="اسم المستخدم" name="user_id" aria-label="user_id" aria-describedby="basic-addon2">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{$appOrder->count}}" required placeholder="عدد" name="count" aria-label="count" aria-describedby="basic-addon2">
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <!-- <input type="hidden" name="transfer_money_firm" value="1" /> -->

                    <div class="modal-footer"> 
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="#" class="btn btn-secondary">الغاء الأمر</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection
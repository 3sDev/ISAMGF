
@extends('adminlayoutenseignant.layout')
@section('title', 'قائمة الأعداد ')
@section('contentPage')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="{{ url('dashboards') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Notes Professionnelles</li>
            </ol>
        </div><!-- /.col -->
        <div class="col-sm-6 float-right">
            <h3 class="text-right"> قائمة الأعداد </h3>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@inject('uploads', 'App\Libs\Urlupload')
@foreach($uploads->getLinks() as $upload)
@endforeach

<link rel="stylesheet" href="{{ URL::asset('css/components.css') }}" />
<style>
.textable {
   overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   -webkit-line-clamp: 1; /* number of lines to show */
   -webkit-box-orient: vertical;
}
</style>

    <div class="row">
        @if (session('message'))
        <h5>{{ session('message') }}</h5>
            @endif
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('notes/create') }}" class="btn btn-primary float-right">Ajouter</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-right" width="5%">فسخ</th>
                                <th  class="text-right"width="5%">تعديل</th>
                                <th class="text-right">العدد المهني</th>
                                <th class="text-right">المواظبة</th>
                                <th class="text-right">المثابرة</th>
                                <th class="text-right">العلاقات والمظهر</th>
                                <th class="text-right">كيفية العمل</th>
                                <th class="text-right">كمية العمل</th>
                                <th class="text-right">الرتبة</th>
                                <th class="text-right">الإسم واللقب</th>
                                <th class="text-right">ع.ر</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notes as $element)
                            
                            <tr>
                                <td class="text-center">
                                    <form action="{{ url('delete-note/'.$element->id) }}" onsubmit="return confirm('Are you sure to delete this data?')">
                                        <button type="submit" class="btn btn-link btn-danger btn-just-icon remove btn-sm"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    {{-- <a href="{{ url('show-missions/'.$element->id) }}" class="btn btn-link btn-info btn-just-icon like btn-sm"><i class="nav-icon fas fa-eye"></i></a> --}}
                                    <a href="{{ url('edit-note/'.$element->id) }}" class="btn btn-link btn-warning btn-just-icon edit btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                                <td class="text-center">{{ $element->note1+$element->note2+$element->note3+$element->note4+$element->note5 }}/100</td>
                                <td class="text-center">{{ $element->note5 }}/20</td>
                                <td class="text-center">{{ $element->note4 }}/20</td>
                                <td class="text-center">{{ $element->note3 }}/20</td>
                                <td class="text-center">{{ $element->note2 }}/20</td>
                                <td class="text-center">{{ $element->note1 }}/20</td>
                                <td class="text-right">{{ substr($element->personnel->poste, strrpos($element->personnel->poste, '/') + 1) }}</td>
                                <td class="text-right">{{ $element->personnel->nom_ar.' '.$element->personnel->prenom_ar }}</td>
                                <td class="text-center"><span>{{ $element->personnel->id }}</span></td>
                            
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection
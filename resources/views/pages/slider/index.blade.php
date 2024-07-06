@extends('layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    {{ session('error') }}
                </div>
            @elseif(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <h5><i class="icon fas fa-check"></i> Success</h5>
                    {{ session('success') }}
                </div>
            @endif
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Slider</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Slider</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">Add
                                Slider</a>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Is Published</th>
                                        <th>Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($sliders->count() > 0)
                                        @foreach ($sliders as $key => $slider)
                                            <tr>
                                                <td>{{ ($sliders->currentPage() - 1) * $sliders->perPage() + $loop->iteration }}
                                                </td>
                                                <td>{{ $slider->title }}</td>
                                                <td>{{ $slider->content }}</td>
                                                <td>{{ $slider->is_published }}</td>
                                                <td>{{ $slider->product_id }}</td>
                                                <td class="action-form">
                                                    <a href="{{ route('admin.sliders.edit', ['id' => $slider->id]) }}"
                                                        class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                                    <button type="button" class="btn btn-danger delete-modal"
                                                        id="{{ $slider->id }}" data-toggle="modal"
                                                        data_action_url="{{ route('admin.sliders.destroy', ['id' => $slider->id]) }}"
                                                        data-target="#modal_danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">Empty slider</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Is Published</th>
                                        <th>Product</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="pagination-area">
                                {{ $sliders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_danger">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete slider</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure delete slider ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <form action="" id="delete_form" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="slider_id" id="slider_id">
                            <button type="submit" class="btn btn-outline-light">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

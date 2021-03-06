@extends('dashboard')
@section('title'){{$pageTitle}} | {{$subTitle}} @endsection
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Movie Attributes</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard.index')}}"><i
                                            class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin.movies.view')}}">All Movies</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add movie attributes</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="{{route('admin.movies')}}" class="btn btn-sm btn-neutral">New</a>
                        <a href="#" class="btn btn-sm btn-neutral">Filters</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">{{$movie->title}}</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{route('admin.movies.view')}}" class="btn btn-sm btn-primary">Movies</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                @include('backend.partials.flash')
                <form action="{{route('admin.movies.add.attributes')}}" method="post" enctype="multipart/form-data"
                      role="form">
                    @csrf
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="genres">Select an Attribute</label>
                                    <select name="attribute_id"
                                            class="form-control-sm @error('attribute_id') is-invalid @enderror"
                                            id="genres">
                                        @foreach($attributes as $attribute)
                                            <option value="{{$attribute->id}}"> {{$attribute->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('attribute_id') {{ $message }} @enderror
                                    <input type="hidden" name="movies_id" value="{{$movie->id}}">
                                </div>
                            </div>
                        </div>
                        <h3> Add attributes to movie</h3>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="values">Select a value</label>
                                    <select name="day" class="form-control-sm @error('day') is-invalid @enderror"
                                            id="values">
                                        @foreach($attribute_values->values as $values)
                                            <option value="{{$values->value}}"> {{$values->value}}</option>
                                        @endforeach
                                    </select>
                                    @error('day') {{ $message }} @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Showing time</label>
                                    <input type="time" id="input-username"
                                           class="form-control form-control-sm @error('time') is-invalid @enderror"
                                           name="time" value="{{old('time')}}">
                                    @error('time') {{$message}} @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username1">Ticket Price</label>
                                    <input type="text" id="input-username1"
                                           class="form-control form-control-sm @error('ticket_price') is-invalid @enderror"
                                           name="ticket_price" value="{{old('ticket_price', $movie->ticket_price)}}">
                                    @error('ticket_price') {{$message}} @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username1">Auditorium</label>
                                    <input type="text" id="input-username1"
                                           class="form-control form-control-sm @error('auditorium') is-invalid @enderror"
                                           name="auditorium" value="{{old('auditorium')}}">
                                    @error('auditorium') {{$message}} @enderror
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username11">Tickets Available</label>
                                    <input type="number" id="input-username11" min="1"
                                           class="form-control form-control-sm @error('tickets_avail') is-invalid @enderror"
                                           name="tickets_avail" value="{{old('tickets_avail')}}">
                                    @error('tickets_avail') {{$message}} @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-icon btn-primary" type="submit">
                                <span class="btn-inner--icon"><i class="ni ni-like-2"></i></span>
                                <span class="btn-inner--text">Save</span>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-0">All Attribute values</h3>
                        <p class="text-sm mb-0">
                            This table shows all attribute values for selected attribute available in our DB
                        </p>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-dark table-flush" id="datatable-buttons">
                            <thead class="thead-dark">
                            <tr>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Auditorium</th>
                                <th>Price</th>
                                <th>Tickets Available</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Auditorium</th>
                                <th>Price</th>
                                <th>Tickets Available</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($movie_values->attributes as $mov_val)
                            <tr>
                                <td>{{$mov_val->day}}</td>
                                <td>{{$mov_val->time}}</td>
                                <td>{{$mov_val->auditorium}}</td>
                                <td>{{$mov_val->ticket_price}}</td>
                                <td>{{$mov_val->tickets_avail}}</td>
                                <td>
                                    <a href="{{route('admin.movies.edit.attributes', $mov_val->id)}}"
                                       class="btn btn-sm btn-neutral"><i class="fa fa-edit"></i></a>

                                    <a href="{{route('admin.movies.delete.attributes', $mov_val->id)}}"
                                       class="btn btn-sm btn-neutral"><i class="ni ni-fat-remove"></i></a>
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

@endsection
@push('scripts')
    <script src="{{asset('backend/js/app.js')}}"></script>
@endpush



@extends('admin.layouts.main')

@section('title', 'Product Edit Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                           <div>
                                <div class="ms-3 mb-4 mt-2">
                                        <i class="fa-solid fa-arrow-left-long" onclick="history.back()"></i>
                                </div>
                           </div>
                            <div class="card-title">
                                <h3 class="text-center title-2 py-3">Product Detail</h3>
                                <hr>
                            </div>

                            <form action="{{ route('product#editProcess') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <div class="">
                                            <img src="{{ asset('storage/'.$edit->image) }}"  class="img-thumbnail" style="width: 400px;height:300px"/>
                                        </div>

                                        <div class="mt-3">
                                            <input type="file" name="pizzaImage" id="" class='form-control @error('pizzaImage') is-invalid @enderror'>
                                            @error('pizzaImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-dark col-12" type="submit"><i class="fa-solid fa-arrow-up-from-bracket pe-2 "></i>Updade</button>
                                        </div>

                                    </div>

                                    <div class="col-5 offset-1">
                                        <div class="">
                                            <input type="hidden" name="pizzaId" value="{{ $edit->id }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza name..." value="{{ old('pizzaName',$edit->name) }}">
                                             @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                         <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="text" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price..." value="{{ old('pizzaPrice',$edit->price) }}">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category </label>
                                            <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror" value="">
                                                <option value="">Choose category...</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}" @if ($edit->category_id==$c->id) selected @endif> {{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                             @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" cols="30" rows="5" placeholder="Enter Description..." class=" form-control @error('pizzaDescription') is-invalid @enderror">{{ old('pizzaDescription',$edit->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="text" class="form-control " aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time..." value="{{ old('pizzaWaitingTime',$edit->waiting_time) }}" >
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">View</label>
                                            <input id="cc-pament" name="view" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ old('view',$edit->view_count) }}" disabled>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection

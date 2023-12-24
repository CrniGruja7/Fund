@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-3">All funds</h1>
    <div class="row">
        <div class="col-3">
            <div class="bg-primary-subtle border boreder-black p-1">
                <form action="{{ route('home')}}" method="GET">
                    <select name="cat" class="form-control">
                        <option value="" disabled selected hidden>Choose by: FundCategoryName</option>
                        @foreach ($fundCategory as $category)
                            <option value="{{$category->id}}"{{(isset(request()->cat)) && request()->cat == $category->id ? "selected" : ""}} >{{$category->name}}</option>
                        @endforeach
                    </select>    
                    <button type="submit" class="btn btn-success form-control">Search</button>
                </form>
            </div>
            <br>
            <div class="">
                <a class="btn btn-primary form-control" href="{{ route('favorites')}}">Favorites</a>
            </div>  
        </div>
        <div class="col-9">
            <div class="mb-2">
                <form action="{{ route('home') }}" method="GET">
                    <div class="form-control">
                        <input type="text" name='search' class="form-control" placeholder="Search by FundName, ISIN or WKN">
                    </div>
                    <button type="submit" class="btn btn-primary form-control">Search</button>
                </form>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>FundName</th>
                    <th>FundCotegoryName</th>
                    <th>FundSubCategoryName</th>
                    <th>ISIN</th>
                    <th>WKN</th>
                    <th>Favorites</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($funds as $fund)
                    <tr>
                        <th>{{$fund->id}}</th>
                        <td>{{$fund->name}}</td>
                        <td>{{$fund->fundCategory->name}}</td>
                        <td>{{$fund->fundSubCategory->name}}</td>
                        <td>{{$fund->ISIN}}</td>
                        <td>{{$fund->WKN}}</td>
                        <form action="{{ route('favoritesAdd', ['id'=>$fund->id]) }}" method="POST">
                            @csrf
                            <td><button type="submit" class="btn btn-warning">Add</button></td>
                        </form>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="d-flex justify-content-center">
                {{$funds->appends(request()->input())->links("pagination::bootstrap-5")}}
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            @endif
            @if (session()->has('info'))
                <div class="alert alert-success">
                    {{session()->get('info')}}
                </div>
            @endif
        </div>
    </div>
    </div>
@endsection

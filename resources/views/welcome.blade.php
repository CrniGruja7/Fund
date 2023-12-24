@extends('master')

@section('main')
    <h1 class="mb-3">All funds</h1>
    <div class="row">
        <div class="col-12">
          <div class="mb-2">
            <form action="{{ route('welcome') }}" method="GET">
                <div class="form-control">
                    <input type="text" name='search' class="form-control" placeholder="Search by FundName, ISIN or WKN">
                    <button type="submit" class="btn btn-secondary form-control">Search</button>
                </div>
            </form>
        </div>
            <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>FundName</th>
                  <th>ISIN</th>
                  <th>WKN</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($funds as $fund)
                <tr>
                  <th>{{$fund->id}}</th>
                  <td>{{$fund->name}}</td>
                  <td>{{$fund->ISIN}}</td>
                  <td>{{$fund->WKN}}</td>
                  </tr>
                @endforeach           
              </tbody>
            </table>
            <div class="d-flex justify-content-center">
              {{$funds->links("pagination::bootstrap-5")}}
          </div>
        </div>
    </div>
@endsection
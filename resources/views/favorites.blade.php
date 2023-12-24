@extends('master')

@section('main')
    <h1 class="mb-3">All favorites</h1>
    <div class="row">
        <div class="col-12">
            <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>FundName</th>
                  <th>FundCategoryName</th>
                  <th>FundSubCategoryName</th>
                  <th>ISIN</th>
                  <th>WKN</th>
                  <th>Download PDF</th>
                  <th>Download XSLX</th>
                  <th>Download XML</th>
                  <th>Remove</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($favorites as $favorite)
                <tr>
                    <th>{{$favorite->fund->id}}</th>
                    <td>{{$favorite->fund->name}}</td>
                    <td>{{$favorite->fund->fundCategory->name}}</td>
                    <td>{{$favorite->fund->fundSubCategory->name}}</td>
                    <td>{{$favorite->fund->ISIN}}</td>
                    <td>{{$favorite->fund->WKN}}</td>
                    <td>
                        @if($favorite->fund->pdfAvailable()) {{-- U koliko postoji u modelu --}}
                        <a href="{{ route('generatePdf', ['id' => $favorite->id]) }}">download</a>
                        @else
                        PDF not available
                        @endif
                    </td>
                    <td>
                        @if($favorite->fund->xlsxAvailable()) {{-- U koliko postoji u modelu --}}
                            <a href="{{ route('generateXlsx', ['id' => $favorite->id]) }}">download</a>
                        @else
                            XLSX not available
                        @endif
                    </td>
                    <td>
                        @if($favorite->fund->xmlAvailable()) {{-- U koliko postoji u modelu --}}
                            <a href="{{ route('generateXml', ['id' => $favorite->id]) }}">download</a>
                        @else
                            XML not available
                        @endif
                    </td>
                    <form action="{{ route('remove', ['id'=>$favorite->fund->id]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <td><button type="submit" class="btn btn-danger">Remove</button></td>
                    </form>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @endif
@endsection
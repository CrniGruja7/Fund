
    <h1 class="mb-3">Fund Pdf</h1>
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
                </tr>
              </thead>
              <tbody>
                <tr>
                    <th>{{$fund->id}}</th>
                    <td>{{$fund->name}}</td>
                    <td>{{$fund->fundCategory->name}}</td>
                    <td>{{$fund->fundSubCategory->name}}</td>
                    <td>{{$fund->ISIN}}</td>
                    <td>{{$fund->WKN}}</td>
                </tr>
              </tbody>
            </table>
        </div>
    </div>

@include('templates/app')
<?php $statusList = [
    ['status2','Duke u punuar'],
    ['status','Në proces'],
    ['status3','Ka perfunduar'],
    ['status4','Eshte ndalur']
];
$paymentName = ['Fakture','Pro fakture','Cash/Card']
?>
<link rel="stylesheet" href="styling/projektetstyle.css">
<div class="container">
    <div class="secondContainer">
        <div class="firstPart">
            <div class="searchContainer">
                <i class="fa fa-search fa-lg" aria-hidden="true" id="searchIcon"></i>
                <input type="text" placeholder="Kërko listën e produkteve në projekte" class="search">
            </div>
            <button class="shtoButton">
                <h3 class="plus">+</h3>
                <h3 class="shtoTxt">Shto</h3>
            </button>
        </div>
        @foreach($projects as $project)

            <div class="accordion" id="accordionExample">
                <div class="projectCotainer" data-toggle="collapse" aria-controls="collapseOne"
                     data-target="#collapseOne">
                    <div class="project">
                        <h3 class="projectNumber"><?=$project['id']?></h3>
                        <h3 class="projectDesc">{{$project['name']}}/ {{$project['created_at']  }}</h3>
                        <div class="{{$statusList[$project['stage_id']][0]}}">
                            <h5 class="statusText">{{$statusList[$project['stage_id']][1]}}</h5>
                        </div>
                        <h3 class="totali">Totali i shpenzuar</h3>
                        <h4 class="totalCost">230.05</h4>
                    </div>
                </div>
                </h2>
                <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Titulli</th>
                                    <th>Lloji</th>
                                    <th>Data</th>
                                    <th>Përshkrimi</th>
                                    <th>Totali</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @foreach($project['invoice'] as $invoice)
                                        <td>{{$invoice['id']}}</td>
                                        <td>{{$invoice['name']}}</td>
                                        <td>{{$paymentName[$invoice['payment_type_id']]}}</td>
                                        <td>{{$invoice['due_date']}}</td>
                                        <td>{{$invoice['description']}}</td>
                                        <td>${{$invoice['ammount']}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>

            @endforeach
        </div>

        </div>
    </div>
</div>


























<?php /*
{{--<a href="/newproject" class="btn btn-success float-right">Krijo projekt</a>--}}
{{--<button onclick="ShowCreateForm()" class="btn btn-success float-right">Krijo projekt</button>--}}
{{--<div id="createFormContainer"></div>--}}
{{--<div style="margin-top:5vh;">--}}
{{--    @foreach($projects as $project)--}}

{{--        <a href="/projects/{{$project['id']}}" class="-none" style="color: #2b3035; text-decoration:none;">--}}
{{--            <div>--}}
{{--                <span class="col-md-4"><?=$project['name'];?> | <?=$project['created_at'];?></span>--}}
{{--                <span class="col-md-3 col-5"><?=$project['stage']['name']?></span>--}}
{{--                <span class="col-md-4 col 8">Totali i shpenzuar: <span style="color:teal"><?=$project['total']?></span></span>--}}
{{--            </div>--}}
{{--        </a>--}}
{{--        <hr>--}}
{{--    @endforeach--}}
{{--</div>--}}

{{--        <script>--}}
{{--            function ShowCreateForm(){--}}
{{--                formHtml = '<form action="/project/new" method="POST">\n' +--}}
{{--                    '<input type="text" placeholder="Emri i projektit" name="name">\n' +--}}
{{--                    '@CSRF'+--}}
{{--                    '<button type="submit" >Krijo</button>\n' +--}}
{{--                    '</form>'--}}
{{--            document.getElementById('createFormContainer').innerHTML=formHtml;--}}
{{--            }--}}

{{--        </script>--}}

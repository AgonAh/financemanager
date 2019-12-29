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
            <button type="button" class="shtoButton" data-toggle="modal" data-target="#exampleModalCenter">
                    Shto
                </button>
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Shtoni një projekt</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="/project/new" method="POST">
                        @csrf
                        <input type="text"  class="form-control col-md-4" placeholder="Emri i projektit" name="name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Mbyll</button>
                        <button type="submit" class="btn btn-primary">Shtoni projektin</button>
                        </form>
                    </div>
                    </div>
                </div>
                </div>

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
                        <h4 class="totalCost">€<?=$project['total']?></h4>
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
                                    <th>Veprimi</th>
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
                                        <td><button class="btn btn-secondary" onclick="addMessage({{$invoice['id']}},`{{$invoice['message']}}`)">Shto koment</button>
                                            <div id="commentSpace{{$invoice['id']}}"></div>
                                        </td>
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

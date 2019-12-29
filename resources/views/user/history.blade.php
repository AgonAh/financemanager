@include('/templates/app')
<?php $paymentName = ['Fakture','Pro fakture','Cash/Card'] ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 table-responsive">
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
                    @foreach($invoices as $invoice)
                    <td>{{$invoice['id']}}</td>
                    <td>{{$invoice['name']}}</td>
                    <td>{{$paymentName[$invoice['payment_type_id']]}}</td>
                    <td>{{$invoice['due_date']}}</td>
                    <td>{{$invoice['description']}}</td>
                    <td>${{$invoice['ammount']}}</td>

                    <td><button class="btn btn-secondary" onclick="addMessage({{$invoice['id']}},`{{$invoice['message']}}`)">Shto koment</button>
                        <div id="commentSpace{{$invoice['id']}}"></div>
                        @if($invoice['approved']==2)
                            <form action="/resubmitInvoice" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$invoice['id']}}">
                                <button type="submit" class="btn btn-dark">Ri-dergo</button>
                            </form>
                        @endif
                    </td>

                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>




























<?php /*
{{--@foreach($invoices as $invoice)--}}
{{--    <?php--}}
{{--    $lloji = '';--}}
{{--    switch ($invoice['payment_type_id']){--}}
{{--        case 0:--}}
{{--            $lloji='Fakture';--}}
{{--            break;--}}
{{--        case 1:--}}
{{--            $lloji='Pro fakture';--}}
{{--            break;--}}
{{--        case 2:--}}
{{--            $lloji='Cash/Card';--}}
{{--            break;--}}
{{--    }--}}


{{--    if($invoice['approved']!=''){--}}
{{--        if($invoice['approved']==1)--}}
{{--            $approvedClass = 'bg-success';--}}
{{--        else--}}
{{--            $approvedClass = 'bg-danger';--}}
{{--    }--}}
{{--    else{--}}
{{--        $approvedClass = 'bg-primary';--}}
{{--    }--}}
{{--    ?>--}}
{{--    <div class="{{$approvedClass}}">--}}

{{--    <?php if(isset($invoice['document'])) echo 'Doc exists'; ?>--}}

{{--    <h2><?=$invoice['name']?> <?php if(isset($invoice['project'])) echo ' | Per projektin: '.$invoice['project']['name'];?> </h2>--}}
{{--    <h4>Shuma: <?=$invoice['ammount']?></h4>--}}
{{--    <small style="color: papayawhip">Lloji i faktures: <?=$lloji;?> | Data e krijimit: <?= $invoice['created_at'] ?> | Data e skadimit: <?= $invoice['due_date'] ?></small><br>--}}
{{--        <span style="color:whitesmoke"><?= $invoice['description'] ?></span>--}}



{{--    <br>--}}
{{--    <hr>--}}
{{--    </div>--}}
{{--@endforeach--}}

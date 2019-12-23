@include('/templates/app')
<?php $invoices[2]['approved']=1;?>
<?php $invoices[1]['approved']=2;?>
@foreach($invoices as $invoice)
    <?php
    $lloji = '';
    switch ($invoice['payment_type_id']){
        case 0:
            $lloji='Fakture';
            break;
        case 1:
            $lloji='Pro fakture';
            break;
        case 2:
            $lloji='Cash/Card';
            break;
    }


    if($invoice['approved']!=''){
        if($invoice['approved']==1)
            $approvedClass = 'bg-success';
        else
            $approvedClass = 'bg-danger';
    }
    else{
        $approvedClass = 'bg-primary';
    }
    ?>
    <div class="{{$approvedClass}}">

    <?php if(isset($invoice['document'])) echo 'Doc exists'; ?>

    <h2><?=$invoice['name']?> <?php if(isset($invoice['project'])) echo ' | Per projektin: '.$invoice['project']['name'];?> </h2>
    <h4>Shuma: <?=$invoice['ammount']?></h4>
    <small style="color: papayawhip">Lloji i faktures: <?=$lloji;?> | Data e krijimit: <?= $invoice['created_at'] ?> | Data e skadimit: <?= $invoice['due_date'] ?></small><br>
        <span style="color:whitesmoke"><?= $invoice['description'] ?></span>



    <br>
    <hr>
    </div>
@endforeach

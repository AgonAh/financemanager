@include('templates.app')

<div class="container" style="margin-top:2.5%;">
<div class="d-flex justify-content-center">
    <a href="/admin/newinvoices">
        <div class="d-flex text-center" style="border:2px solid purple; width: 10vw; height: 10vw; margin-right: 5vw; border-radius: 180px; color: #333;">
            <h3 class="my-auto mx-auto" style=" color: #333;"><?=$newinvoices?><br>Te reja</h3>
        </div>
    </a>

    <a href="/admin/approvedinvoices">
        <div class="d-flex text-center" style="border:2px solid #34C500; width: 10vw; height: 10vw; margin-right: 5vw; border-radius: 180px;">
            <h3 class="my-auto mx-auto" style=" color: #333;"><?=$approvedinvoices?><br>Aprovuar</h3>
        </div>
    </a>

    <a href="/admin/resubmittedinvoices">
        <div class="d-flex text-center" style="border:2px solid blue; width: 10vw; height: 10vw; margin-right: 5vw; border-radius: 180px">
            <h3 class="my-auto mx-auto" style=" color: #333;">{{$resubmittedInvoices}}<br>Re-derguar</h3>
        </div>
    </a>

    <a href="/admin/urgentinvoices">
        <div class="d-flex text-center" style="border:2px solid darkred; background-color: lightcoral; width: 10vw; height: 10vw; border-radius: 180px">
            <h3 class="my-auto mx-auto " style=" color: #333;"><?=$urgentinvoices?><br>Urgjent</h3>
        </div>
    </a>
</div>

<div  style="margin-top: 8vh;">

<!-- <div class="d-flex justify-content-center">
<?php $dates = ['Janar','Shkurt','Mars','Prill','Maj','Qershor','Korrik','Gusht','Shtator','Tetor','Nentor','Dhjetor']; ?>
<?php
$d = date('m');
for($i=0;$i<12;$i++){
    if($d > 11)
        $d=0;
    ?>
<button onclick="loadInvoices({{$d+1}})">{{$dates[$d]}}</button>
<?php
    $d++;
}
?>
</div> -->
<div id="invoiceSpace">

</div>
</div>
</div>
<script>
    loadInvoices(<?=date("m")?>);
    function loadInvoices(id){
        console.log(id);
        $('#invoiceSpace').load('/admin/loadInvoicesApi/'+id);

    }
</script>

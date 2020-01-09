@include('templates.app')

<div class="container" style="margin-top:2.5%;">
<div class="d-flex justify-content-center">
    <a href="/admin/newinvoices">
        <div class="d-flex text-center" style=" border:1px solid purple; width: 10vw; height: 10vw; margin-right: 5vw; border-radius: 180px; color: #333;">
            <h3 class="my-auto mx-auto" style=" color: #333; font-size: 1.4rem;"><?=$newinvoices?><br>Te reja</h3>
        </div>
    </a>

    <a href="/admin/approvedinvoices">
        <div class="d-flex text-center" style="border:1px solid #34C500; width: 10vw; height: 10vw; margin-right: 5vw; border-radius: 180px;">
            <h3 class="my-auto mx-auto" style=" color: #333; font-size: 1.4rem;"><?=$approvedinvoices?><br>Aprovuar</h3>
        </div>
    </a>

    <a href="/admin/resubmittedinvoices">
        <div class="d-flex text-center" style="border:1px solid blue; width: 10vw; height: 10vw; margin-right: 5vw; border-radius: 180px">
            <h3 class="my-auto mx-auto" style=" color: #333; font-size: 1.4rem;">{{$resubmittedInvoices}}<br>Re-derguar</h3>
        </div>
    </a>

    <a href="/admin/urgentinvoices">
        <div class="d-flex text-center" style="border:1px solid red; background-color: #FFB3B3; width: 10vw; height: 10vw; border-radius: 180px;">
            <h3 class="my-auto mx-auto " style=" color: white; font-size: 1.4rem;"><?=$urgentinvoices?><br>Urgjent</h3>
        </div>
    </a>
</div>

<div  style="margin-top: 8vh;">
<?php /*
<!-- <div class="d-flex justify-content-center">
<?php $dates = ['Janar','Shkurt','Mars','Prill','Maj','Qershor','Korrik','Gusht','Shtator','Tetor','Nentor','Dhjetor']; ?>
<?php
$d = date('m');
for($i=0;$i<12;$i++){
    if($d > 11)
        $d=0;
    ?>
<?php
    $d++;
}
?>
</div> -->
*/?>
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

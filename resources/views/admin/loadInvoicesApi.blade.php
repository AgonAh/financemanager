

<div>
    <table class="table">
        <thead>
        <!-- <tr>
        <th style="width:100%; color: white; background: #076FFF">Faturat</th>
        </tr> -->
        <div style="width:100%; height:7vh; color: white; background: #076FFF"><h3 style="padding-top:0.7%; padding-left:1%">Fakturat</h3></div>
        <tr style="background: #B5D4FF">
            <th scope="col">Nr</th>
            <th scope="col">Titulli</th>
            <th scope="col">Projekti</th>
            <th scope="col">Data</th>
            <th scope="col">Shuma</th>
            <th scope="col">Veprimi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <?php
            $bgColor = '';
//<<<<<<< HEAD
            if($invoice['approved']==1) $bgColor = 'background-color:#6DD16A; color:white;';
            else if($invoice['due_date']<date("Y-m-d") && $invoice['approved']!=0) $bgColor = 'background-color:#FF4D4D; color:white;';
            else if($invoice['due_date']<date("Y-m-d",time()+259200)) $bgColor = 'background-color:lightcoral;';
//=======
            if($invoice['approved']==1) $bgColor = 'background-color:#4EB64B; color:white;';
            else if($invoice['due_date']<date("Y-m-d") && $invoice['approved']!=0) $bgColor = 'background-color:#FF4D4D; color:white;';
            else if($invoice['due_date']<date("Y-m-d",time()+259200)) $bgColor = 'background-color:#FF8888;';
//>>>>>>> 304de0488962e6e169b7994151ade266dd1328e5
            ?>
            <tr style="<?=$bgColor?> ">
                <td><?=$invoice['id']?></td>
                <td><?=$invoice['name']?></td>
                <td><?php if(isset($invoice['project'])) echo $invoice['project']['name'];?></td>
                <td><?=$invoice['due_date']?></td>
                <td><?=$invoice['ammount']?></td>
                <td >
                    @if($invoice['approved']==0)
                        <form action="/admin/approve" method="POST" style="display:inline">
                            @csrf
                            <input type="hidden" name="invoiceId" value="<?=$invoice['id']?>">
                            <button type="submit" class="btn btn-success">Aprovo</button>
                        </form>
                        <form action="/admin/decline" method="POST" style="display:inline">
                            @csrf
                            <input type="hidden" name="invoiceId" value="<?=$invoice['id']?>">
                            <button class="btn btn-danger">Refuzo</button>
                        </form>
                    @endif
                        <button class="btn btn-secondary" onclick="addMessage({{$invoice['id']}},`{{$invoice['message']}}`)">Shto koment</button>
                        <div id="commentSpace{{$invoice['id']}}"></div>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>




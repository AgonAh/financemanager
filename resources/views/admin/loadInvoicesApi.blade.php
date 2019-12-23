<div>
    <table class="table">
        <thead>
        <tr>
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
            if($invoice['approved']==1) $bgColor = 'background-color:olivedrab; color:white;';
            if($invoice['due_date']<date("Y-m-d") && $invoice['approved']!=0) $bgColor = 'background-color:darkred; color:white;';
            else if($invoice['due_date']<date("Y-m-d",time()+259200)) $bgColor = 'background-color:lightcoral;';

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
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>

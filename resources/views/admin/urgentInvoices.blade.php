@include('templates.app')
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
                if($invoice['due_date']<date("Y-m-d")) $bgColor = 'background-color:darkred; color:white;';
                else $bgColor = 'background-color:lightcoral;'
            ?>
            <tr style="<?=$bgColor?> ">
                <td><?=$invoice['id']?></td>
                <td><?=$invoice['name']?></td>
                <td><?php if(isset($invoice['project'])) echo $invoice['project']['name'];?></td>
                <td><?=$invoice['due_date']?></td>
                <td><?=$invoice['ammount']?></td>
                <td >
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
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>

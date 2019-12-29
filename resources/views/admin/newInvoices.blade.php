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
        <tr>
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
                <button class="btn btn-secondary" onclick="addMessage({{$invoice['id']}},`{{$invoice['message']}}`)">Shto koment</button>
                <div id="commentSpace{{$invoice['id']}}"></div>
            </td>
        </tr>
        </tbody>
        @endforeach
    </table>
</div>

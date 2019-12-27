

@include('templates.app')
<div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nr</th>
            <th scope="col">Titulli</th>
            <th scope="col">Data</th>
            <th scope="col">Shuma</th>
            <th scope="col">Veprimi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($project['invoice'] as $invoice)
            <tr>
                <td><?=$invoice['id']?></td>
                <td><?=$invoice['name']?></td>
                <td><?=$invoice['due_date']?></td>
                <td><?=$invoice['ammount']?></td>
                <td>
{{--                    TODO:: Add resubmit function if the invoice has been declined --}}
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>

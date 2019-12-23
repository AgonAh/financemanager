@include('/templates/app')

<div class="container">
<form action="/invoice/create" method="POST" enctype="multipart/form-data">
    @csrf
    <div style="margin-bottom: 15vh"></div>



    <div style="margin-bottom: 6vh; vertical-align: center">
        <input type="text" name="name" placeholder="Titulli" class="form-control col-md-4 col-1 d-inline-block">
        <div class="form-group col-md-4 col-5 d-inline-block">
            <input type="hidden" name="payment_type" id="PT" value="0">
            <button type="button" onclick="setPT(0);">Fakture</button>
            <button type="button" onclick="setPT(1);">Pro Fakture</button>
            <button type="button" onclick="setPT(2);">Cash/Card</button>
        </div>

        <div class="form-group col-md-3 col-9 d-inline-block">
            <label for="project">Shtoni kete fakture ne kete projekt</label>
            <select name="project_id" class="form-control">
                <option value="NULL">none</option>
{{--                <option value="1">db generated 1</option>--}}
{{--                <option value="8">db generated 2</option>--}}
                @foreach($projects as $project)
                    <option value="<?=$project['id']?>"><?= $project['name']?></option>
                @endforeach
            </select>
        </div>
    </div>


<div class="form-group">
    <input type="number" name="ammount" id="moneyAdded" placeholder="Parate qe kam shpenzuar" class="form-control col-md-4 d-inline-block" onchange="updateTotal()">
    <input type="text" name="description" placeholder="Shto specifikime per kete shpenzim" class="form-control col-md-4 d-inline-block">
    <input type="date" name="due_date" class="form-control col-md-3 d-inline-block">
</div>
    <label for="file">Bashkangjit dokument te skenuar:</label><br>
    <input type="file" name="document">
    <br>
<div style="margin-top: 6vh"></div>
    <span >Totali i parave te shpenzuara:</span><br>
    <H2 id="total">0,00 Euro</H2>
<button type="submit">Submit</button>
</form>
</div>


<script>
    function setPT(val){
        document.getElementById('PT').value=val;
    }

    function updateTotal(){
        document.getElementById('total').innerHTML=document.getElementById('moneyAdded').value;
    }
</script>

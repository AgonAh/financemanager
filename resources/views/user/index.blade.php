@include('templates.app')
<form action="/invoice/create" method="POST" enctype="multipart/form-data">
    @csrf

<style>
.wrapper {
    margin: 0 auto;
    max-width: 72.5%;
}

</style>

<div class="wrapper">
    <div class="secondContainer">
        <div class="firstPart">
            <h2 class="hellotext">Përshëndetje {{Auth::user()->name}}, a doni të shtoni fatura të reja!</h2>
            <h2 class="infoMessage">Mësoni nëse keni nevojë për kontratë</h2>
        </div>
        <div class="secondPart">
            <h3 class="shtoFaturen">Shto kete fakture ne kete projekt</h3>
            <h3 class="menyraPageses">Regjistroni mënyrën e pagesës</h3>
            <ul class="pagesa">
                <li>
                    <input type="radio" id="fatura" name="payment_type" checked value="1" />
                    <label for="fatura"><i class="fa fa-address-card-o" aria-hidden="true"></i>Fakturë</label>
                </li>
                <li>
                    <input type="radio" id="profatura" name="payment_type" value="2"/>
                    <label for="profatura"><i class="fa fa-clone" aria-hidden="true"></i></i>Pro Faturë</label>
                </li>
                <li>
                    <input type="radio" id="cashCard" name="payment_type" value="3"/>
                    <label for="cashCard"><i class="fa fa-credit-card" aria-hidden="true"></i></i>Cash/Card</label>
                </li>
            </ul>
            <div class="btn-group">
                <input type="text" class="form-control" placeholder="Projektet" aria-label="Projektet"
                       aria-describedby="basic-addon1" id="projectsField">
                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <input type="hidden" name="project_id" value="NULL" id="project_id">
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" onclick="setProject('NULL','')">None</a>
                    @foreach($projects as $project)
                        <a class="dropdown-item" href="#" onclick="setProject('{{$project['id']}}','{{$project['name']}}')">{{$project['name']}}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="thirdPart">
            <h3 class="infoShpenzimetTxt">Informacion rreth shpenzimeve</h3>
            <div class="addBill" id="addBill">
                <i class="fa fa-money fa-2x" aria-hidden="true" id="firstIcon"></i>
                <input type="number" class="billInput" id="ammountInput" onchange="updateTotal()" placeholder="Paratë që kam shpenzuar" name="ammount">
                <i class="fa fa-window-maximize fa-2x" aria-hidden="true" id="secondIcon"></i>
                <input type="text" class="billInput" placeholder="Shto specifika për këtë shpenzim" name="description">
                <i class="fa fa-calendar fa-2x" aria-hidden="true" id="thirdIcon"></i>
                <input type="date" class="billInput" placeholder="Data e skadimit të faturës" name="due_date">
                <button class="addBillButton" onclick="addNewBill()">+</button>
            </div>
            <div id="newContent"></div>
        </div>
        <div class="fourthPart">
            <button class="shtoDokument" type="button" onclick="document.getElementById('uploadDocument').click();" id="fileBtn">Shto dokument të skenuar</button>
                <input type="file" style="display:none" id="uploadDocument" name="document">

            <h2 class="totalMoneyTxt">Totali i parave të shpenzuara</h2>
            <h2 class="totalMoney" id="totalMoney">0,00 Euro</h2>
            <i class="fa fa-money fa-2x" aria-hidden="true" id="firstIcon"></i>
            <button class="dergo" type="submit"><i class="fa fa-sign-out fa-2x" aria-hidden="true" id="exitIcon"></i>
                <h3>Dergo</h3>
            </button>
        </div>
    </div>
</div>
</form>
<script>

    $("#fileBtn").bind("click", function () {
        $("#uploadDocument").trigger("click");
    });

    function addNewBill() {

        const newDiv = document.createElement('div')
        newDiv.className = 'addBill';
        newDiv.innerHTML = `<i class="fa fa-money fa-2x" aria-hidden="true" id="firstIcon"></i>
                    <input type="text" class="billInput" placeholder="Paratë që kam shpenzuar">
                    <i class="fa fa-window-maximize fa-2x" aria-hidden="true" id="secondIcon"></i>
                    <input type="text" class="billInput" placeholder="Shto specifika për këtë shpenzim">
                    <i class="fa fa-calendar fa-2x" aria-hidden="true" id="thirdIcon"></i>
                    <input type="text" class="billInput" placeholder="Data e skadimit të faturës">
                    <button class="addBillButton" onclick="addNewBill()">+</button>`;

        document.getElementById('newContent').appendChild(newDiv)
    }

    function setProject(id,name){
        document.getElementById('project_id').value=id;
        document.getElementById('projectsField').value=name;
        console.log(document.getElementById('project_id').value);
    }

    function updateTotal(){
        document.getElementById('totalMoney').innerHTML= document.getElementById('ammountInput').value+' Euro';
    }
</script>








































<?php /*
{{--@include('/templates/app')--}}

{{--<div class="container">--}}
{{--<form action="/invoice/create" method="POST" enctype="multipart/form-data">--}}
{{--    @csrf--}}
{{--    <div style="margin-bottom: 15vh"></div>--}}



{{--    <div style="margin-bottom: 6vh; vertical-align: center">--}}
{{--        <input type="text" name="name" placeholder="Titulli" class="form-control col-md-4 col-1 d-inline-block">--}}
{{--        <div class="form-group col-md-4 col-5 d-inline-block">--}}
{{--            <input type="hidden" name="payment_type" id="PT" value="0">--}}
{{--            <button type="button" onclick="setPT(0);">Fakture</button>--}}
{{--            <button type="button" onclick="setPT(1);">Pro Fakture</button>--}}
{{--            <button type="button" onclick="setPT(2);">Cash/Card</button>--}}
{{--        </div>--}}

{{--        <div class="form-group col-md-3 col-9 d-inline-block">--}}
{{--            <label for="project">Shtoni kete fakture ne kete projekt</label>--}}
{{--            <select name="project_id" class="form-control">--}}
{{--                <option value="NULL">none</option>--}}
{{--                <option value="1">db generated 1</option>--}}
{{--                <option value="8">db generated 2</option>--}}
{{--                @foreach($projects as $project)--}}
{{--                    <option value="<?=$project['id']?>"><?= $project['name']?></option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--<div class="form-group">--}}
{{--    <input type="number" name="ammount" id="moneyAdded" placeholder="Parate qe kam shpenzuar" class="form-control col-md-4 d-inline-block" onchange="updateTotal()">--}}
{{--    <input type="text" name="description" placeholder="Shto specifikime per kete shpenzim" class="form-control col-md-4 d-inline-block">--}}
{{--    <input type="date" name="due_date" class="form-control col-md-3 d-inline-block">--}}
{{--</div>--}}
{{--    <label for="file">Bashkangjit dokument te skenuar:</label><br>--}}
{{--    <input type="file" name="document">--}}
{{--    <br>--}}
{{--<div style="margin-top: 6vh"></div>--}}
{{--    <span >Totali i parave te shpenzuara:</span><br>--}}
{{--    <H2 id="total">0,00 Euro</H2>--}}
{{--<button type="submit">Submit</button>--}}
{{--</form>--}}
{{--</div>--}}


{{--<script>--}}
{{--    function setPT(val){--}}
{{--        document.getElementById('PT').value=val;--}}
{{--    }--}}

{{--    function updateTotal(){--}}
{{--        document.getElementById('total').innerHTML=document.getElementById('moneyAdded').value;--}}
{{--    }--}}
{{--</script>--}}

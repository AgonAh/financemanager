@include('templates/app')
{{--<a href="/newproject" class="btn btn-success float-right">Krijo projekt</a>--}}
<button onclick="ShowCreateForm()" class="btn btn-success float-right">Krijo projekt</button>
<div id="createFormContainer"></div>
<div style="margin-top:5vh;"
    @foreach($projects as $project)
        <div>
            <span class="col-md-4"><?=$project['name'];?> | <?=$project['created_at'];?></span>
            <span class="col-md-3 col-5"><?=$project['stage']['name']?></span>
            <span class="col-md-4 col 8">Totali i shpenzuar: <span style="color:teal"><?=$project['total']?></span></span>
        </div>
        <hr>
    @endforeach
</div>

        <script>
            function ShowCreateForm(){
                formHtml = '<form action="/projectCreate">\n' +
                    '<input type="text" placeholder="Emri i projektit" name="name">\n' +
                    '<button type="submit" >Krijo</button>\n' +
                    '</form>'
            document.getElementById('createFormContainer').innerHTML=formHtml;
            }

        </script>

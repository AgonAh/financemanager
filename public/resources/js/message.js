function addMessage(id,msg){
    if(document.getElementById('commentSpace'+id).innerHTML!=''){
        document.getElementById('commentSpace'+id).innerHTML='';
        return;
    }

    inn = `
            <form id="messageForm`+id+`">
                <input type="hidden" value="`+id+`" name="id">
                <textarea name="message" class="form-control col-md-8" id="msgField`+id+`">`+msg+`</textarea>
                <button type="button" class="btn btn-primary" onclick="submitMsg(`+id+`)">Ruaje</button>
            </form>
        `;

    document.getElementById('commentSpace'+id).innerHTML=inn;

}

function submitMsg(id){

    $.post('/updateInvoiceMessage',$('#messageForm'+id).serialize());
    document.getElementById('commentSpace'+id).innerHTML='';

}

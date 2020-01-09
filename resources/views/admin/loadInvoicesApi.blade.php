<style>
    .shtoKoment {
        border: 0px;
        background:#f9f9f9;
        width: 7vw;
        height:3.5vh;
        font-size: 0.9rem;
        border-radius: 3px;
    }

    .shtoKoment:focus {
        outline: none;
    }

    .konfirmoButton {
        border: 0px;
        background:#88FB97;
        width: 7vw;
        height:3.5vh;
        font-size: 0.9rem;
        border-radius: 3px;
    }

    .konfirmoButton:focus {
        outline: none;
    }

    .refuzonButton {
        border: 0px;
        background:#FE6060;
        width: 7vw;
        height:3.5vh;
        font-size: 0.9rem;
        border-radius: 3px;
    }

    .refuzonButton:focus {
        outline: none;
    }

    .veprimiSpan button{
        float:right;
        height:3vh;
    }

</style>

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
            if($invoice['approved']==1);
            else if($invoice['due_date']<date("Y-m-d") && $invoice['approved']!=0) $bgColor = 'background-color:#FF4D4D; color:white;';
            else if($invoice['due_date']<date("Y-m-d",time()+259200)) $bgColor = 'background-color:#EDB9BF;';
            ?>
            <tr style="<?=$bgColor?> ">
                <td><?=$invoice['id']?></td>
                <td><?=$invoice['name']?></td>
                <td><?php if(isset($invoice['project'])) echo $invoice['project']['name'];?></td>
                <td><?=$invoice['due_date']?></td>
                <td>
                    @if($invoice['document']!="")
                        <a href="/store/{{$invoice['document']}}" target="_blank"><?=$invoice['ammount']?></a>
                    @else
                        <?=$invoice['ammount']?>
                    @endif
                </td>
                <td >
                    <span class="veprimiSpan">
                    @if($invoice['approved']==0)

                            <form action="/admin/approve" method="POST" style="display:inline">
                                @csrf
                                <input type="hidden" name="invoiceId" value="<?=$invoice['id']?>">
                                <button type="submit" class="konfirmoButton">Aprovo</button>
                            </form>
                            <form action="/admin/decline" method="POST" style="display:inline">
                                @csrf
                                <input type="hidden" name="invoiceId" value="<?=$invoice['id']?>">
                                <button class="refuzonButton">Refuzo</button>
                            </form>

                    @endif
                    <button class="shtoKoment" onclick="addMessage({{$invoice['id']}},`{{$invoice['message']}}`)">Shto koment</button>
                            </span>
                    <div id="commentSpace{{$invoice['id']}}"></div>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>


<span style="color:#0f3952;" class="text-center">Ordenado por fecha de creación</span>
<ul class="cbp_tmtimeline">
  <div class=""  id="editar"> </div>
<!-- Esto es lo que vale-->
@for ($i = 0; $i < sizeof($trabajos); $i++)
  <li>

    <time class="cbp_tmtime" ><span>{{$fechas[$i][1]}}</span> <span>{{$fechas[$i][0]}}</span></time>
    <div class="cbp_tmicon cbp_tmicon-phone"></div>
    <div class="cbp_tmlabel">
      <div class="row">
        <div class="col-10">
          <h2>{{$trabajos[$i]->nombre}}</h2>
        <b>  <p>{{$trabajos[$i]->descripcion}}</p></b>
        <div class="">

          <span> <b>Desde </b>  s/{{$trabajos[$i]->costoMin}} <b> hasta</b> s/{{$trabajos[$i]->costoMax}} </span>
        </div>
        <span> <b>Dirección </b> {{$trabajos[$i]->direccion}}</span>
        </div>
        <div class="col-2">
          <br>
          <a data-toggle="modal" data-target="#exampleModal{{$trabajos[$i]->id}}" href="#" onclick="editar({{$trabajos[$i]->id}})"><i class="material-icons">create</i></a>
          <a href="{{asset('trabajos/'.$trabajos[$i]->id)}}" target="_blank" ><i class="material-icons">exit_to_app</i> </a>
    <!--     <a href="#" id="eliminar" onclick="eliminar({{$trabajos[$i]->id}})"><i class="material-icons">delete</i></a>-->
          <a href="#"><i class="material-icons">visibility</i></a>

          <br>

          <img src="{{$fotos[$i]->miniatura}}"  alt="">
          <br>
          <button type="button"  id="p"class="btn btn-secondary"> <span>Administrar </span> </button>
        </div>
      </div>
      <div class="" id="tagss">
        @foreach($t[$i]->tags as $tag)
          <a href="#" class="badge badge-pill badge-dark">{{$tag->nombre}}</a>
        @endforeach
      </div>

    </div>
  </li>
  @endfor
<!-- Esto es lo que vale-->

<script type="text/javascript">
  function editar(id) {
    var url = "{{asset('trabajos')}}"+"/"+id+"/edit";
    $("#editar").load(url);
    console.log(url);
  }

  function eliminar(id) {
    var url = "{{asset('trabajos')}}"+"/"+id;
    $.ajax({
      url:url,
      type:'post',
      data: {_method: 'delete', _token :'{{csrf_token()}}'},
      succes :function (response) {
        console.log(resonse);
      }
    });
    console.log(url);
  }
</script>

</ul>

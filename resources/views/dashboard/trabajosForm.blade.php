
<h3>Datos Generales</h3>

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="container-fluid mt-2">
        <!--  DATOS GENERALES -->
        <div class="row" >
        	<div class="col-6">
        		<form >

				  <div class="form-group row">
				    <label for="inputEmail3" class="col-2 col-form-label">Nombre</label>
				    <div class="col-10">
				      <input type="text" class="form-control" id="inputEmail3" placeholder="Trabajo 1" value="{{$t->nombre}}">
				    </div>
				  </div>

				  <div class="form-group">
				    <label for="exampleFormControlTextarea1">Descripción</label>
				    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{$t->descripcion}}
            </textarea>
				  </div>

					<div class="form-group row">
							<label for="tagss">Tags:</label>
							<div class="col-8" id="tagss">
								@foreach($t->tags as $tag)
									<a href="#" class="badge badge-pill badge-primary">{{$tag->nombre}}</a>
								@endforeach
							</div>
					</div>

				  <div class="form-group ">
            <label for="inputEmail3" class=" col-form-label">Ingrese un intervalo de costo</label>
              <div class="row">
                <div class="col-3">
                  <input class="form-control" id="inputEmail3"  name="costoMin" placeholder="desde " value="{{$t->costoMin}}">
                </div>
                <div class="col-3">
                  <input class="form-control" id="inputEmail3"  name="costoMax" placeholder="hasta" value="{{$t->costoMax}}">

                </div>
              </div>
          </div>


          <label>Galería</label>
				  <div class="form-group">



            @foreach ($t->fotos as $f)
            <img width="200" height=""  src="{{$f->url}}" class="img-fluid img-thumbnail">
            @endforeach







				  </div>

				  <button type="submit" class="btn btn-primary">Guardar	</button>
				  <br>
				  <br>
				</form>
        	</div>

        	<div class="col-6">
        		<label>Ubicación</label>
        		<div id="map" class="mb-5" style="height: 72%; width: 100%"></div>
        		<script>
			      var map;
            var xy = "{{ $t->location }}";

              var coords = new google.maps.LatLng(parseFloat(xy.split(",")[0]), parseFloat(xy.split(",")[1]));
              //var coords = new google.maps.LatLng("{{$t->location}}"));

			        map = new google.maps.Map(document.getElementById('map'), {
			          center: coords,
			          zoom: 15
			        });

              var marker = new google.maps.Marker({
              position: coords,
              map: map,
              title: "{{$t->nombre}}",
              draggable:true
              });



			    </script>

        	</div>
        </div>

      </div>
    </div>
<!--
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
       <div class="container-fluid mt-2">

       <div class="row">
       		<div class="col-4 text-center">
       			<i class="material-icons">favorite</i> 32
       		</div>
       		<div class="col-4 text-center">
       			<i class="material-icons">favorite</i> 32
       		</div>
       		<div class="col-4 text-center">
       			<i class="material-icons">favorite</i> 32
       		</div>
       </div>



       <strong> Solicitudes: </strong>

       <div class="card">
       	<div class="row card-body"  >
        	<div class="col-1">
        		<img src="img/ernesto.jpg" alt="..." class="rounded-circle" style="width: 70px; height: 65px;">
        	</div>
        	<div class="col-8">
        		<strong>Luis Antonio Bernal</strong><br>
        		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        		consequat.
        	</div>

        	<div class="col pt-4"> <a href=""><i class="material-icons">done</i></a> </div>
        	<div class="col pt-4">  <a href=""><i class="material-icons">clear</i></a> </div>
        	<div class="col pt-4"> <a href=""><i class="material-icons"8>mail</i></a> </div>
        </div>
       </div>


       	<strong> Comentarios: </strong>

       	<div class="mb-3">
       		<div class="card ">
       			<div class="row card-body"  >
	        	<div class="col-1">
	        		<img src="img/ernesto.jpg" alt="..." class="rounded-circle" style="width: 70px; height: 65px;">
	        	</div>
        		<div class="col-11">
        			<strong>Luis Antonio Bernal</strong><br>
        			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	        		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	        		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	        		consequat.
        		</div>
	        </div>
	       </div>
	     </div>

      </div>
    </div>
    -->

  </div>


  <script type="text/javascript">
  $('#myTab a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
  });

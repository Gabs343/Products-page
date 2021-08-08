
    <?php require "view/header.php"; ?>
    <div class="container contacto-h2">
        <hr class="linea mt-5">	
	    <div class="row bg-light">
		    <div class="col-8">
                <h2 class="mb-3">¿Dónde nos encontramos?</h3>
		        <iframe style="width:100%; height:350px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d105045.10146632943!2d-58.607159858850494!3d-34.6380460301668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcca25d18ad68b%3A0xf3698defdb8ec4b9!2sGezatek!5e0!3m2!1ses!2sar!4v1605213211861!5m2!1ses!2sar"></iframe>
                
		        <div class="cuadro">
                    
		            <div class="info-dentro">
		                <h4>Visitanos</h4>
		                <p>
			                Av. Carabobo 11, Caballito, Buenos Aires.
                        </p>
		            </div>
		        </div>
		    </div>
		
		    <div class="col-4 mb-3">
		        <h2 class="mb-3">Contactanos</h4>

		        <form method="post" action="correo_respuesta.php" enctype="multipart/form-data" class="form-horizontal">
                <fieldset>
                <div class="form-group">
           
                    <input type="text" placeholder="Nombre" name="nombre" class="form-control" required/>
           
                </div>
		        <div class="form-group">
           
                    <input type="text" placeholder="Apellido" name="apellido" class="form-control" required/>
           
                </div>
		        <div class="form-group">
           
		            <input type="email" placeholder="@correo.com" name="email" class="form-control" required/>
		
	            </div>
		        <div class="form-group">
		
		            <input type="tel" placeholder="Celular" name="celular" pattern="[0-9]{8}" class="form-control" required/>
	   
		        </div>
	            <div class="form-group">
		            Area de la empresa: <br>
			        <select name="area" class="form-control" required>
				        <option value="soporte" selected="selected">Soporte de sistema</option>
				        <option value="ventas">Sector de ventas</option>  
				        <option value="productos">Area de productos</option>
				        <option value="rrhh">Recursos Humanos</option>
			        </select>
	            </div>

	            <div class="form-group">
		            <textarea rows="3" id="textarea" placeholder="Mensaje" name="mensaje" class="form-control" required></textarea>
	            </div>

		        <button class="btn btn-primary mt-2" type="submit" name="sendContacto">Enviar</button>

	            </fieldset>
                </form>
            </div>
		</div>	
    <hr class="linea mb-5">	
</div>
    <?php require "view/footer.php"; ?>
</body>

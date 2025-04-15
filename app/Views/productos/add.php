<!-- Start -->
<div class="card-body">
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="producto-tab" data-toggle="tab" href="#producto" role="tab" aria-controls="producto" aria-selected="true">Producto</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="imagen-tab" data-toggle="tab" href="#imagen" role="tab" aria-controls="imagen" aria-selected="false">Imagen</a>
		</li>
	</ul>

	<div class="tab-content mt-3">
		<div class="tab-pane fade show active" id="producto" role="tabpanel" aria-labelledby="producto-tab">
			<!-- Contenido de la pestaña Producto -->
			<form id="frmprods" method="post">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header bg-info text-white">
								<!-- Información de producto -->
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label for="prod-ARTICULO">Clave</label>
											<input type="text" class="form-control" id="prod-ARTICULO" name="prod-ARTICULO" onkeyup="mayusculas(this);">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="prod-DESCRIP">Nombre</label>
											<input type="text" class="form-control" id="prod-DESCRIP" name="prod-DESCRIP" onkeyup="mayusculas(this);">
										</div>
									</div>
									<div class="col-lg-2">
										<label for="prod-LINEA">Linea</label>
										<select class="form-control select2" id="prod-LINEA" name="prod-LINEA"></select>
									</div>
									<div class="col-lg-2">
										<label for="prod-UNIDAD">Unidad</label>
										<select class="form-control" id="prod-UNIDAD" name="prod-UNIDAD">
											<option value="PZA">PZA</option>
											<option value="KG">KG</option>
											<option value="T">T</option>
											<option value="LTR">LTR</option>
											<option value="GAL">GAL</option>
											<option value="JGO">JGO</option>
										</select>
									</div>
									<div class="col-lg-2">
										<label for="prod-IMPUESTO">Impuesto</label>
										<select class="form-control select2" id="prod-IMPUESTO" name="prod-IMPUESTO"></select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<!-- Datos del producto -->
					<div class="col-md-8">
						<div class="card">
							<div class="card-header bg-info text-white">
								Precios y utilidades
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="prod-COSTOU">Costo Ultimo</label>
											<input type="text" class="form-control" id="prod-COSTOU" name="prod-COSTOU" onkeyup="calcularUtilidades(); validarNumerosDecimales(this);">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="prod-PRECIO1">Precio predeterminado</label>
											<input type="text" class="form-control" id="prod-PRECIO1" name="prod-PRECIO1" onkeyup="calcularUtilidades(); validarNumerosDecimales(this);">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="prod-U1">Utilidad</label>
											<input type="text" class="form-control" name="prod-U1" id="prod-U1" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="prod-C2">Mayoreo 1 a partir de</label>
											<input type="text" class="form-control" id="prod-C2" name="prod-C2" onkeyup="validarNumerosDecimales(this);">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="prod-PRECIO2">Precio mayoreo 1</label>
											<input type="text" class="form-control" id="prod-PRECIO2" name="prod-PRECIO2" onkeyup="calcularUtilidades(); validarNumerosDecimales(this);">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="prod-U2">Utilidad mayoreo 1</label>
											<input type="text" class="form-control" name="prod-U2" id="prod-U2" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="prod-C3">Mayoreo 2 a partir de</label>
											<input type="text" class="form-control" id="prod-C3" name="prod-C3" onkeyup="validarNumerosDecimales(this);">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="prod-PRECIO3">Precio mayoreo 2</label>
											<input type="text" class="form-control" id="prod-PRECIO3" name="prod-PRECIO3" onkeyup="calcularUtilidades(); validarNumerosDecimales(this);">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="prod-U3">Utilidad mayoreo 2</label>
											<input type="text" class="form-control" name="prod-U3" id="prod-U3" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Caracteristicas del producto -->
					<div class="col-md-4">
						<div class="card">
							<div class="card-header bg-info text-white">
								Opciones
							</div>
							<div class="card-body">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="prod-PARAVENTA" name="prod-PARAVENTA" checked>
									<label class="form-check-label" for="prod-PARAVENTA">Artículo para venta</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="prod-Granel" name="prod-Granel">
									<label class="form-check-label" for="prod-Granel">Venta a granel</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="prod-Bloqueado" name="prod-Bloqueado">
									<label class="form-check-label" for="prod-Bloqueado">Artículo bloqueado</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="prod-INVENT" name="prod-INVENT" checked>
									<label class="form-check-label" for="prod-INVENT">Control de inventario</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="prod-speso" name="prod-speso">
									<label class="form-check-label" for="prod-speso">Solicitud de peso</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="prod-costo" name="prod-costo">
									<label class="form-check-label" for="prod-costo">Debajo del costo</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="prod-BODEGA" name="prod-BODEGA" checked>
									<label class="form-check-label" for="prod-BODEGA">Solo bodega</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Datos del SAT -->
				<div class="row">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header bg-info text-white">
								Requerimientos SAT
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="prod-claveprodserv">Clave de producto o servicio</label>
											<input type="text" class="form-control" id="prod-claveprodserv" name="prod-claveprodserv">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="prod-claveunidad">Unidad</label>
											<select class="form-control" id="prod-claveunidad" name="prod-claveunidad">
												<option value="H87">H87 - Pieza</option>
												<option value="E48">E48 - Servicio</option>
												<option value="KGM">KGM - Kilogramo</option>
												<option value="MTR">MTR - Metro</option>
												<option value="LTR">LTR - Litro</option>
												<option value="F52">F52 - Unidad de servicio</option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="prod-objimpuesto">Objeto de Impuesto</label>
											<select class="form-control" id="prod-objimpuesto" name="prod-objimpuesto">
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card">
							<div class="card-header bg-info text-white">
								Claves
							</div>
							<div class="card-body">
								<div class="form-group">
									<label for="prod-BARCODE">Código de barras</label>
									<input type="text" class="form-control" id="prod-BARCODE" placeholder="--">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<button type="button" id="prod-save" class="btn btn-success">
							<i class="bx bx-save" aria-hidden="true"></i> Guardar
						</button>
					</div>
				</div>
			</form>
		</div>

		<!-- Contenido de la pestaña Imagen -->
		<div class="tab-pane fade" id="imagen" role="tabpanel" aria-labelledby="imagen-tab">
			<div class="row">
				<form action="post" id="form" class="w-100">
					<input type="hidden" name="cvearticulo" value="">
					<div class="col-md-4">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="picture1" id="picture1" onchange="previewImage(this, 'preview1')" accept="image/*">
								<label class="custom-file-label" for="picture1">Adjuntar archivo (Fotografía)</label>
							</div>
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i> Buscar</button>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<img id="preview1" src="#" alt="Vista previa de la imagen">
					</div>
					<div class="col-md-12 mt-3">
						<button type="button" id="btnSave" onclick="save()" class="btn btn-primary" disabled>Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- End -->
<script>
	var producto;
	var save_method;

	$(document).ready(function() {
		getLineas();
		getImpuestos();
		getObjetoImpuesto();

		if (!producto) {
			localStorage.removeItem('cvearticulo');
		}

		$("#prod-claveprodserv").autocomplete({
			source: function(request, response) {
				getProductosServicios(request.term, function(data) {
					response(data.map(function(item) {
						return {
							label: item['ClaveProdServ'] + ' - ' + item['Descripcion'],
							value: item['ClaveProdServ']
						};
					}));
				});
			}
		});

		$("#prod-save").click(function() {
			var formData = $('#frmprods').serialize();
			$.ajax({
				url: API_URL + 'articulo/registrar',
				type: 'POST',
				headers: {
					'token': token, // Agrega el token al encabezado
					'Content-Type': 'application/json'
				},
				data: formData,
				success: function(response) {
					$('#loader').hide();
					console.log(response); // Verificar la respuesta
					if (response.status == 200 && response.success === false) {
						handleValidationErrors(response.messages);
						$('#prod-save').prop('disabled', false);
					} else if (response.status == 200 && response.success === true) {
						producto = $('#prod-ARTICULO').val();
						localStorage.setItem('cvearticulo', producto);
						$('#btnSave').prop('disabled', false);
						handleSuccess('¡Felicidades!', response.messages);
						$('#frmprods')[0].reset();
					}
				},
				error: function(xhr, textStatus, errorThrown) {
					$('#loader').hide();
					handleAjaxError(xhr);
					$('#prod-save').prop('disabled', false);
				}
			});
		});

		// Cargar el valor de cvearticulo al cambiar a la pestaña de imagen
		$('a[data-toggle="tab"][href="#imagen"]').on('click', function(e) {
			var cvearticulo = localStorage.getItem('cvearticulo');
			if (!cvearticulo) {
				e.preventDefault();
				myMessages('error', 'Error', 'Por favor, completa la información del producto antes de continuar a la sección de imágenes.');
				$('#btnSave').prop('disabled', true);
			} else {
				$('input[name="cvearticulo"]').val(cvearticulo);
				$('#btnSave').prop('disabled', false);
			}
		});
	});

	function save() {
		var formData = new FormData($('#form')[0]);
		$.ajax({
			url: API_URL + 'articulo/registraFoto',
			type: "POST",
			headers: {
				'token': token, // Agrega el token al encabezado
				'Content-Type': 'application/json'
			},
			data: formData,
			processData: false,
			contentType: false,
			dataType: "JSON",
			success: function(data) {

				localStorage.removeItem('cvearticulo');
				handleSuccess('¡Felicidades!', response.messages);
				$('#form')[0].reset();
			},
			error: function(xhr, textStatus, errorThrown) {
				handleAjaxError(xhr);
			}
		});
	}

	function calcularUtilidades() {
		const costoU = parseFloat(document.getElementById('prod-COSTOU').value) || 0;
		const precio1 = parseFloat(document.getElementById('prod-PRECIO1').value) || 0;
		const precio2 = parseFloat(document.getElementById('prod-PRECIO2').value) || 0;
		const precio3 = parseFloat(document.getElementById('prod-PRECIO3').value) || 0;

		const utilidad1 = calcularUtilidad(costoU, precio1);
		const utilidad2 = calcularUtilidad(costoU, precio2);
		const utilidad3 = calcularUtilidad(costoU, precio3);

		document.getElementById('prod-U1').value = utilidad1.toFixed(2);
		document.getElementById('prod-U2').value = utilidad2.toFixed(2);
		document.getElementById('prod-U3').value = utilidad3.toFixed(2);
	}

	function calcularUtilidad(costo, precio) {
		if (costo === 0) return 0;
		return ((precio - costo) / costo) * 100;
	}

	function validarNumerosDecimales(input) {
		input.value = input.value.replace(/[^0-9.]/g, '');
	}
</script>

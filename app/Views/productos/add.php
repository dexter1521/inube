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
				<div class="row g-3">
					<div class="col-12 col-md-6 col-lg-3">
						<label for="clave" class="form-label">Clave</label>
						<input type="text" class="form-control" id="clave" name="clave" onkeyup="mayusculas(this);">
					</div>
					<div class="col-12 col-md-6 col-lg-3">
						<label for="descripcion" class="form-label">Nombre</label>
						<input type="text" class="form-control" id="descripcion" name="descripcion" onkeyup="mayusculas(this);">
					</div>
					<div class="col-12 col-md-6 col-lg-2">
						<label for="linea" class="form-label">Línea</label>
						<select class="form-control select2" id="linea" name="linea"></select>
					</div>
					<div class="col-12 col-md-6 col-lg-2">
						<label for="unidad" class="form-label">Unidad</label>
						<select class="form-control" id="unidad" name="unidad">
							<option value="PZA">PZA</option>
							<option value="KG">KG</option>
							<option value="T">T</option>
							<option value="LTR">LTR</option>
							<option value="GAL">GAL</option>
							<option value="JGO">JGO</option>
						</select>
					</div>
					<div class="col-12 col-md-6 col-lg-2">
						<label for="impuesto" class="form-label">Impuesto</label>
						<select class="form-control select2" id="impuesto" name="impuesto"></select>
					</div>
				</div>

				<!-- Precios y utilidades y opciones -->
				<div class="row g-3 mt-3">
					<div class="col-12 col-md-8">
						<div class="card h-100">
							<div class="card-header bg-info text-white">Precios y utilidades</div>
							<div class="card-body">
								<div class="row g-2">
									<div class="col-12 col-md-4">
										<label for="costoultimo" class="form-label">Costo Último</label>
										<input type="text" class="form-control" id="costoultimo" name="costoultimo" onkeyup="calcularUtilidades(); validarNumerosDecimales(this);">
									</div>
									<div class="col-12 col-md-4">
										<label for="precio" class="form-label">Precio predeterminado</label>
										<input type="text" class="form-control" id="precio" name="precio" onkeyup="calcularUtilidades(); validarNumerosDecimales(this);">
									</div>
									<div class="col-12 col-md-4">
										<label for="u1" class="form-label">Utilidad</label>
										<input type="text" class="form-control" name="u1" id="u1" readonly>
									</div>
								</div>
								<div class="row g-2 mt-2">
									<div class="col-12 col-md-4">
										<label for="c2" class="form-label">Mayoreo 1 a partir de</label>
										<input type="text" class="form-control" id="c2" name="c2" onkeyup="validarNumerosDecimales(this);">
									</div>
									<div class="col-12 col-md-4">
										<label for="precio2" class="form-label">Precio mayoreo 1</label>
										<input type="text" class="form-control" id="precio2" name="precio2" onkeyup="calcularUtilidades(); validarNumerosDecimales(this);">
									</div>
									<div class="col-12 col-md-4">
										<label for="u2" class="form-label">Utilidad mayoreo 1</label>
										<input type="text" class="form-control" name="u2" id="u2" readonly>
									</div>
								</div>
								<div class="row g-2 mt-2">
									<div class="col-12 col-md-4">
										<label for="c3" class="form-label">Mayoreo 2 a partir de</label>
										<input type="text" class="form-control" id="c3" name="c3" onkeyup="validarNumerosDecimales(this);">
									</div>
									<div class="col-12 col-md-4">
										<label for="precio3" class="form-label">Precio mayoreo 2</label>
										<input type="text" class="form-control" id="precio3" name="precio3" onkeyup="calcularUtilidades(); validarNumerosDecimales(this);">
									</div>
									<div class="col-12 col-md-4">
										<label for="u3" class="form-label">Utilidad mayoreo 2</label>
										<input type="text" class="form-control" name="u3" id="u3" readonly>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="card h-100">
							<div class="card-header bg-info text-white">Opciones</div>
							<div class="card-body">
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" id="paraventa" name="paraventa" checked>
									<label class="form-check-label" for="paraventa">Artículo para venta</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" id="invent" name="invent" checked>
									<label class="form-check-label" for="invent">Control de inventario</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" id="granel" name="granel">
									<label class="form-check-label" for="granel">Venta a granel</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" id="speso" name="speso">
									<label class="form-check-label" for="speso">Solicitud de peso</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" id="bajocosto" name="bajocosto">
									<label class="form-check-label" for="bajocosto">Debajo del costo</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" id="bloqueado" name="bloqueado">
									<label class="form-check-label" for="bloqueado">Artículo bloqueado</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Datos del SAT -->
				<div class="row g-3 mt-3">
					<div class="col-12">
						<div class="card">
							<div class="card-header bg-info text-white">Requerimientos SAT</div>
							<div class="card-body">
								<div class="row g-2">
									<div class="col-12 col-md-4">
										<label for="claveprodserv" class="form-label">Clave de producto o servicio</label>
										<input type="text" class="form-control" id="claveprodserv" name="claveprodserv">
									</div>
									<div class="col-12 col-md-4">
										<label for="claveunidad" class="form-label">Unidad</label>
										<select class="form-control" id="claveunidad" name="claveunidad">
											<option value="H87">H87 - Pieza</option>
											<option value="E48">E48 - Servicio</option>
											<option value="KGM">KGM - Kilogramo</option>
											<option value="MTR">MTR - Metro</option>
											<option value="LTR">LTR - Litro</option>
											<option value="F52">F52 - Unidad de servicio</option>
										</select>
									</div>
									<div class="col-12 col-md-4">
										<label for="objimpuesto" class="form-label">Objeto de Impuesto</label>
										<select class="form-control" id="objimpuesto" name="objimpuesto">
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-12">
						<button type="button" id="prod-save" class="btn btn-success btn-lg w-100">
							<i class="bx bx-save" aria-hidden="true"></i> Guardar
						</button>
					</div>
				</div>

			</form>
		</div>

		<!-- Contenido de la pestaña Imagen -->
		<div class="tab-pane fade" id="imagen" role="tabpanel" aria-labelledby="imagen-tab">
			<form action="post" id="form" class="w-100">
				<input type="hidden" name="cvearticulo" value="">
				<div class="row g-3 align-items-center">
					<div class="col-12 col-md-6">
						<div class="input-group mb-3">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="picture1" id="picture1" onchange="previewImage(this, 'preview1')" accept="image/*">
								<label class="custom-file-label" for="picture1">Adjuntar archivo (Fotografía)</label>
							</div>
							<div class="input-group-append">
								<button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i> Buscar</button>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 text-center">
						<img id="preview1" src="#" alt="Vista previa de la imagen" class="img-fluid rounded border" style="max-height: 250px;">
					</div>
					<div class="col-12 mt-3">
						<button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-lg w-100" disabled>Guardar imagen</button>
					</div>
				</div>
			</form>
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
			// Recolectar todos los datos del formulario automáticamente
			var formArray = $('#frmprods').serializeArray();
			var data = {};
			formArray.forEach(function(item) {
				data[item.name] = item.value;
			});
			// Incluir los checkboxes no marcados (valor 0 si no están en data)
			$('#frmprods input[type="checkbox"]').each(function() {
				if (!data.hasOwnProperty(this.name)) {
					data[this.name] = 0;
				} else {
					data[this.name] = 1;
				}
			});

			// Validar que línea e impuesto no envíen '#'
			if (data.linea === "#") data.linea = "";
			if (data.impuesto === "#") data.impuesto = "";
			$('#prod-save').prop('disabled', true);
			$.ajax({
				url: API_URL + 'productos',
				type: 'POST',
				contentType: 'application/json',
				headers: {
					'token': token
				},
				data: JSON.stringify(data),
				success: function(response) {
					$('#loader').hide();
					if ((response.status === 201 || response.status === '201') || (response.status === true && response.data)) {
						// Si la respuesta es exitosa y contiene datos del producto creado
						producto = response.data.clave;
						localStorage.setItem('cvearticulo', producto);
						$('#btnSave').prop('disabled', false);
						myMessages('success', '¡Felicidades!', response.messages || response.message || 'Producto creado correctamente.');
						handleSuccess('¡Felicidades!', response.messages || response.message || 'Producto creado correctamente.');
						$('#frmprods')[0].reset();
					} else {
						handleValidationErrors(response.errors || response.messages || response);
						$('#prod-save').prop('disabled', false);
					}
				},
				error: function(xhr) {
					$('#loader').hide();
					// Intentar extraer y mostrar errores de validación si existen
					if (xhr.responseJSON && xhr.responseJSON.errors) {
						handleValidationErrors(xhr.responseJSON);
					} else {
						handleAjaxError(xhr);
					}
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
		const costoU = parseFloat(document.getElementById('costoultimo').value) || 0;
		const precio1 = parseFloat(document.getElementById('precio').value) || 0;
		const precio2 = parseFloat(document.getElementById('precio2').value) || 0;
		const precio3 = parseFloat(document.getElementById('precio3').value) || 0;

		const utilidad1 = calcularUtilidad(costoU, precio1);
		const utilidad2 = calcularUtilidad(costoU, precio2);
		const utilidad3 = calcularUtilidad(costoU, precio3);

		document.getElementById('u1').value = utilidad1.toFixed(2);
		document.getElementById('u2').value = utilidad2.toFixed(2);
		document.getElementById('u3').value = utilidad3.toFixed(2);
	}

	function calcularUtilidad(costo, precio) {
		if (costo === 0) return 0;
		return ((precio - costo) / costo) * 100;
	}
</script>
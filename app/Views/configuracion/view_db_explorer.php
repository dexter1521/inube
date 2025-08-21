<div class="container mt-4">
    <h2>Explorador de Base de Datos</h2>
    <form method="get" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="table">Selecciona una tabla:</label>
                <select name="table" id="table" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Elige una tabla --</option>
                    <?php foreach ($tables as $tbl): ?>
                        <option value="<?php echo $tbl; ?>" <?php if ($selectedTable == $tbl) echo 'selected'; ?>><?php echo $tbl; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </form>

    <?php if ($selectedTable): ?>
        <h4>Estructura de la tabla <b><?php echo $selectedTable; ?></b></h4>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Campo</th>
                    <th>Tipo</th>
                    <th>Nulo</th>
                    <th>Clave</th>
                    <th>Extra</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($structure as $field): ?>
                    <tr>
                        <td><?php echo $field->name; ?></td>
                        <td><?php echo $field->type; ?></td>
                        <td><?php echo $field->nullable ? 'Sí' : 'No'; ?></td>
                        <td><?php echo $field->primary_key ? 'PK' : ''; ?></td>
                        <td><?php echo (property_exists($field, 'auto_increment') && $field->auto_increment) ? 'Auto' : ''; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h4>Primeros 20 registros</h4>
        <div style="overflow-x:auto;">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <?php if (!empty($rows)): foreach (array_keys($rows[0]) as $col): ?>
                                <th><?php echo $col; ?></th>
                        <?php endforeach;
                        endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rows)): foreach ($rows as $row): ?>
                            <tr>
                                <?php foreach ($row as $val): ?>
                                    <td><?php echo htmlspecialchars($val); ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="100">Sin registros</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <h4>Consulta SQL (solo SELECT)</h4>
    <form method="post">
        <div class="row">
            <div class="col-md-8">
                <input type="text" name="sql" class="form-control" placeholder="Ejemplo: SELECT * FROM productos LIMIT 10" value="<?php echo htmlspecialchars($sql ?? ''); ?>">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Ejecutar</button>
            </div>
        </div>
    </form>
    <?php if ($error): ?>
        <div class="alert alert-danger mt-2"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if ($queryResult !== null): ?>
        <h5 class="mt-3">Resultado de la consulta</h5>
        <div style="overflow-x:auto;">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <?php if (!empty($queryResult)): foreach (array_keys($queryResult[0]) as $col): ?>
                                <th><?php echo $col; ?></th>
                        <?php endforeach;
                        endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($queryResult)): foreach ($queryResult as $row): ?>
                            <tr>
                                <?php foreach ($row as $val): ?>
                                    <td><?php echo htmlspecialchars($val); ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="100">Sin resultados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
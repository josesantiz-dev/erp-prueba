<!-- Modal -->
<div class="modal fade" id="modalNuevaGeneracion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NUEVA GENERACION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id = "formNuevaGeneracion">
      <div class="modal-body">
      <div class="mb-3">
    <label for="exampleInputEmail1" class="label">NOMBRE GENERACION</label>
    <input type="text" class="form-control" id="txtNombreGeneracion" name = "txtNombreGeneracion" required>
  </div>
      </div>
      <label for="start">Fecha de inicio</label>

<input type="date" id="dateFechaInicio" name="dateFechaInicio"
       value="2018-07-22"
       min="2018-01-01" max="2018-12-31" required>

       <label for="start">Fecha de conclusion</label>

<input type="date" id="dateFechaFin" name="dateFechaFin"
       value="2018-07-22"
       min="2018-01-01" max="2018-12-31" required>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
        <button type="submit" class="btn btn-primary">GUARDAR CAMBIOS</button>
      </div>
</form>
    </div>
  </div>
</div>


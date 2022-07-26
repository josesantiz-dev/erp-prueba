<div class="modal fade" id="modalEditGeneracion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Generacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formNuevaGeneracionEdit">
      <div class="modal-body">
        <input type="hidden" id="txtIdGeneracion" name="txtIdGeneracion">
        <div class="form-group">
            <label>Nombre Generacion</label>
            <input type="text" class="form-control" id="txtNombreGeneracionEdit" name="txtNombreGeneracionEdit" required>
        </div>

        <label for="start">Fecha inicio:</label>
<input type="date" id="dateFechaInicioEdit" name="dateFechaInicioEdit"
       value="" required>


       <label for="start">Fecha Fin:</label>
<input type="date" id="dateFechaFinEdit" name="dateFechaFinEdit"
       value="" required>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
      </form>
    </div>
  </div>
</div>
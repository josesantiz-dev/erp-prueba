<?php
  headerAdmin($data); 
  getModal("GeneracionJesusK/modalNuevaGeneracion",$data);
  getModal("GeneracionJesusK/modalEditGeneracion",$data);
?>
<div id="contentAjax"></div>
<div class="wrapper">
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-7">
            <h1 class="m-0">  <?= $data['page_title'] ?>
              
            </h1>
          </div>
          <div class="col-sm-5">
            <ol class="breadcrumb float-sm-right btn-block">
            <button type="button" id = "btNuevaGeneracion" onclick="openModal();" class="btn btn-inline btn-primary btn-sm btn-block" data-toggle="modal" data-target="#modalNuevaGeneracion">
            <i class="fa fa-plus-circle fa-md"></i> Nuevo</button>
            <!--<button type="button" onclick="openModal();" class="btn btn-inline btn-primary btn-sm btn-block" data-toggle="modal" data-target="#ModalFormRol"><i class="fa fa-plus-circle fa-md"></i> Nuevo</button>-->
              <!--<li class="breadcrumb-item"><i class="fa fa-home fa-md"></i><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>-->
            </ol>
          </div>
        </div>
      </div>
    </div>


    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-lg-12">


<div class="card">
  <div class="card-body">
    <h3 class="card-title">Listado de generaciones</h3>
    <p class="card-text">
    <table id="tablegeneraciones" class="table table-bordered table-striped table-hover table-sm">
      <thead>
      <tr>
        <th width="7%">#</th>
        <th>Nombre generacion</th>
        <th width="10%">fecha de inicio</th>
        <th width="10%">Fecha de conclusion</th>
        <th width="15%">Estatus</th>
        <th width="17%">Acciones</th>
      </tr>
      </thead>
      <tbody>

      </tbody>

    </table>
  </p>
  </div>
</div>


</div>

</div>
</div>
</div>
</div>
</div>

<?php footerAdmin($data); ?>




        
          
        </div>
      </div>
    </div>
  </div>
</div>

<?php footerAdmin($data); ?>
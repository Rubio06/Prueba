<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Bootstrap JS (Requiere Popper.js y jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="background-color: #faf7f7">
    <div id=" contenedor" class="container">
        <h1 style="text-align: center; margin-bottom:70px;">PRACTICA CRUD (CREATE, DELETE, UPDATE, READ)</h1>
        <div class="row">
            <!-- FORMULARIO INSERTAR DATOS -->
            <div class="col-xs-2 col-xl-4">
                <div class="p-4" style="background: #F2F3F4; border-radius:10px;">
                    <h3 style="text-align: center; margin-bottom:25px;">INSERTAR DATOS</h1>
                        <div class="mb-4">
                            <label for="producto" class="form-label"><b>INGRESAR PRODUCTO</b></label>
                            <input type="email" class="form-control" id="producto" name="producto"
                                placeholder="INGRESE SU PRODUCTO">
                        </div>
                        <div class="mb-3">
                            <label for="codcategoria" class="form-label"><b>CATEGORIA</b></label>
                            <select class="form-control" name="codcategoria" id="codcategoria" rows=" 3">
                            </select>
                        </div>
                        <div>
                            <button type="button" class="btn btn-warning w-100" id="insertarDatos"><b>Insertar
                                    datos</b></button>
                        </div>
                        <div id="respInsertar">
                        </div>
                </div>
            </div>
            <!-- TABLA DE PRODUCTOS -->
            <div class="col-xs-10 col-xl-8 mx-auto">
                <div class="row">
                    <div class="container mb-4">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-4 p-2">
                                <label for="producto" class="form-label"><b>INGRESE UNA CATEGORIA</b></label>
                            </div>
                            <div class="col-md-4 p-2">
                                <input type="text" class="form-control" id="categoria" name="categoria"
                                    placeholder="INGRESE UNA CATEGORIA">
                            </div>
                            <div class="col-md-4 p-2">
                                <button type="button" class="btn btn-success w-100"
                                    onclick="ingresoCategoria()"><b>Agregar categoría</b></button>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <table class="table table-hover table-bordered w-100">
                            <thead style="background: #131649; color: white; ">
                                <tr>
                                    <th scope="col">#CODIGO</th>
                                    <th scope="col">NOMBRE PRODUCTO</th>
                                    <th scope="col">CATEGORIA</th>
                                    <th scope="col">EDITAR</th>
                                    <th scope="col">ELIMINAR</th>
                                </tr>
                            </thead>
                            <tbody id="tablaProductos">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL DE ACTUALIZACION -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background:#B5DEF5;">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><b>ACTUALIZAR REGISTRO</b></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="recibirId" disabled style="display: none;">
                    <div class="mb-3">
                        <label for="producto" class="form-label"><b>INGRESAR PRODUCTO</b></label>
                        <input type="text" class="form-control" id="recibeProducto" name="producto"
                            placeholder="INGRESE SU PRODUCTO">
                    </div>
                    <div class="mb-3">
                        <label for="codcategoria" class="form-label"><b>CATEGORIA</b></label>
                        <input type="text" class="form-control" id="recibeCategoria" name="recibeCategoria"
                            placeholder="INGRESE SU CATEGORIA">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class=" col-6" ">
                            <button type=" button" class="btn btn-warning w-100 mx-auto" data-bs-dismiss="modal">
                            <b>Close</b>
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-success w-100" onclick="actualizar()"><b>Actualizar
                                    Datos</b></button>
                        </div>
                    </div>
                </div>
                <div id="respActualizar">
                </div>
            </div>
        </div>
    </div>
    <script src="./js/main.js"></script>
</body>

</html>
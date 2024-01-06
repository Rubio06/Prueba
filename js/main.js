//INSERTAR DATOS
document.getElementById("insertarDatos").addEventListener("click", (e) => {
  e.preventDefault();
  let producto = document.getElementById("producto").value;
  let codcategoria = document.getElementById("codcategoria").value;
  let data = new FormData();
  data.append("producto", producto);
  data.append("codcategoria", codcategoria);
  data.append("op", "insertarDatos");
  fetch("./consultas.php", {
    method: "POST",
    body: data
  }).then((response) => response.json())
  .then(data => {
      document.getElementById("respInsertar").innerHTML = data;
      setTimeout(()=>{
        document.getElementById("respInsertar").innerHTML = "";
        location.reload();
      },3000)
  }).catch(error => console.log(error));
});
//MOSTRAR LAS CATEGORIAS EN UN SELECT
function mostrarSelect(){
  let codcategoria = document.getElementById("codcategoria");
  let data = new FormData();
  // data.append("codcategoria", codcategoria);
  data.append("op", "mostrarSelect");
  fetch("./consultas.php", {
    method: "POST",
    body: data
  }).then((response) => response.json())
  .then(data => {
    codcategoria.innerHTML += data;
  }).catch(error => console.log(error));
}
mostrarSelect();
//MOSTRAR DATOS DE LA BD
function tablaProductos(){
  let tablaProductos = document.getElementById("tablaProductos");
  let data = new FormData();
  // data.append("codcategoria", codcategoria);
  data.append("op", "mostrarTablaProductos");
  fetch("./consultas.php", {
    method: "POST",
    body: data
  }).then((response) => response.json())
  .then(data => {
    tablaProductos.innerHTML += data;
  }).catch(error => console.log(error));
}
tablaProductos();
//ENVIAR DATOS AL MODAL
function envirCodiP(codigo) {
  let data = new FormData();
 data.append("codigo", codigo);
 data.append("op", "mostrarDatos");
 fetch("./consultas.php", {
   method: "POST",
   body: data
 }).then((response) => response.json())
 .then(data => {
  console.log(data)
  data.forEach(element => {
    document.getElementById("recibirId").value = element.codproducto;
    document.getElementById("recibeProducto").value = element.producto;
    document.getElementById("recibeCategoria").value = element.categoria;

  });

 }).catch(error => console.log(error));
}
//ACTUALIZAR REGISTROS
function actualizar() {
  const recibirId = document.getElementById("recibirId").value;
  const confirmacion = confirm("¿Desea actualizar los datos? " + recibirId);
  if (confirmacion) {
    const recibeProducto = document.getElementById("recibeProducto").value;
    const recibeCategoria = document.getElementById("recibeCategoria").value;
    let data = new FormData();
    data.append("recibeProducto", recibeProducto);
    data.append("recibeCategoria", recibeCategoria);
    data.append("recibirId", recibirId);
    
    data.append("op", "actualizarDatos");
    fetch("./consultas.php", {
      method: "POST",
      body: data
    }).then((response) => response.json())
    .then(data => {
      document.getElementById("respActualizar").innerHTML = data;
      setTimeout(()=>{
        document.getElementById("respActualizar").innerHTML = "";
        location.reload();
      },3000)
  
   }).catch(error => console.log(error));
  } else {
    alert("Operación de eliminación cancelada");
  }
}
//ELIMINAR REGISTROS
function eliminarRegistros (codigo){
  const confirmacion = confirm("¿Está seguro de que desea eliminar este registro nro.? " + codigo);
  if (confirmacion) {
    let data = new FormData();
    data.append("codigo", codigo);
    data.append("op", "eliminarRegistros");
    fetch("./consultas.php", {
      method: "POST",
      body: data
    }).then((response) => response.json())
    .then(data => {
      if (data === true) {
        alert("Datos eliminados correctamente");
      }
      location.reload();
    }).catch(error => console.log(error));
  } else {
    alert("Operación de eliminación cancelada");
  }
}
//INGRESAR CATEGORIA
function ingresoCategoria() {
  let categoria = document.getElementById("categoria").value;
  const confirmacion = confirm("¿Esta seguro de ingresar la categoria? " + categoria);
  if (confirmacion) {
    let data = new FormData();
    data.append("categoria", categoria);
    data.append("op", "insertarCategoria");
    fetch("./consultas.php", {
      method: "POST",
      body: data
    }).then((response) => response.json())
    .then(data => {
      alert(data);
      location.reload();

    }).catch(error => console.log(error));
  } else {
    alert("Operación de eliminación cancelada");
  }
}
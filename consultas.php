<?php
include "./conexion/conexion.php";
$cn = Conectarse();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["op"])) {
    $op = $_POST["op"];
    switch ($op) {
      //INSERTAR DATOS
      case "insertarDatos":
        $producto = strtoupper($_POST["producto"]);
        $codcategoria = strtoupper($_POST["codcategoria"]);
        $sql = "INSERT INTO producto (producto, fkcategoria) VALUES (?, ?)";
        // Preparar la consulta
        $stmt = $cn->prepare($sql);
        // Vincular parámetros
        $stmt->bind_param("ss", $producto, $codcategoria);
        // Ejecutar la consulta
        $resInsertar = "";
        if ($stmt->execute()) {
          $resInsertar .= "<div class='alert alert-success' role='alert'>Datos insertados correctamente</div>";
        } else {
          $resInsertar .= "<div class='alert alert-danger' role='alert'>Los datos no se insertaron</div>";
        }
        echo json_encode($resInsertar);
        // Cerrar la conexión
        $stmt->close();
        $cn->close();
      break;
      //MOSTRAR DATOS EN SELECT CATEGORIAS
      case "mostrarSelect":
        $sql = "SELECT * FROM categorias";
        $execute = $cn->query($sql);
        $optionsHTML = '';
        if ($execute->num_rows > 0) {
          while ($row = $execute->fetch_assoc()) {
            $codcategoria = $row["codcategoria"];
            $categoriaNombre = $row["categoria"];
            $optionsHTML .= "<option value='$codcategoria'>$categoriaNombre</option>";
          }
        } else {
          $optionsHTML .= "<option value=''>No existen registros</option>";
        }
        echo json_encode($optionsHTML);

        $execute->close();
        $cn->close();
      break;
      //MOSTRAR DATOS EN LA TABLA PRODUCTO
      case "mostrarTablaProductos":
        $sql = "SELECT codproducto, producto, categoria FROM producto INNER JOIN categorias ON producto.fkcategoria = categorias.codcategoria;";
        $execute = $cn->query($sql);
        if ($execute->num_rows > 0) {
          $tablaHTML = '';
          while ($row = $execute->fetch_assoc()) {
            $codproducto = $row["codproducto"];
            $producto = $row["producto"];
            $categoria = $row["categoria"];
            $tablaHTML .= "<tr>
                              <td><b>$codproducto</b></td>
                              <td>$producto</td>
                              <td>$categoria</td>
                              
                              <td><button type='button' class='btn btn-success w-100' onclick='envirCodiP($codproducto)' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                              <b>Actualizar</b>
                          </button></td>
                              <td><button type='button' class='btn btn-danger w-100' onclick='eliminarRegistros($codproducto)'><b>Eliminar</b></button></td>

                          <tr>";
          }
          echo json_encode($tablaHTML);
        } else {
          echo json_encode("<tr><td colspan='5'>No se encontraron los resultados.</td></tr>");
        }
      break;
      //MOSTRAR DATOS EN MODAL
      case "mostrarDatos":
        $codigo = $_POST["codigo"];
        $sql = "SELECT codproducto, producto, categoria FROM producto INNER JOIN categorias 
        ON producto.fkcategoria = categorias.codcategoria WHERE codproducto='$codigo'";
        $execute = $cn->query($sql);

        $valuesHTML = array();
        if ($execute->num_rows > 0) {
          while ($row = $execute->fetch_assoc()) {
            $valuesHTML[] = array(
              'codproducto' => $row["codproducto"],
              'producto' => $row["producto"],
              'categoria' => $row["categoria"]
            );
          }
          echo json_encode($valuesHTML);
        } else {
          echo json_encode("No se encontraron resultados.");
        }

      break;
      //ACTUALIZAR DATOS
      case "actualizarDatos":
        // Obtener datos del formulario
        $recibirId = $_POST["recibirId"];
        $recibeProducto = $_POST["recibeProducto"];
        $recibeCategoria = $_POST["recibeCategoria"];

        // Actualizar los datos en la base de datos
        $sql = "UPDATE producto INNER JOIN categorias ON producto.fkcategoria = categorias.codcategoria SET producto = ? , categorias.categoria = ? WHERE producto.codproducto = ?;";

        $stmt = $cn->prepare($sql);
        $stmt->bind_param("ssi", $recibeProducto, $recibeCategoria, $recibirId);
        $resActualizar = "";
        if ($stmt->execute()) {
          $resActualizar .= "<div class='alert alert-success' role='alert'>Los datos fueron actualizados</div>";
        } else {
          $resActualizar .= "<div class='alert alert-danger' role='alert'>Los datos no fueron actualizados</div>";
        }
        echo json_encode($resActualizar);

        $stmt->close();
        $cn->close();
      break; 
      //ELIMINAR DATOS
      case "eliminarRegistros":
          $codigo = $_POST["codigo"];
          $sql = "DELETE FROM producto WHERE codproducto = ?;";
          $stmt = $cn->prepare($sql);
          $stmt->bind_param("i", $codigo);
          $stmt->execute();
          
          if ($stmt->affected_rows > 0) {
              echo json_encode("Registro eliminado exitosamente");
          } else {
              echo json_encode("No se encontró ningún registro para eliminar");
          }
      
          $stmt->close();
          $cn->close();
      break;
      //INSERTAR CATEGORIA
      case "insertarCategoria":
          $categoria = strtoupper($_POST["categoria"]);
          $sql = "INSERT INTO categorias (categoria) VALUES (?)";
          // Preparar la consulta
          $stmt = $cn->prepare($sql);
          // Vincular parámetros
          $stmt->bind_param("s", $categoria);
          // Ejecutar la consulta
          $resInsertar = "";
          if ($stmt->execute()) {
            $resInsertar .= "Datos insertados correctamente";
          } else {
            $resInsertar .= "Los datos no se insertaron";
          }
          echo json_encode($resInsertar);
          // Cerrar la conexión
          $stmt->close();
          $cn->close();
      break;
    }
  }
} else {
  echo "El metodo debe ser post" . $cn->close();
}
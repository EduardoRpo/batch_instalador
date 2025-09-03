/* Carga de tabla de propiedades del producto */
// MODIFICADO: Corregir typos, agregar logs y cambiar a archivo fetch local
// ANTES: Tenía typo "untosidad", no había logs y usaba API que fallaba
// AHORA: Corregido "untuosidad", agregados logs y usa archivo fetch local
// Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")

$(document).ready(function () {
  // MODIFICADO: Agregar logs para debuggear la carga de especificaciones
  console.log('🔍 propiedadesProducto.js - Iniciando carga de especificaciones del producto');
  console.log('🔍 propiedadesProducto.js - Referencia:', referencia);
  console.log('🔍 propiedadesProducto.js - Módulo:', modulo);
  
  // MODIFICADO: Cambiar de API que falla a archivo fetch local
  // ANTES: url: `/api/productsDetails/${referencia}` (error 500)
  // AHORA: url: `../../html/php/productos_fetch.php?referencia=${referencia}`
  // Fecha: $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
  
  $.ajax({
    url: `../../html/php/productos_fetch.php?referencia=${referencia}`,
    type: "GET",
  }).done((data, status, xhr) => {
    // MODIFICADO: Agregar logs para debuggear
    console.log('🔍 propiedadesProducto.js - Datos recibidos:', data);
    console.log('🔍 propiedadesProducto.js - Tipo de datos:', typeof data);
    console.log('🔍 propiedadesProducto.js - Status:', status);
    
    if (modulo != 8) {
      console.log('🔍 propiedadesProducto.js - Módulo != 8, llenando especificaciones');
      
      $("#espec_color").html(data.color);
      $("#espec_olor").html(data.olor);
      $("#espec_apariencia").html(data.apariencia);
      $("#espec_poder_espumoso").html(data.poder_espumoso);
      // MODIFICADO: Corregir typo "untosidad" por "untuosidad"
      $("#espec_untuosidad").html(data.untuosidad);
      $("#espec_ph").html(
        `${data.limite_inferior_ph} a ${data.limite_superior_ph}`
      );
      $("#in_ph").attr("min", data.limite_inferior_ph);
      $("#in_ph").attr("max", data.limite_superior_ph);
      $("#espec_densidad").html(
        `${data.limite_inferior_densidad_gravedad} a ${data.limite_superior_densidad_gravedad}`
      );
      $("#in_densidad").attr("min", data.limite_inferior_densidad_gravedad);
      $("#in_densidad").attr("max", data.limite_inferior_densidad_gravedad);
      $("#espec_grado_alcohol").html(
        `${data.limite_inferior_grado_alcohol} a ${data.limite_superior_grado_alcohol}`
      );
      $("#in_grado_alcohol").attr("min", data.limite_inferior_grado_alcohol);
      $("#in_grado_alcohol").attr("max", data.limite_superior_grado_alcohol);
      $("#espec_viscidad").html(
        `${data.limite_inferior_viscosidad} a ${data.limite_superior_viscosidad}`
      );
      $("#in_viscocidad").attr("min", data.limite_inferior_viscosidad);
      $("#in_viscocidad").attr("max", data.limite_superior_viscosidad);
      
      // MODIFICADO: Agregar logs para verificar que se llenen los campos
      console.log('🔍 propiedadesProducto.js - Llenando especificaciones:');
      console.log('🔍 propiedadesProducto.js - Color:', data.color);
      console.log('🔍 propiedadesProducto.js - Olor:', data.olor);
      console.log('🔍 propiedadesProducto.js - Apariencia:', data.apariencia);
      console.log('🔍 propiedadesProducto.js - Untuosidad:', data.untuosidad);
      console.log('🔍 propiedadesProducto.js - Poder Espumoso:', data.poder_espumoso);
      console.log('🔍 propiedadesProducto.js - PH:', `${data.limite_inferior_ph} a ${data.limite_superior_ph}`);
      console.log('🔍 propiedadesProducto.js - Viscosidad:', `${data.limite_inferior_viscosidad} a ${data.limite_superior_viscosidad}`);
      console.log('🔍 propiedadesProducto.js - Densidad:', `${data.limite_inferior_densidad_gravedad} a ${data.limite_superior_densidad_gravedad}`);
      console.log('🔍 propiedadesProducto.js - Grado Alcohol:', `${data.limite_inferior_grado_alcohol} a ${data.limite_superior_grado_alcohol}`);
      
      console.log('✅ propiedadesProducto.js - Especificaciones del producto cargadas exitosamente');
    } else {
      console.log('🔍 propiedadesProducto.js - Módulo == 8, saltando especificaciones');
    }
    if (modulo == 8 || modulo == 1) {
      console.log('🔍 propiedadesProducto.js - Módulo == 8 o 1, llenando microbiología');
      $("#mesofilos").html(data.mesofilos);
      $("#pseudomona").html(data.pseudomona);
      $("#escherichia").html(data.escherichia);
      $("#staphylococcus").html(data.staphylococcus);
      console.log('✅ propiedadesProducto.js - Microbiología cargada exitosamente');
    }
    
    console.log('✅ propiedadesProducto.js - Función completada completamente');
  }).fail(function(xhr, status, error) {
    // MODIFICADO: Agregar manejo de errores
    console.error('❌ propiedadesProducto.js - Error cargando especificaciones:');
    console.error('❌ propiedadesProducto.js - Status:', status);
    console.error('❌ propiedadesProducto.js - Error:', error);
    console.error('❌ propiedadesProducto.js - XHR:', xhr);
  });
});

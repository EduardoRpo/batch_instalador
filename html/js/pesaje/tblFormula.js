/**
 * Archivo tblFormula.js - Configuración de DataTable para pesaje
 * Cambiado URL de API a fetch.php para resolver errores de DataTables
 * Agregado parámetro de versión para evitar cache del navegador
 * Creado para resolver error 'DataTables warning: table id=tablePesaje - Ajax error'
 * 
 * @author Sistema
 * @version 1.0
 * @date 2025-01-01
 */

$(document).ready(function() {

    let linea
    pesoTotalGr = 0
    pesoTotalKg = 0

    /* Formula Materia Prima  */

    tblPesaje = () => {

        tablePesaje = $('#tablePesaje').dataTable({
            destroy: true,
            ajax: {
                url: `/html/php/pesaje_dispensacion_fetch.php?referencia=${referencia}&tamano_lote=${batch.tamano_lote}&v=${Date.now()}`,
                dataSrc: '',
            },
            paging: false,
            info: false,
            searching: false,
            sorting: false,

            columns: [{
                    title: 'Referencia',
                    data: 'referencia',
                    className: 'uniqueClassName',
                },
                {
                    title: 'Materia Prima',
                    data: 'alias',
                },
                {
                    title: 'Lote',
                    defaultContent: '',
                    className: 'uniqueClassName',
                },
                {
                    title: 'Peso (<a href="javascript:cambioConversion();" class="conversion_weight">g</a>)',
                    className: 'conversion_weight_column',
                    data: 'pesoTotal',
                    className: 'text-right',
                    render: (data, type, row) => {
                        tanques = sessionStorage.getItem('tanques')
                        $('#Notanques').val(tanques).prop('disabled', true)
                        if (flagWeight)
                            return (data).toLocaleString("de-DE", { maximumFractionDigits: 2 })
                        else
                            return (data * 1000).toLocaleString("de-DE", { maximumFractionDigits: 2 })
                    },
                },
                {
                    title: '<input type="text" class="form-control" id="Notanques" style="width:52px; text-align:center">',
                    data: 'pesoTotal',
                    className: 'text-right',
                    render: (data, type, row) => {
                        if (flagWeight)
                            return (data / tanques).toLocaleString("de-DE", { maximumFractionDigits: 2 })
                        else
                            return ((data * 1000) / tanques).toLocaleString("de-DE", { maximumFractionDigits: 2 })
                    },
                },
            ],


            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                // converting to interger to find total
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };
                // computing column Total of the complete result 
                var peso = api
                    .column(3)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                var pesoTanque = api
                    .column(4)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                $(api.column(0).footer()).html('<b>Total</b>');
                $(api.column(3).footer()).html(`<b>${peso.toLocaleString("de-DE", { maximumFractionDigits: 2 })} Kg </b>`);
                $(api.column(4).footer()).html(`<b>${(pesoTanque / tanques).toLocaleString("de-DE", { maximumFractionDigits: 2 })} Kg</b>`);
            }
        })


        /* Ingreso de lotes  */

        tablePesaje.on('click', 'tbody tr', function() {
            // Validar seleccion de tanque 

            tanque = controlTanques()
            if (tanque == 0) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error('Seleccione el Tanque.')
                return false
            }

            linea = this
            mp = linea.firstChild.innerText
            mpAlias = linea.cells[1].innerText
            pesoCalculado = linea.cells[3].innerText

            // Crear modal personalizado para lote y cantidad pesada
            let modalContent = `
                <div class="modal fade" id="modalLoteCantidad" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #28a745; color: white;">
                                <h5 class="modal-title">Samara Cosmetics - Trazabilidad Lotes MP</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="numeroLote"><strong>Ingrese el Número del lote para la MP ${mp}</strong></label>
                                    <p style="font-size:13px;color:coral">Si cuenta con más de un lote separelos con un doble asterisco (**)</p>
                                    <input type="text" class="form-control" id="numeroLote" placeholder="Número de lote">
                                </div>
                                <div class="form-group">
                                    <label for="cantidadPesada"><strong>Cantidad pesada para ${mpAlias}</strong></label>
                                    <p style="font-size:13px;color:blue">Peso calculado: ${pesoCalculado} - Ingrese la cantidad real pesada</p>
                                    <input type="number" class="form-control" id="cantidadPesada" placeholder="Cantidad pesada" step="0.001" min="0">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" onclick="guardarLoteCantidad()">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Remover modal anterior si existe
            $('#modalLoteCantidad').remove();
            
            // Agregar modal al body
            $('body').append(modalContent);
            
            // Mostrar modal
            $('#modalLoteCantidad').modal('show');
        })
    }

    // Función para guardar lote y cantidad pesada
    window.guardarLoteCantidad = function() {
        let lote = $('#numeroLote').val();
        let cantidadPesada = $('#cantidadPesada').val();
        
        if (!lote || lote.trim() === '') {
            alertify.set('notifier', 'position', 'top-right')
            alertify.error('Ingrese el número del lote de la materia prima')
            return false
        }
        
        if (!cantidadPesada || cantidadPesada <= 0) {
            alertify.set('notifier', 'position', 'top-right')
            alertify.error('Ingrese la cantidad pesada válida')
            return false
        }
        
        // Cerrar modal
        $('#modalLoteCantidad').modal('hide');
        
        // Procesar lote y cantidad pesada
        numeroLoteCantidad(lote, cantidadPesada);
    }

    numeroLoteCantidad = (lote, cantidadPesada) => {
        if (lote == 0 || lote == '') {
            if (linea.firstChild.innerText != 10003) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error('El Lote no puede ser cero(0) o vacio para materias primas diferentes al agua.')
                return false
            }
        }

        flag = 0
        $(linea).addClass('tr_hover')
        linea.cells[2].innerText = lote
        mp = linea.firstChild.innerText

        for (let i = 0; i < lotes.length; i++) {
            if (lotes[i].batch == idBatch && lotes[i].referenciaMP == mp && lotes[i].tanque == tanque) {
                lotes[i].lote = lote
                lotes[i].cantidad_pesada = parseFloat(cantidadPesada)
                flag = 1
            }
        }

        if (flag == 0) {
            let fila = {}
            fila.lote = lote
            fila.cantidad_pesada = parseFloat(cantidadPesada)
            fila.batch = idBatch
            fila.referenciaMP = mp
            fila.tanque = tanque
            lotes.push(fila)
        }
        
        // Mostrar confirmación
        alertify.set('notifier', 'position', 'top-right')
        alertify.success(`Lote ${lote} y cantidad ${cantidadPesada} guardados correctamente`)
    }

    // Función original para compatibilidad (solo lote)
    numeroLote = (value) => {
        if (value == 0 || value == '') {
            if (linea.firstChild.innerText != 10003) {
                alertify.set('notifier', 'position', 'top-right')
                alertify.error('El Lote no puede ser cero(0) o vacio para materias primas diferentes al agua.')
                return false
            }
        }

        flag = 0
        $(linea).addClass('tr_hover')
        linea.cells[2].innerText = value
        mp = linea.firstChild.innerText

        for (let i = 0; i < lotes.length; i++) {
            if (lotes[i].batch == idBatch && lotes[i].referenciaMP == mp && lotes[i].tanque == tanque) {
                lotes[i].lote = value
                flag = 1
            }
        }

        if (flag == 0) {
            let fila = {}
            fila.lote = value
            fila.batch = idBatch
            fila.referenciaMP = mp
            fila.tanque = tanque
            lotes.push(fila)
        }
    }


});
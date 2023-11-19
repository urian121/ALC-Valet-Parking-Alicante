   <div class="modal fade" id="modalFactura" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h3 class="modal-title fs-5" id="exampleModalLabel" style="width: 100% !important; text-align: center;">
                       Crear Factura
                   </h3>
               </div>
               <form action="funciones.php" method="post" autocomplete="off">
                   <input type="hidden" name="accion" value="crearFacturaCliente">
                   <input type="hidden" name="idReserva" id="idReserva">
                   <input type="hidden" name="emailCliente" id="emailCliente">
                   <div class="modal-body">
                       <div class="col-md-12 mb-2 clienteModal"></div>
                       <div class="col-md-12 mb-2 mt-3">
                           <label for="formato_pago">Formato de Pago</label>
                           <?php
                            $tiposDePago = array(
                                "Transferencia Bancaria",
                                "Tarjeta Bancaria",
                                "Pago con Tarjeta de Crédito/Débito",
                                "Cheque",
                                "Efectivo"
                            ); ?>
                           <select name="formato_pago" class="form-control form-control-lg">
                               <option value="" selected="">Seleccione</option>
                               <?php
                                foreach ($tiposDePago as $tipo) {
                                    echo "<option value=\"$tipo\">$tipo</option>";
                                } ?>
                           </select>
                       </div>
                       <div class="col-md-12 mb-2 clienteModal"></div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                       <button type="submit" class="btn btn-primary">Crear factura</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
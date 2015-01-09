<style type='text/css'>
      <!--
      .style1 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
      }
      -->
      </style>
                  
      <body>
            
      <p class='style1'>Hola, Favor de registrar los siguientes datos y proceder según instrucciones de envío: enviar por fax al <?php echo $data['fax']; ?>.
      <p class='style1'>Nombre: <?php echo $data['datos']['nombre']; ?> <?php echo $data['datos']['apellido_paterno']; ?> <?php echo $data['datos']['apellido_materno']; ?></p>
      <p class='style1'>Telefono: <?php echo $data['datos']['lada']; ?> - <?php echo $data['datos']['telefono']; ?></p>
      <p class='style1'>Marca: <?php echo $data['car']['brand']; ?></p>
      <p class='style1'>A&ntilde;o: <?php echo $data['car']['year']; ?></p>
      <p class='style1'>Descripcion: <?php echo $data['car']['description']; ?></p>
      <p class='style1'>Clave: <?php echo $data['car']['vehicle']; ?></p>
      <p class='style1'>Plan seleccionado: <?php echo $data['cobertura']; ?></p>
      <p class='style1'>Forma de pago: <?php echo $data['pago']; ?><p />
      </p>
      <p class='style1'>Precios y planes que se le mostraron al cliente:</p>
      <table width='483' height='241' border='1' cellpadding='10' cellspacing='0' p class='style1'>
          <tr> 
            <td valign='top' class='cotizador'> <div align='left'><em> 
                Cobertura y formas de pago mostradas:</em><br>  
                <br>
                &nbsp;&nbsp;Marca : <?php echo $data['car']['brand']; ?> 
                
                &nbsp;&nbsp;A&ntilde;o : <?php echo $data['car']['year']; ?> 
                
                &nbsp;&nbsp;Tipo : <?php echo $data['car']['description']; ?> 

    &nbsp;&nbsp;clave : <?php echo $data['car']['vehicle']; ?>
                
               <br>
              </div>
              <table width='463' border='2' cellpadding='5' cellspacing='0' bordercolor='#000000' class='style1'>
                <tr class='style1'> 
                  <td colspan='2' rowspan='2'><div align='center'> Cobertura \ Pago</div></td>
                  <td height='17'><div align='center'>                      
                    </div></td>
                  <td><div align='center'>                      
                    </div></td>
                  <td><div align='center'>                      
                    </div></td>
                  <td><div align='center'>                      
                    </div></td>
                  <td><div align='center'>                      
                    </div></td>
                </tr>
                <tr class='style1'> 
                  <td width='50' height='17'><div align='center'>Contado<br>
                      </div></td>
                  <td width='58'><div align='center'>Semestral 
                      </div></td>
                  <td width='59'><div align='center'>Cuatrimestral 
                      </div></td>
                  <td width='67'><div align='center'>Trimestral 
                      </div></td>
                  <td width='60'><div align='center'>Mensual TDC
                      </div></td>
                </tr>                
                <tr class='style1'> 
                  <td width='22'>
                    </td>
                  <td width='59' class='style1'><div align='center'>Amplia 
                      B&aacute;sica
      </div></td>
                  <td nowrap><div align='right'>$ <?php echo number_format($data['cotizacion']['amplia']['contado']); ?>
                       </div></td>
                  <td nowrap><div align='right'>P.I. $ <?php echo number_format($data['cotizacion']['amplia']['sem']['inicial']); ?><br>
                      P.S. $ <?php echo number_format($data['cotizacion']['amplia']['sem']['subsecuente']); ?></div></td>
                  <td nowrap><div align='right'>P.I. $ <?php echo number_format($data['cotizacion']['amplia']['cuatri']['inicial']); ?><br>
                      P.S. $ <?php echo number_format($data['cotizacion']['amplia']['cuatri']['subsecuente']); ?></div></td>
                  <td nowrap><div align='right'>P.I. $ <?php echo number_format($data['cotizacion']['amplia']['trim']['inicial']); ?><br>
                      P.S. $ <?php echo number_format($data['cotizacion']['amplia']['trim']['subsecuente']); ?></div></td>
                  <td nowrap><div align='right'>$ <?php echo number_format($data['cotizacion']['amplia']['TDC']); ?></div></td>
                </tr>
                
                <tr class='style1'> 
                  <td></td>
                  <td class='style1'><div align='center'>Amplia 
                  +10</div></td>
                  <td nowrap><div align='right'>$ <?php echo number_format($data['cotizacion']['amplia_10']['contado']); ?>
                       </div></td>
                  <td nowrap><div align='right'>P.I. $ <?php echo number_format($data['cotizacion']['amplia_10']['sem']['inicial']); ?><br>
                      P.S. $ <?php echo number_format($data['cotizacion']['amplia_10']['sem']['subsecuente']); ?></div></td>
                  <td nowrap><div align='right'>P.I. $ <?php echo number_format($data['cotizacion']['amplia_10']['cuatri']['inicial']); ?><br>
                      P.S. $ <?php echo number_format($data['cotizacion']['amplia_10']['cuatri']['subsecuente']); ?></div></td>
                  <td nowrap><div align='right'>P.I. $ <?php echo number_format($data['cotizacion']['amplia_10']['trim']['inicial']); ?><br>
                      P.S. $ <?php echo number_format($data['cotizacion']['amplia_10']['trim']['subsecuente']); ?></div></td>
                  <td nowrap><div align='right'>$ <?php echo number_format($data['cotizacion']['amplia_10']['TDC']); ?></div></td>
                </tr>
                
                <tr class='style1'> 
                  <td> 
                    </td>
                  <td class='style1'><div align='center'>UPT
                  </div></td>
                   <td nowrap><div align='right'>$ <?php echo number_format($data['cotizacion']['UPT']['contado']); ?>
                       </div></td>
                  <td nowrap><div align='right'>P.I. $ <?php echo number_format($data['cotizacion']['UPT']['sem']['inicial']); ?><br>
                      P.S. $ <?php echo number_format($data['cotizacion']['UPT']['sem']['subsecuente']); ?></div></td>
                  <td nowrap><div align='right'>P.I. $ <?php echo number_format($data['cotizacion']['UPT']['cuatri']['inicial']); ?><br>
                      P.S. $ <?php echo number_format($data['cotizacion']['UPT']['cuatri']['subsecuente']); ?></div></td>
                  <td nowrap><div align='right'>P.I. $ <?php echo number_format($data['cotizacion']['UPT']['trim']['inicial']); ?><br>
                      P.S. $ <?php echo number_format($data['cotizacion']['UPT']['trim']['subsecuente']); ?></div></td>
                  <td nowrap><div align='right'>$ <?php echo number_format($data['cotizacion']['UPT']['TDC']); ?></div></td>
                </tr>
              
                <tr class='style1'> 
                  <td></td>
                  <td class='style1'><div align='center'>Limitada</div></td>
                  <td nowrap><div align='right'>$ <?php echo number_format($data['cotizacion']['limitada']['contado']); ?>
                       </div></td>
                  <td nowrap><div align='right'>P.I. $ <?php echo number_format($data['cotizacion']['limitada']['sem']['inicial']); ?><br>
                      P.S. $ <?php echo number_format($data['cotizacion']['limitada']['sem']['subsecuente']); ?></div></td>
                  <td nowrap><div align='right'>P.I. $ <?php echo number_format($data['cotizacion']['limitada']['cuatri']['inicial']); ?><br>
                      P.S. $ <?php echo number_format($data['cotizacion']['limitada']['cuatri']['subsecuente']); ?></div></td>
                  <td nowrap><div align='right'>P.I. $ <?php echo number_format($data['cotizacion']['limitada']['trim']['inicial']); ?><br>
                      P.S. $ <?php echo number_format($data['cotizacion']['limitada']['trim']['subsecuente']); ?></div></td>
                  <td nowrap><div align='right'>$ <?php echo number_format($data['cotizacion']['limitada']['TDC']); ?></div></td>
                </tr>
              </table>              
              P.I. = Pago Inicial / P.S.= Pagos subsecuentes / Cotizaci&oacute;n valida hasta el &uacute;ltimo d&iacute;a del mes.
            </td>
          </tr>
        </table>
    <?php //include ("analytics.php"); ?>
      </body>
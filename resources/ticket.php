<?php require_once(dirname(__FILE__) . "/escpos-php-master/Escpos.php");
              //$logo = new EscposImage("images/productos/tostao.jpg");

              $printer = new Escpos();
              /* Print top logo */
                            $printer -> setJustification(Escpos::JUSTIFY_CENTER);
                            
                             $printer ->  setEmphasis(true);
                             $printer -> text("FACTURA \n");
                             $printer -> text("Sucursal E.I.R.L \n");
                             $printer -> text("CAv. Josel #2584 Chiclayo-Lambayeque \n");
                             $printer -> text("ruc:12356895648 \n");
                             $printer -> text("TICKET \n");
                             $printer -> text("001-000027\n");
                             $printer -> setEmphasis(false);
                             $printer -> feed();
                             $printer -> setJustification();
              $printer -> setFont(Escpos::FONT_C);
              $printer -> feed();
              $printer -> text("#CAJA:2       19-04-2016 21:20:12\n");
              $printer -> text("Ticket                  <original>\n");
              $printer -> text("-------------------------------------\n");$printer -> text("TIPO:Efec.    RUC N°:12356895648\n");
              $printer -> text("Cliente: No tengo\n");
              $printer -> text("Puntos Acumulado: 672.00\n");
              $printer -> feed();
              $printer -> text("Direccion: av Lima 2020\n");
              $printer -> feed();
              $printer -> text("Cajero: soporte\n");
              $printer -> text("Vendedor: .....\n");
              $printer -> text("-------------------------------------\n");
              $printer -> text("Descripcion \n");
                              $printer -> text("Precio      cant             Total \n");
                              $printer -> text("-------------------------------------\n");
              $printer -> text("Celular(Celular/ CT:100MG /SB:Fresa)\n");
                              
                              $printer -> text("264.00       1.00            264.00\n");
                              $printer -> text("-------------------------------------\n");
                              $printer -> text("IGV(18%)                     S/.40.27\n");                            
                              $printer -> text("Subtotal                     S/.223.73\n");
                              
                              
                              $printer -> text("Pago adelantado(anticipo)    S/.0.00\n");
                              $printer -> text("Vale de Consumo              S/.0.00\n");
                              $printer -> text("descuento especial           S/.0\n");
                              $printer -> text("-------------------------------------\n");
                              $printer -> text("Puntos Cajeados                 0.00\n");
                              $printer -> text("Monto P. Tarjeta             S/.64.00\n"); 
                              $printer -> text("Monto P. Efectivo            S/.200.00\n"); 
                              $printer -> text("TOTAL                        S/.264.00\n");
                              $printer -> feed(); 
                              $printer -> text("-------------------------------------\n");
                              $printer -> text("Importe Pagado               S/.264\n");
                              $printer -> text("Vuelto                       S/.0\n"); 
                              $printer -> text("-------------------------------------\n"); 
                              $printer -> text("-------------------------------------\n");
                              $printer -> text("\n"); 
                              $printer -> text("\n");
                              $printer -> cut();$printer -> pulse(); 
                              $printer -> text("  Aqui algunos productos Cajeables\n");
                              $printer -> text("Celular(Celular/ CT:100MG /SB:Fresa)\n");
                              $printer -> text("Puntos: 5000.00\n");
                      $printer -> text("Celular(Celular/ CT:500Mg /SB:Chocolate)\n");
                              $printer -> text("Puntos: 500.00\n");
                      $printer -> text("producto2(producto2/ CT:500MG /SB:Fresa)\n");
                              $printer -> text("Puntos: 300.00\n");
                      $printer -> text("producto cf\n");
                              $printer -> text("Puntos: 200.00\n");
                      $printer -> setEmphasis(true);$printer -> text("-------------------------------------\n");$printer -> setEmphasis(true);$printer -> text("Comuniquense con nosotros al:\n");$printer -> text("\n");$printer -> setEmphasis(false);$printer -> feed();$printer -> feed();$printer -> cut();$printer -> pulse();$printer -> close();
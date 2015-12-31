<?php require_once(dirname(__FILE__) . "/escpos-php-master/Escpos.php");
              //$logo = new EscposImage("images/productos/tostao.jpg");

              $printer = new Escpos();
              /* Print top logo */
                            $printer -> setJustification(Escpos::JUSTIFY_CENTER);
                            
                             $printer ->  setEmphasis(true);
                             $printer -> text("FACTURA \n");
                             $printer -> text("Calle san jose 427 Chiclayo-Lambayeque \n");
                             $printer -> text("ruc:124586532651 \n");
                             $printer -> text("TICKET \n");
                             $printer -> text("001-000003\n");
                             $printer -> setEmphasis(false);
                             $printer -> feed();
                             $printer -> setJustification();
              $printer -> setFont(Escpos::FONT_C);
              $printer -> feed();
              $printer -> text("#CAJA:1       31-12-2015 11:59:47\n");
              $printer -> text("Ticket                  <original>\n");
              $printer -> text("-------------------------------------\n");$printer -> text("TIPO:      RUC N°:10166324507\n");
              $printer -> text("Cliente: Empresa Cliente Ejemplo\n");
              $printer -> feed();
              $printer -> text("Direccion: Dirección Fiscal Ejemplo\n");
              $printer -> feed();
              $printer -> text("Vendedor: soporte\n");
              $printer -> text("-------------------------------------\n");
              $printer -> text("Descripcion \n");
              $printer -> text("Precio      cant           Total \n");
              $printer -> text("-------------------------------------\n");
              $printer -> text("Peoducto1(Peoducto1/ CT:10gr /SB:piña)\n");
                              
                              $printer -> text("60.00       1.00          60\n");
                              $printer -> text("-------------------------------------\n");
                              $printer -> text("IGV(18%)               S/.9.15\n");                            
                              $printer -> text("Subtotal               S/.50.85\n");
                              
                              
                              $printer -> text("Pago adelantado(anticipo)    0.00\n");
                              $printer -> text("Vale de Consumo              0.00\n");
                              $printer -> text("descuento especial         S/.0\n");
                              $printer -> text("-------------------------------------\n"); 
                              $printer -> text("TOTAL            S/.60.00\n");
                              $printer -> feed(); 
                              $printer -> text("-------------------------------------\n");
                              $printer -> text("Vuelto                           \n");
                              $printer -> text("                       S/.0\n"); 
                              $printer -> text("-------------------------------------\n"); 
                              $printer -> text("-------------------------------------\n"); 
                              $printer -> setEmphasis(true);$printer -> text("-------------------------------------\n");$printer -> setEmphasis(true);$printer -> text("Comuniquense con nosotros al:\n");$printer -> text("example@gmail.com\n");$printer -> setEmphasis(false);$printer -> feed();$printer -> text("**No válido como documento contable**\n");$printer -> feed();$printer -> cut();$printer -> pulse();$printer -> close();
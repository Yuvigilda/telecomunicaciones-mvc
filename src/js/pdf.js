
function generarPDF(boton) {
  const { jsPDF } = window.jspdf;
  const fila = boton.closest("tr");
  const doc = new jsPDF(
    {
      orientation: 'portrait', // o 'landscape'
      unit: 'mm',              // unidades: 'pt', 'mm', 'cm', 'in'
      format: [80, 120]        // ancho x alto en milímetros
    }
  );

  // Obtener datos del formulario
  const nombreCliente = fila.querySelector(".nombreCliente").textContent;
  const nombreVendedor = fila.querySelector(".nombreVendedor").textContent;
  const mbps = fila.querySelector(".mbps").textContent;
  const fechaVenta = fila.querySelector(".fechaVenta").textContent;
  const precio = fila.querySelector(".precio").textContent;
  const mensaje = `Mensaje: Gracias por su compra`;

  // Agregar contenido al PDF
  doc.setFontSize(9);

  doc.text("TELECOMUNICACIONES HZ", 20, 10);
  doc.text("Datos del la venta", 8, 20);
  doc.text(`Nombre del cliente: ${nombreCliente}`, 8, 30);


  doc.text(`Fecha de contratacion: ${fechaVenta}`, 8, 40);
  doc.text(`Costo mensual del servicio: $${precio}`, 8, 50);
  doc.text(`Servicio contratado: ${mbps}`, 8, 60);
  doc.text(`Le atendió: ${nombreVendedor}`, 8, 90);


  // Dividir el mensaje en líneas si es largo
  const textoDividido = doc.splitTextToSize(mensaje, 170);
  doc.text(textoDividido, 8, 100);

  // Descargar el PDF
  doc.save("detalleVenta.pdf");
}



function generarPDFP(boton) {
  const { jsPDF } = window.jspdf;
  const fila = boton.closest("tr");
  const doc = new jsPDF(
    {
      orientation: 'portrait', // o 'landscape'
      unit: 'mm',              // unidades: 'pt', 'mm', 'cm', 'in'
      format: [80, 120]        // ancho x alto en milímetros
    }
  );

  // Obtener datos del formulario
  const nombreCliente = fila.querySelector(".ncliente").textContent;
  const nombreVendedor = fila.querySelector(".nvendedor").textContent;
  const producto = fila.querySelector(".descripcion").textContent;
  const fechaVenta = fila.querySelector(".fechaV").textContent;
  const precio = fila.querySelector(".precioV").textContent;
  const mensaje = `Mensaje: Gracias por su compra`;

  // Agregar contenido al PDF
  doc.setFontSize(9);

  doc.text("TELECOMUNICACIONES HZ", 20, 10);
  doc.text("Detalle del la venta", 8, 20);
  doc.text(`Nombre del cliente: ${nombreCliente}`, 8, 30);


  doc.text(`Fecha de compra: ${fechaVenta}`, 8, 40);
  doc.text(`Descripcion: ${producto}`, 8, 50);
  doc.text(`Costo del producto: $${precio}`, 8, 70);

  doc.text(`Le atendió: ${nombreVendedor}`, 8, 100);

  doc.text(mensaje, 8, 110);

  // Dividir el mensaje en líneas si es largo

  // Descargar el PDF
  doc.save("detalleVenta.pdf");
}



function generarPDFPG(boton) {
  const { jsPDF } = window.jspdf;
  const fila = boton.closest("tr");
  const doc = new jsPDF(
    {
      orientation: 'portrait', // o 'landscape'
      unit: 'mm',              // unidades: 'pt', 'mm', 'cm', 'in'
      format: [80, 120]        // ancho x alto en milímetros
    }
  );

  // Obtener datos del formulario
  const clientepago = fila.querySelector(".clientepago").textContent;
  const cajero = fila.querySelector(".cajero").textContent;
  const servicio = fila.querySelector(".mbps").textContent;
  const fechapago = fila.querySelector(".fechapago").textContent;
  const pago = fila.querySelector(".pago").textContent;
  const mensaje = `Mensaje: Gracias por su pago`;

  // Agregar contenido al PDF
  doc.setFontSize(9);

  doc.text("TELECOMUNICACIONES HZ", 20, 10);
  doc.text("Detalle del pago  por el servicio contratado", 8, 20);
  doc.text(`Nombre del cliente: ${clientepago}`, 8, 30);


  doc.text(`Fecha de pago: ${fechapago}`, 8, 40);
  doc.text(`Servicio contratado: ${servicio}`, 8, 50);
  doc.text(`Monto pagado: $${pago}`, 8, 70);

  doc.text(`Le atendió: ${cajero}`, 8, 100);

  doc.text(mensaje, 8, 110);

  // Dividir el mensaje en líneas si es largo

  // Descargar el PDF
  doc.save("detallePago.pdf");
}







(function(){
    
    const productosInput = document.querySelector('#productos');
    if(productosInput){
        let productos = [];
        let productosFiltrados = [];
        const listadoProductos = document.querySelector('#listado-productos');
        const productoHidden = document.querySelector('[name="id_producto"]');
        obtenerProductos();
        productosInput.addEventListener('input', buscarProductos);

        if(productoHidden.value){
            (async()=>{
                const producto = await obtenerProducto(productoHidden.value);
                const {descripcion} = producto;
                //insertar el en html
                const productoDOM = document.createElement('LI');
                productoDOM.classList.add('listado-productos__producto','listado-productos__producto--seleccionado');
                productoDOM.textContent = `${descripcion}`;
                listadoProductos.appendChild(productoDOM);
            })();
        }
        async function obtenerProductos() {
            const url = `/api/productos`;
             const respuesta = await fetch(url);
             const resultado = await respuesta.json();
             formatearProductos(resultado);
        }
        async function obtenerProducto(id) {
            const url = `/api/producto?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            return resultado;
        }
        function formatearProductos(arrayProductos = []){
            productos = arrayProductos.map(producto => {
                return {
                    descripcion : `${producto.descripcion.trim()}`,
                    id : producto.id
                }
            })
            
        }
        function buscarProductos(e){
            const busqueda = e.target.value;
            if(busqueda.length > 3){
                const expresion = new RegExp(busqueda, "i");
                productosFiltrados = productos.filter(producto => {
                    if(producto.descripcion.toLowerCase().search(expresion) !== -1){
                        return producto;
                    }
                })
                
            }else{
                productosFiltrados = [];
            }
            mostrarProductos();
        }
        function mostrarProductos(){
            while(listadoProductos.firstChild){
                listadoProductos.removeChild(listadoProductos.firstChild);
            }
            if(productosFiltrados.length > 0){
                productosFiltrados.forEach(producto =>{
                const productoHTML = document.createElement('LI');
                productoHTML.classList.add('listado-productos__producto');
                productoHTML.textContent = producto.descripcion;
                productoHTML.dataset.productoId = producto.id;
                productoHTML.onclick = seleccionarProducto;

                //añadir al dom
                listadoProductos.appendChild(productoHTML);
            });
            }else{
                const noResultados = document.createElement('P');
                noResultados.classList.add('listado-productos__no-resultado');
                noResultados.textContent = 'No hay resultados coincidentes';
                listadoProductos.appendChild(noResultados);
            }
            
        }
        function seleccionarProducto(e){
            const producto = e.target;
            //remover la clase previa
            const productoPrevio = document.querySelector('.listado-productos__producto--seleccionado');
            if(productoPrevio){
                productoPrevio.classList.remove('listado-productos__producto--seleccionado');
            }
            producto.classList.add('listado-productos__producto--seleccionado');
           productoHidden.value = producto.dataset.productoId;
        }
    }
})();
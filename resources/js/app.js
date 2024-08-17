import './bootstrap'; // Importa el archivo bootstrap para inicializar las configuraciones básicas.
import Swal from 'sweetalert2'; // Importa SweetAlert2 para mostrar alertas bonitas.
import 'select2/dist/js/select2.min.js'; // Importa el archivo JavaScript de Select2 para mejorar los selectores.
import 'select2/dist/css/select2.min.css'; // Importa el archivo CSS de Select2 para estilizar los selectores.

import "/node_modules/select2/dist/css/select2.css"; // Importa el CSS de Select2 desde node_modules.
import '../css/app.css'; // Importa el archivo CSS de la aplicación.
window.Swal = Swal; // Asigna Swal al objeto global window para su uso en otros scripts.

// Función para habilitar o deshabilitar el campo "Detalle" basado en la selección del estado.
function toggleDetalleInput(selectElement) {
    const selectedValue = selectElement.value; // Obtiene el valor seleccionado del elemento select.
    const detalleInput = selectElement.closest('.modal-content').querySelector('#Detalle'); // Busca el campo "Detalle" dentro del modal.
    detalleInput.disabled = (selectedValue !== 'Entregado con daño'); // Deshabilita el campo "Detalle" si el valor seleccionado no es "Entregado con daño".
}

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar Select2 en elementos con la clase .js-example-basic-single
    $('.js-example-basic-single').select2({
        placeholder: 'Selecciona o escribe...', // Texto de marcador de posición.
        allowClear: true // Permite borrar la selección.
    });

    // Configuración para el modal de estado
    const selectElements = document.querySelectorAll('.modal-content select#Estado'); // Selecciona todos los elementos select con el id "Estado" dentro del modal.
    selectElements.forEach(function(selectElement) {
        selectElement.addEventListener('change', function() {
            toggleDetalleInput(this); // Llama a la función para habilitar o deshabilitar el campo "Detalle" al cambiar la selección.
        });
        toggleDetalleInput(selectElement); // Inicializa el estado del campo "Detalle" al cargar la página.
    });

    // Configuración para el botón de eliminar imagen
    const eliminarImagenBtn = document.getElementById('eliminar_imagen_btn');
    if (eliminarImagenBtn) {
        eliminarImagenBtn.addEventListener('click', function() {
            // Muestra una alerta de confirmación con SweetAlert2
            Swal.fire({
                title: 'Gestor de Drones',
                text: '¿Estás seguro de que quieres eliminar la imagen?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si se confirma, envía el formulario para eliminar la imagen.
                    document.getElementById('eliminar_imagen_form').submit();
                }
            });
        });
    }

    // Configuración para el tooltip de información
    const infoBtn = document.getElementById('infoBtn');
    const infoTooltip = document.getElementById('infoTooltip');
    if (infoBtn && infoTooltip) {
        infoBtn.addEventListener('mouseover', function() {
            infoTooltip.style.display = 'inline-block'; // Muestra el tooltip al pasar el ratón por encima del botón de información.
        });
        infoBtn.addEventListener('mouseout', function() {
            infoTooltip.style.display = 'none'; // Oculta el tooltip al alejar el ratón del botón de información.
        });
    }
});

// Limpia el campo de imagen cuando se hace clic en el botón de limpiar imagen
document.getElementById('clearImage').addEventListener('click', function() {
    document.getElementById('imagen').value = ''; // Establece el valor del campo de imagen a una cadena vacía.
});

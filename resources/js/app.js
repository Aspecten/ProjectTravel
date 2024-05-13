import 'bootstrap'; // Подключение Bootstrap JS (для динамических компонентов)
import Alpine from 'alpinejs';


$(document).ready(function() {
    $('#myTable').DataTable(); // Инициализация DataTables
});

window.Alpine = Alpine;
Alpine.start();

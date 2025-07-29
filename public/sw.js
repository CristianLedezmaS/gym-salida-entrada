// Service Worker vacío para evitar errores
// Este archivo no hace nada, solo evita errores 404

console.log('Service Worker cargado (vacío)');

// No interceptar ninguna petición
self.addEventListener('fetch', function(event) {
    // No hacer nada, dejar que las peticiones pasen normalmente
    return;
});

// No instalar cache
self.addEventListener('install', function(event) {
    // No hacer nada
    return;
});

// No activar cache
self.addEventListener('activate', function(event) {
    // No hacer nada
    return;
}); 
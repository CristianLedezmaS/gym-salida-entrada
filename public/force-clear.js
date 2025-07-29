// Script para forzar la limpieza completa
console.log('Iniciando limpieza completa...');

// 1. Desregistrar todos los Service Workers
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.getRegistrations().then(function(registrations) {
        for(let registration of registrations) {
            registration.unregister();
            console.log('Service Worker desregistrado:', registration.scope);
        }
    });
}

// 2. Limpiar todo el cache
caches.keys().then(function(cacheNames) {
    return Promise.all(
        cacheNames.map(function(cacheName) {
            console.log('Eliminando cache:', cacheName);
            return caches.delete(cacheName);
        })
    );
}).then(function() {
    console.log('Todo el cache ha sido limpiado');
    
    // 3. Limpiar localStorage y sessionStorage
    localStorage.clear();
    sessionStorage.clear();
    console.log('Storage limpiado');
    
    // 4. Recargar la página
    console.log('Recargando página...');
    window.location.reload(true);
});

// 5. Mostrar mensaje de confirmación
setTimeout(function() {
    alert('Cache limpiado. La página se recargará automáticamente.');
}, 1000); 
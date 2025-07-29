// Script para deshabilitar completamente el Service Worker
if ('serviceWorker' in navigator) {
    // Desregistrar todos los Service Workers
    navigator.serviceWorker.getRegistrations().then(function(registrations) {
        for(let registration of registrations) {
            registration.unregister();
            console.log('Service Worker desregistrado');
        }
    });
    
    // Limpiar todo el cache
    caches.keys().then(function(cacheNames) {
        return Promise.all(
            cacheNames.map(function(cacheName) {
                console.log('Eliminando cache:', cacheName);
                return caches.delete(cacheName);
            })
        );
    }).then(function() {
        console.log('Todo el cache ha sido limpiado');
        // Recargar la página para aplicar cambios
        window.location.reload();
    });
} else {
    console.log('Service Worker no está disponible');
} 
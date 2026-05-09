const cache_name='kostkito.id';
const assets=[
    '/owner',
    '/owner/login_page',
    '/img_logo/new_kostkito_form.png'
];

self.addEventListener('install',e=>{
    e.waitUntil(
        caches.open(cache_name).then(cache=>cache.addAll(assets))
    );
});

self.addEventListener('fetch',e=>{
    e.responseWidth(
        caches.match(e.request).then(response=>{
      return response || fetch(e.request);
    })
    );
});

self.addEventListener('activate',e=>{
    e.waitUntil(
        caches.keys().then(keys=>Promise.all(keys.filter(k=>k!==cache_name).map(k=>caches.delete(k))))
    )
})
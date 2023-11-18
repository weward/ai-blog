
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '/', redirect: 'documents' },
      { path: 'documents/', name: 'documents.index', component: () => import('pages/Documents/DocumentsIndex.vue') },
      { path: 'documents/new', name: 'documents.create', component: () => import('pages/Documents/DocumentsCreate.vue') }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes

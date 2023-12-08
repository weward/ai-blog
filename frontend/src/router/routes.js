
const routes = [
  {
    path: '/',
    component: () => import('layouts/AuthLayout.vue'),
    children: [
      { path: '/', redirect: 'auth/login' },
      { path: 'auth/login', name: 'auth.login', meta: { requiresAuth: false }, component: () => import('pages/Auth/LoginPage.vue') },
      { path: 'auth/register', name: 'auth.registration', meta: { requiresAuth: false }, component: () => import('pages/Auth/RegistrationPage.vue') },
    ]
  },
  {
    path: '/documents',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '/documents', name: 'documents.index', meta: { requiresAuth: true }, component: () => import('pages/Documents/DocumentsIndex.vue') },
      { path: '/documents/new', name: 'documents.create', meta: { requiresAuth: true }, component: () => import('pages/Documents/DocumentsCreate.vue') },
      { path: '/documents/:id', name: 'documents.show', meta: { requiresAuth: true }, params: true, component: () => import('pages/Documents/DocumentsShow.vue') },
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

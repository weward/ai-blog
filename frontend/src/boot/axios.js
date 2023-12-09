import { boot } from 'quasar/wrappers'
import axios from 'axios'
import { notify } from 'src/config/elements'
import { isAuthExpired, updateLastActivity } from 'src/utils/time'

// Be careful when using SSR for cross-request state pollution
// due to creating a Singleton instance here;
// If any client changes this (global) instance, it might be a
// good idea to move this instance creation inside of the
// "export default () => {}" function below (which runs individually
// for each client)
const api = axios.create({ baseURL: import.meta.env.VITE_API_URL })

export default boot(({ app }) => {
  // for use inside Vue files (Options API) through this.$axios and this.$api

  app.config.globalProperties.$axios = axios
  // ^ ^ ^ this will allow you to use this.$axios (for Vue Options API form)
  //       so you won't necessarily have to import axios in each vue file

  app.config.globalProperties.$api = api
  // ^ ^ ^ this will allow you to use this.$api (for Vue Options API form)
  //       so you can easily perform requests against your app's API


  // Response interceptor
  api.interceptors.response.use(
    (response) => {
      // Update authExpiration + 1 hour
      updateLastActivity()

      return response;
    },
    (error) => {
      // Check for Authentication Timeout
      if (error.response && error.response.status === 401) {// check if auth has expired
        // if past an hour (__HOURS)
        if (isAuthExpired(true)) {
          notify('Session expired. Please log in again.')
          setTimeout(() => {
            window.location.href = '/auth/login'
          }, 1500)
        }
      }
      // Return any other errors
      return Promise.reject(error);
    }
  )


})



export { api }

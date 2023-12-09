const _HOURS_EXPIRATION_DEFAULT = 1

export const updateLastActivity = () => {
  // set last activity
  let currentDate = new Date()
  localStorage.setItem('lastActivity', currentDate.getTime())
}

/**
 * LOGOUT IF:
 * - last activity greater than 1 hour
 */
export const isAuthExpired = (shouldDelete = false) => {
  let LSlastActivity = localStorage.getItem('lastActivity')

  let currentDate = new Date()
  // check if last activity is < 1 hour ago
  let lastActivity = new Date(parseInt(LSlastActivity))

  lastActivity.setHours(lastActivity.getHours() + _HOURS_EXPIRATION_DEFAULT)

  const isExpired = lastActivity.getTime() < currentDate.getTime()

  if (shouldDelete) {
    localStorage.removeItem('authToken')
    localStorage.removeItem('authUser')
    localStorage.removeItem('lastActivity')
  }

  return isExpired
}

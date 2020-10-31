import store from '../store'

export default function (to, from, next) {
  if (store.getters.AUTH) {
    next()
  } else {
    next('/login')
  }
}

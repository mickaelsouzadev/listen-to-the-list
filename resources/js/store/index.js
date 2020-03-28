export default {

  state: {
    isLoggedIn: !!localStorage.getItem('token'),
    user: [],
  },

  getters: {
    getUser(state) {
      return state.user
    },

    getIsLoggedIn(state) {
      return state.isLoggedIn
    },
  },

  actions: {
    getUserFromLocalStorage(context) {
      const data = localStorage.getItem('user')
      context.commit('setUser', data)
    },

    login(context) {
      context.commit('doLogin')
    },

    logout(context) {
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      context.commit('doLogout')
    }  
  },

  mutations: {
    setUser(state, data) {
      state.user = data
    },

    doLogin(state) {
      state.isLoggedIn = true
    },

    doLogout(state) {
      state.isLoggedIn = false
    }
  }
}
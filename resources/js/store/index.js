export default {

  state: {
    isLoggedIn: !!localStorage.getItem('token'),
    user: [],
    googleClientId: "GOOGLE_CLIENT_ID",
  },

  getters: {
    getUser(state) {
      return state.user
    },

    getIsLoggedIn(state) {
      return state.isLoggedIn
    },

    getGoogleClientId(state) {
      return state.googleClientId
    }
  },

  actions: {
    getUserFromLocalStorage(context) {
      const data = localStorage.getItem('user')
      context.commit('setUser', data)
    },

    login(context, data) {
      localStorage.setItem('user', JSON.stringify(data.user))
      localStorage.setItem('token', data.token)
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
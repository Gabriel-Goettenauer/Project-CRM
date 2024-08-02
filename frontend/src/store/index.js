import { createStore } from "vuex";

export default createStore({
  state: {
    token: '',
    userID:'',
  },
  getters: {
    getToken: (state) => state.token,
  },
  mutations: {
    setToken(state, token) {
      state.token = token;
    },
    clearToken(state) {
      state.token = null;
    },
    setUserId(state, userId) {
      state.userId = userId;
    },
  },
  actions: {
    setToken({ commit }, token) {
      commit('setToken', token);
    },
    clearToken({ commit }) {
      commit('clearToken');
    },
    login({ commit }, userData) {
      return loginUser(userData).then(response => {
        commit('setUserId', response.data.id);
        return response;
      });
    },
  },
  modules: {},
});
